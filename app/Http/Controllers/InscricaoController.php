<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Vizir\KeycloakWebGuard\Services\KeycloakService;

use App\Models\Edital;
use App\Models\Inscricao;
use App\Models\InscricaoAreaTematica;
use App\Models\AreaTematica;
use App\Models\UploadFile;
use App\Models\Orcamento;
use App\Models\QuestaoRespondida;
use App\Models\LinhaExtensao;
use App\Models\User;
use App\Models\Municipio;
use App\Models\Cronograma;
use App\Models\ComissaoUser;

use App\Services\Avaliacao\Comissao1;
use App\Services\Avaliacao\Parecerista;
use App\Services\Avaliacao\Subcomissao;

use App\Services\Avaliacao;

class InscricaoController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:edital-coordenador|edital-administrador|super|admin');
        $credentials = KeycloakWeb::retrieveToken();
        $resposta = KeycloakWeb::refreshAccessToken($credentials);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::where('email', Auth::user()->id)->first();

        $cronograma = new Cronograma();

        $status = [
            'Submetido' => 'warning',
            'Salvo' => 'warning',
            'Deferido' => 'success',
            'Classificado' => 'success',
            'Avaliado' => 'primary',
            'Indeferido' => 'danger',
            'Desclassificado' => 'danger'
        ];

        if( $user->hasAnyRole('edital-analista','edital-avaliador', 'edital-administrador') ) {
            /* lista todas as inscrições se o user for administrador */
            if($user->hasRole('edital-administrador')) {
                $inscricoes = Inscricao::all();
            }
            /* lista todas as inscrições da unidade do user que é analista ou inscricoes que ele esta indicado como analista */
            elseif($user->hasRole('edital-analista')) {
                $inscricoes = Inscricao::join('unidades as u', 'u.id', 'inscricoes.unidade_id')
                                        ->join('subcomissao_tematica as st', 'st.id', 'u.subcomissao_tematica_id')
                                        ->where('u.subcomissao_tematica_id', $user->unidade->subcomissao_tematica_id)
                                        ->orWhere('inscricoes.analista_user_id', $user->id)
                                        ->get(['inscricoes.*']);
            }
            /* lista as inscrições em que o user é avaliador */
            elseif($user->hasRole('edital-avaliador')) {
                $inscricoes = Inscricao::join('avaliadores_por_inscricao as ai', 'ai.inscricao_id', 'inscricoes.id')
                                        ->where('ai.user_id', $user->id)
                                        ->get(['inscricoes.*']);
            }
            
            return view('inscricao.index', compact('inscricoes', 'user', 'cronograma', 'status'));
        }
        else {
            $inscricoes = Inscricao::join('comissoes', 'comissoes.edital_id', 'inscricoes.edital_id')
                                ->join('comissoes_users as cu', 'cu.comissao_id', 'comissoes.id')
                                ->where('cu.user_id', $user->id)
                                ->distinct()
                                ->get(['inscricoes.*']);

            //echo json_encode([$inscricoes, 'else']);

            return view('inscricao.index', compact('inscricoes', 'user', 'cronograma', 'status'));
        }

        session()->flash('status', 'Desculpe! Acesso não autorizado');
        session()->flash('alert', 'warning');

        return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $user = User::where('email', Auth::user()->id)->first();
        /* Checagem se o user já é inscrito no edital ou se possui uma inscrição em aberto em outros editais */
        $checaInscricaoExistente = Inscricao::where('edital_id', $id)->where('user_id', $user->id)->first();
        $checaInscricaoEmAberto = Inscricao::where('user_id', $user->id)->where('status', '<>', 'Concluido')->first();

        if(!!$checaInscricaoExistente && !!$checaInscricaoEmAberto){
            session()->flash('status', 'Desculpe! Você possui uma inscrição em aberto, ou ja possui uma inscrição para o edital!');
            session()->flash('alert', 'warning');

            return redirect()->back();
        }

        $edital = Edital::find($id);
        /* Checa se está no período de inscrições */
        foreach($edital->cronogramas as $cronograma) {
            if($cronograma->dt_input == 'dt_inscricao' && strtotime(date('Y-m-d')) < strtotime($cronograma->data) ) {
                session()->flash('status', 'Desculpe! As inscrições ainda não estão abertas!');
                session()->flash('alert', 'warning');

                return redirect()->back();
            }

            if($cronograma->dt_input == 'dt_termino_inscricao' && strtotime(date('Y-m-d')) > strtotime($cronograma->data) ) {
                session()->flash('status', 'Desculpe! As inscrições já se encerraram!');
                session()->flash('alert', 'warning');

                return redirect()->back();
            }
        }

        $estados = Municipio::select('uf')->distinct('uf')->orderBy('uf')->get();

        $linhas_extensao = LinhaExtensao::all();
        $areas_tematicas = AreaTematica::all();

        return view('inscricao.create', compact('edital', 'linhas_extensao', 'estados', 'areas_tematicas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputsParaValidar = $request->except(['estado', 'link_lattes', 'link_projeto', 'palavras_chaves']);
        $validar = array();

        foreach($inputsParaValidar as $key => $inputs) {
            if($key == 'resumo') {
                $validar[$key] = 'required|max:2500';
            }
            elseif($key == 'pdf_projeto') {
                $validar[$key] = 'required|mimes:pdf';
            }
            elseif($key == 'comprovante_parceria') {
                $validar[$key] = 'mimes:pdf';
            }
            elseif(substr($key, 0, 8) == 'questao-'){
                $validar[$key] = 'required|max:10000';
            }
            else {
                $validar[$key] = 'required';
            }
        }

        $mensagens = array();

        foreach($inputsParaValidar as $key => $inputs) {
            if(substr($key, 0, 8) == 'questao-') {
                $mensagens[$key.'.required'] = 'Uma questão complementar não foi preenchida';
                $mensagens[$key.'.max'] = 'Uma questão complementar ultrapassou o máximo permitido de caracteres';
            }
        }

        $validar['areas_tematicas'] = 'required';
        $validar['pdf_projeto'] = 'required|mimes:pdf';

        $validated = $request->validate($validar,$mensagens);

        $user = User::where('email', Auth::user()->id)->first();
        /* Checagem se o user já é inscrito no edital ou se possui uma inscrição em aberto em outros editais */
        $checaInscricaoExistente = Inscricao::where('edital_id', $request->edital_id)->where('user_id', $user->id)->first();
        $checaInscricaoEmAberto = Inscricao::where('user_id', $user->id)->where('status', '<>', 'Concluido')->first();

        if(!!$checaInscricaoExistente && !!$checaInscricaoEmAberto){
            session()->flash('status', 'Desculpe! Você possui uma inscrição em aberto, ou ja possui uma inscrição para o edital!');
            session()->flash('alert', 'warning');

            return redirect()->back();
        }

        $areasTematicasInsert = array();
        $respostasQuestoesInsert = array();
        $upload = new UploadFile();
        /* Inserção no banco de dados usando transação, caso alguma inserção de erro ele retorna o banco ao estado anterior */
        $inscricao = DB::transaction(function() use( $request, $areasTematicasInsert, $respostasQuestoesInsert, $upload, $user) {
            /* Faz a inserção da inscrição */
            $inscricaoCriada = Inscricao::create([
                'titulo' => $request->titulo,
                'tipo' => $request->tipo_extensao,
                'municipio_id' => $request->cidade,
                'resumo' => $request->resumo,
                'palavras_chaves' => $request->palavras_chaves,
                'parceria' => $request->parceria,
                'anexo_parceria' => !!$request->comprovante_parceria ? $upload->execute($request, 'comprovante_parceria', 'pdf', 30000000) : '',
                'anexo_projeto' => $upload->execute($request, 'pdf_projeto', 'pdf', 30000000),
                'url_projeto' => $request->link_projeto,
                'url_lattes' => $request->link_lattes,
                'status' => 'Salvo',
                'linha_extensao_id' => $request->linha_extensao,
                'user_id' => $user->id,
                'unidade_id' => $user->unidade->id,
                'edital_id' => $request->edital_id
            ]);
            /* Prepara os dados para inserção das areas temáticas */
            foreach($request->areas_tematicas as $areas) {
                array_push($areasTematicasInsert,[
                    'area_tematica_id' => $areas,
                    'inscricao_id' => $inscricaoCriada->id
                ]);
            }
            /* faz a inserção das áreas temáticas */
            DB::table('inscricoes_areas_tematicas')->insert($areasTematicasInsert);
            /* preopara os dados para inserção das respostas das questões complementares */
            foreach($request->all() as $key => $resposta) {
                if(substr($key, 0, 8) == 'questao-') {
                    array_push($respostasQuestoesInsert, [
                        'questao_id' => substr($key, 8, strlen($key)),
                        'inscricao_id' => $inscricaoCriada->id,
                        'resposta' => $resposta
                    ]);
                }
            }
            /* faz a inserção das respostas das questões complementares */
            DB::table('questoes_respondidas')->insert($respostasQuestoesInsert);

            return $inscricaoCriada;
        });

        if(is_null($inscricao) || empty($inscricao)) {
            Log::channel('inscricao')->error('Usuario Nome: ' . $user->name . ' - Usuario ID: ' . $user->id . ' - Erro: Inscricao não inserida  - Endereço IP: ' . $request->ip());
            session()->flash('status', 'Desculpe! Houve erro ao enviar a inscrição');
            session()->flash('alert', 'danger');

            return redirect()->back();
        }
        else {
            Log::channel('inscricao')->info('Usuario Nome: ' . $user->name . ' - Usuario ID: ' . $user->id . ' - Operação: Nova inscricao ' . $inscricao->id . ' - Endereço IP: ' . $request->ip());
            session()->flash('status', 'Finalize sua inscrição incluindo os itens do orçamento.');
            session()->flash('alert', 'success');

            return redirect()->to("inscricao/$inscricao->id/orcamento");
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inscricao $inscricao
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Inscricao $inscricao)
    {
        //$inscricao = Inscricao::find($id);
        $edital = Edital::findOrFail($inscricao->edital_id);
        $cronograma = new Cronograma();
        $avaliacaoResposta = false;
        $user = User::where('email', Auth::user()->id)->first();

        if(isset($request->tipo_avaliacao)) {
            $tipo_avaliacao = [
                'subcomissao' => new Subcomissao(),
                'parecerista' => new Parecerista(),
                'comissao1' => new Comissao1(),
            ];
    
            $avaliacao = new Avaliacao($tipo_avaliacao[$request->tipo_avaliacao]);
    
            $avaliacaoResposta = $avaliacao->getAvaliacao($request, $inscricao, $user);
            
            unset($tipo_avaliacao);
        }
        
        $linhaextensao = LinhaExtensao::findOrFail($inscricao->linha_extensao_id);

        $inscricoesAreaTematica = InscricaoAreaTematica::join(
            'areas_tematicas', 'areas_tematicas.id',
            'inscricoes_areas_tematicas.area_tematica_id'
            )->where('inscricao_id',$inscricao->id)
            ->get();

        $respostasQuestoes = QuestaoRespondida::join(
            'questoes', 'questoes_respondidas.questao_id',
            'questoes.id'
            )->where('questoes_respondidas.inscricao_id', $inscricao->id)
            ->get();


        $criterios = $edital->criterios;

        $questoesAvaliacao = $edital->questoes->filter(function($value, $key) {
            return data_get($value, 'tipo') == 'Avaliativa';
        });

        $valorMaxPorInscricao = $inscricao->tipo == 'Programa' ? $edital->valor_max_programa : $edital->valor_max_inscricao;

        $totalItens = Orcamento::where('inscricao_id', $inscricao->id)->sum('valor');
        $itensOrcamento = Orcamento::join('item', 'item.id', 'orcamento_itens.item')
                                   ->join('tipo_item', 'tipo_item.id', 'orcamento_itens.tipo_item')
                                   ->where('inscricao_id', $inscricao->id)
                                   ->get(['orcamento_itens.*', 'item.nome as item', 'tipo_item.nome as tipoitem']);
                                
        $status = [
            'Deferido' => 'success',
            'Classificado' => 'success',
            'Salvo' => 'warning',
            'Submetido' => 'warning',
            'Avaliado' => 'success',
            'Indeferido' => 'danger',
            'Desclassificado' => 'danger'
        ];

        return view('inscricao.show', compact(
                'inscricao',
                'inscricoesAreaTematica',
                'linhaextensao',
                'respostasQuestoes',
                'itensOrcamento',
                'totalItens',
                'valorMaxPorInscricao',
                'avaliacaoResposta',
                'questoesAvaliacao',
                'criterios',
                'status'
            )
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inscricao $inscricao
     * @return \Illuminate\Http\Response
     */
    public function edit(Inscricao $inscricao)
    {
        $estados = Municipio::select('uf')->distinct('uf')->orderBy('uf')->get();
        $linhas_extensao = LinhaExtensao::all();
        $areas_tematicas = AreaTematica::all();
        $cronograma = new Cronograma();

        //$inscricao = Inscricao::findOrFail($id);
        $edital = Edital::findOrFail($inscricao->edital_id);
        $respostasQuestoes = DB::table('questoes_respondidas')->where('inscricao_id', $inscricao->id)->get();
        $inscricaoLocal = Municipio::select('uf', 'nome_municipio')->where('id', $inscricao->municipio_id)->get();

        return view(
                    'inscricao.create',
                    compact(
                            'edital',
                            'linhas_extensao',
                            'estados',
                            'inscricao',
                            'respostasQuestoes',
                            'inscricaoLocal',
                            'areas_tematicas',
                        )
                    );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inscricao $inscricao
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inscricao $inscricao)
    {
        $inputsParaValidar = $request->except(['estado', 'link_lattes', 'link_projeto', 'palavras_chaves']);
        $validar = array();

        foreach($inputsParaValidar as $key => $inputs) {
            if($key == 'resumo') {
                $validar[$key] = 'required|max:2500';
            }
            elseif($key == 'pdf_projeto') {
                $validar[$key] = 'mimes:pdf';
            }
            elseif($key == 'comprovante_parceria') {
                $validar[$key] = 'mimes:pdf';
            }
            elseif(substr($key, 0, 8) == 'questao-'){
                $validar[$key] = 'required|max:10000';
            }
            else {
                $validar[$key] = 'required|max:190';
            }
        }

        $mensagens = array();

        foreach($inputsParaValidar as $key => $inputs) {
            if(substr($key, 0, 8) == 'questao-') {
                $mensagens[$key.'.required'] = 'Uma questão complementar não foi preenchida';
                $mensagens[$key.'.max'] = 'Uma questão complementar ultrapassou o máximo permitido de caracteres';
            }
        }

        $validar['areas_tematicas'] = 'required';
        $validar['pdf_projeto'] = 'mimes:pdf';

        $validated = $request->validate($validar,$mensagens);

        $user = User::where('email', Auth::user()->id)->first();

        //$inscricao = Inscricao::findOrFail($id);
        $areasTematicasInsert = array();
        $respostasQuestoesInsert = array();
        $upload = new UploadFile();
        /* Atualização no banco de dados usando transação, caso alguma atualização de erro ele retorna o banco ao estado anterior */
        $transacao = DB::transaction(function() use( $request, $areasTematicasInsert, $respostasQuestoesInsert, $upload, $user, $inscricao) {

            $inscricao->titulo = $request->titulo;
            $inscricao->tipo = $request->tipo_extensao;
            $inscricao->municipio_id = $request->cidade;
            $inscricao->resumo = $request->resumo;
            $inscricao->palavras_chaves = $request->palavras_chaves;
            $inscricao->parceria = $request->parceria;
            if($request->comprovante_parceria != null || $request->comprovante_parceria != '') {
                $inscricao->anexo_parceria = $upload->execute($request, 'comprovante_parceria', 'pdf', 3000000);
            }
            if($request->pdf_projeto != null || $request->pdf_projeto != '') {
                $inscricao->anexo_projeto = $upload->execute($request, 'pdf_projeto', 'pdf', 3000000);
            }
            $inscricao->url_projeto = $request->link_projeto;
            $inscricao->url_lattes = $request->link_lattes;
            $inscricao->linha_extensao_id = $request->linha_extensao;
            $inscricaoAtualizada = $inscricao->save();

            DB::table('inscricoes_areas_tematicas')->where('inscricao_id', $inscricao->id)->delete();
            foreach($request->areas_tematicas as $area) {
                DB::table('inscricoes_areas_tematicas')->insert([
                    'area_tematica_id' => $area,
                    'inscricao_id' => $inscricao->id
                ]);
            }

            foreach($request->all() as $key => $resposta) {
                if(substr($key, 0, 8) == 'questao-') {
                    DB::table('questoes_respondidas')->where('inscricao_id', $inscricao->id)->where('questao_id', substr($key, 8, strlen($key)))->update([
                        'resposta' => $resposta
                    ]);
                }
            }

            return $inscricaoAtualizada;
        });

        if(is_null($transacao) || empty($transacao)) {
            session()->flash('status', 'Desculpe! Houve erro ao enviar a inscrição');
            session()->flash('alert', 'danger');

            return redirect()->back();
        }
        else {
            session()->flash('status', 'Inscrição atualizada com sucesso.');
            session()->flash('alert', 'success');

            return redirect()->to("inscricoes-enviadas");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inscricao $inscricao
     * @return \Illuminate\Http\Response
     */
    public function submeter(Inscricao $inscricao, Request $request)
    {
        //$inscricao = Inscricao::findOrFail($id);
       
        if($inscricao->status === 'Submetido') {
            session()->flash('status', 'Inscrição já submetida.');
            session()->flash('alert', 'success');

            return redirect()->back();
        }

        if( empty($inscricao->orcamento->toArray()) ) {
            session()->flash('status', 'Desculpe! Para submeter é necessário o preenchimento do orçamento.');
            session()->flash('alert', 'danger');

            return redirect()->back();
        }

        $inscricao->status = 'Submetido';

        if($inscricao->save()) {
            Log::channel('inscricao')->info('Usuario Nome: ' . $inscricao->user->name . ' - Usuario ID: ' . $inscricao->user->id . ' - Operação: Submissao de inscricao ' . $inscricao->id . ' - Endereço IP: ' . $request->ip());
            $inscricao->user->notify(new \App\Notifications\InscricaoSubmetida($inscricao));
            session()->flash('status', 'Inscrição submetida com sucesso.');
            session()->flash('alert', 'success');

            return redirect()->back();
        }
        else {
            Log::channel('inscricao')->error('Usuario Nome: ' . $inscricao->user->name . ' - Usuario ID: ' . $inscricao->user->id . ' - Operação: Submissao de inscricao ' . $inscricao->id . ' - Endereço IP: ' . $request->ip());
            session()->flash('status', 'Desculpe! Houve erro ao submeter sua inscrição');
            session()->flash('alert', 'danger');

            return redirect()->back();
        }
    }

    /**
     * @param  \App\Models\Inscricao $inscricao
     * @return \Illuminate\Http\Response
     */
    public function indicarAvaliador(Inscricao $inscricao)
    {
        //$inscricao = Inscricao::findOrFail($id);
        $users = User::all();

        $user = User::where('email', Auth::user()->id)->first();

        if($inscricao->user_id == $user->id) {
            session()->flash('status', 'Desculpe! Não é permitido adicionar avaliadores à própria inscrição');
            session()->flash('alert', 'danger');

            return redirect()->back();
        }

        return view('inscricao.avaliadores', compact('inscricao', 'users'));
    }

    /**
     * @param  \App\Models\Inscricao $inscricao
     * @return \Illuminate\Http\Response
     */
    public function indicarAnalista(Inscricao $inscricao)
    {
        //$inscricao = Inscricao::findOrFail($id);
        $users = User::all();

        $user = User::where('email', Auth::user()->id)->first();

        if($inscricao->user_id == $user->id) {
            session()->flash('status', 'Desculpe! Não é permitido adicionar avaliadores à própria inscrição');
            session()->flash('alert', 'danger');

            return redirect()->back();
        }

        return view('inscricao.indicar-analista', compact('inscricao', 'users'));
    }

    /**     
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Inscricao $inscricao
    * @return \Illuminate\Http\Response
    *
    */
    public function indicarAnalistaStore(Request $request, Inscricao $inscricao)
    {
        $validated = $request->validate([
            'analista_id' => 'required',
        ]);

        //$inscricao = Inscricao::findOrFail($id);
        $inscricao->analista_user_id = $request->analista_id;

        if($inscricao->update()) {
            session()->flash('status', 'Analista cadastrado com sucesso.');
            session()->flash('alert', 'success');

            return redirect()->back();
        }

    }

    /**     
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Inscricao $inscricao
    * @return \Illuminate\Http\Response
    *
    */
    public function indicarAnalistaDelete(Request $request, Inscricao $inscricao)
    {
        //$inscricao = Inscricao::findOrFail($id);
        $inscricao->analista_user_id = NULL;
        
        if($inscricao->update()) {
            session()->flash('status', 'Analista removido com sucesso.');
            session()->flash('alert', 'success');

            return redirect()->back();
        }

    }

    /**     
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Inscricao $inscricao
    * @return \Illuminate\Http\Response
    *
    */
    public function avaliacao(Request $request, Inscricao $inscricao)
    {
        $user = User::where('email', Auth::user()->id)->first();
        
        if(isset($request->tipo_avaliacao)) {
            $tipo_avaliacao = [
                'subcomissao' => new Subcomissao(),
                'parecerista' => new Parecerista(),
                'comissao1' => new Comissao1(),
            ];
    
            $avaliacao = new Avaliacao($tipo_avaliacao[$request->tipo_avaliacao]);
    
            $resposta = $avaliacao->execute($request, $inscricao, $user);

            unset($tipo_avaliacao);
            
            return redirect()->to($resposta['redirect']);
        }
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function inscricoesPorUsuario()
    {
        $user = User::where('email', Auth::user()->id)->first();

        if( $user->hasRole('edital-coordenador|edital-analista|edital-avaliador|edital-administrador|super|admin') ) {

            $inscricoes = Inscricao::all();
            $inscricoes = $inscricoes->filter(function($value, $key) use ($user) {
                return data_get($value, 'user_id') == $user->id;
            });

            $status = [
                'Deferido' => 'success',
                'Classificado' => 'success',
                'Salvo' => 'warning',
                'Submetido' => 'warning',
                'Avaliado' => 'success',
                'Indeferido' => 'danger',
                'Desclassificado' => 'danger'
            ];

            $cronograma = new Cronograma();
            return view('inscricao.enviadas', compact('inscricoes', 'user', 'cronograma', 'status'));
        }

        session()->flash('status', 'Desculpe! Acesso não autorizado');
        session()->flash('alert', 'warning');

        return redirect()->back();
    }
}
