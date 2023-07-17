<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

use App\Models\Arquivo;
use App\Models\Edital;
use App\Models\Inscricao;
use App\Models\AvaliadorPorInscricao;
use App\Models\InscricaoAreaTematica;
use App\Models\AreaTematica;
use App\Models\UploadFile;
use App\Models\Orcamento;
use App\Models\ObjetivoDesenvolvimentoSustentavel;
use App\Models\QuestaoRespondida;
use App\Models\LinhaExtensao;
use App\Models\User;
use App\Models\Municipio;
use App\Models\Cronograma;
use App\Models\ComissaoUser;
use App\Models\RespostasAvaliacoes;
use App\Models\Parecer;

use App\Services\Avaliacao\Comissao1;
use App\Services\Avaliacao\Parecerista;
use App\Services\Avaliacao\Subcomissao;

use App\Services\Avaliacao;
use App\Services\InscricaoEdital\ChecaPublicoAlvo;

class InscricaoController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:edital-coordenador|edital-administrador|super|admin')->except('create', 'store', 'show', 'edit', 'update', 'inscricoesPorUsuario');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        session()->flash('status', 'Desculpe! O acesso as inscrições agora é feito através do menu Editais.');
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
        if(ChecaPublicoAlvo::execute($id)) {
            return redirect()->back();
        }
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
        $ods = ObjetivoDesenvolvimentoSustentavel::all();

        return view('inscricao.create', compact('edital', 'linhas_extensao', 'estados', 'areas_tematicas', 'ods'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(ChecaPublicoAlvo::execute($request->edital_id)) {
            return redirect()->back();
        }

        $inputsParaValidar = $request->except(['estado']);
        $validar = array();

        foreach($inputsParaValidar as $key => $inputs) {
            if($key == 'resumo') {
                $validar[$key] = 'required|max:2500';
            }
            elseif($key == 'palavras_chaves') {
                $validar[$key] = 'max:190';
            }
            // elseif($key == 'pdf_projeto') {
            //     $validar[$key] = 'required|mimes:pdf';
            // }
            elseif($key == 'comprovante_parceria') {
                $validar[$key] = 'file|max:5120|mimes:pdf';
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
        $validar['obj_desenvolvimento_sustentavel'] = 'required';
        $validar['pdf_projeto'] = 'required|file|max:5120|mimes:pdf';
        $validar['link_lattes'] = 'max:190';
        $validar['link_projeto'] = 'max:190';
        $validar['cidade'] = 'required';

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
        $odsInsert = array();
        $respostasQuestoesInsert = array();
        $upload = new UploadFile();
        /* Inserção no banco de dados usando transação, caso alguma inserção de erro ele retorna o banco ao estado anterior */
        $inscricao = DB::transaction(function() use( $request, $areasTematicasInsert, $odsInsert, $respostasQuestoesInsert, $upload, $user) {
            /* Faz a inserção da inscrição */
            $inscricaoCriada = Inscricao::create([
                'titulo' => $request->titulo,
                'tipo' => $request->tipo_extensao,
                'municipio_id' => $request->cidade,
                'resumo' => $request->resumo,
                'palavras_chaves' => $request->palavras_chaves,
                'parceria' => $request->parceria,
                'anexo_parceria' => !!$request->comprovante_parceria ? $upload->execute($request, 'comprovante_parceria', 'pdf', 5000000) : '',
                'anexo_projeto' => $upload->execute($request, 'pdf_projeto', 'pdf', 5000000),
                'url_projeto' => $request->link_projeto,
                'url_lattes' => $request->link_lattes,
                'status' => 'Salvo',
                'linha_extensao_id' => $request->linha_extensao,
                'user_id' => $user->id,
                'unidade_id' => $user->unidade->id,
                'edital_id' => $request->edital_id,
                'qtde_alunos' => $request->qtde_alunos,
                'qtde_alunos_pg' => $request->qtde_alunos_pg,
                'qtde_alunos_ct' => $request->qtde_alunos_ct
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
            
            /* Prepara os dados para inserção das ODS */
            foreach($request->obj_desenvolvimento_sustentavel as $ods) {
                array_push($odsInsert,[
                    'objetivo_desenvolvimento_sustentavel_id' => $ods,
                    'inscricao_id' => $inscricaoCriada->id
                ]);
            }
            /* faz a inserção das ODS's */
            DB::table('inscricoes_editais_ods')->insert($odsInsert);

            /* prepara os dados para inserção das respostas das questões complementares */
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

        $userNaComissao = ComissaoUser::join('comissoes', 'comissoes.id', 'comissoes_users.comissao_id')
                                ->where('comissoes.edital_id', $inscricao->edital_id)
                                ->where('comissoes_users.user_id', $user->id)
                                ->first();

        $avaliadorPorInscricao = AvaliadorPorInscricao::where('inscricao_id', $inscricao->id)
                                ->where('user_id', $user->id)
                                ->first();

        if($userNaComissao || $avaliadorPorInscricao || $inscricao->user_id == $user->id || $user->hasRole('edital-administrador')) {
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

            $respostasQuestoes = QuestaoRespondida::join(
                'questoes', 'questoes_respondidas.questao_id',
                'questoes.id'
                )->where('questoes_respondidas.inscricao_id', $inscricao->id)
                ->get();


            $criterios = $edital->criterios;

            $questoesAvaliacao = $edital->questoes->filter(function($value, $key) {
                return data_get($value, 'tipo') == 'Avaliativa';
            });

            $notasAvaliacao = RespostasAvaliacoes::select('questoes.enunciado', 'respostas_avaliacoes.valor')
                                                    ->join('questoes', 'questoes.id', 'respostas_avaliacoes.questao_id')
                                                    ->where('respostas_avaliacoes.inscricao_id', $inscricao->id)
                                                    ->get();

            $parecerAvaliacao = Parecer::select('users.name', 'pareceres.justificativa', 'pareceres.parecer')
                                       ->join('inscricoes', 'inscricoes.id', 'pareceres.inscricao_id')
                                       ->join('users', 'users.id', 'inscricoes.user_id')
                                       ->where('inscricoes.id', $inscricao->id)
                                       ->get();

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
                'Desclassificado' => 'danger',
                'Contemplado' => 'success'
            ];

            return view('inscricao.show-novo', compact(
                    'inscricao',
                    'respostasQuestoes',
                    'itensOrcamento',
                    'totalItens',
                    'valorMaxPorInscricao',
                    'avaliacaoResposta',
                    'notasAvaliacao',
                    'questoesAvaliacao',
                    'parecerAvaliacao',
                    'criterios',
                    'status',
                    'cronograma',
                    'user'
                )
            );
        }
        else {
            session()->flash('status', 'Acesso não autorizado para visualização.');
            session()->flash('alert', 'warning');

            return redirect()->back();
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inscricao $inscricao
     */
    public function showCompleto($id){
        $inscricao = \App\Models\Inscricao::find($id);
    
        $respostasQuestoes = \App\Models\QuestaoRespondida::join(
            'questoes', 'questoes_respondidas.questao_id',
            'questoes.id'
            )->where('questoes_respondidas.inscricao_id', $inscricao->id)
            ->get();
    
        $questoesAvaliacao = $inscricao->edital->questoes->filter(function($value, $key) {
            return data_get($value, 'tipo') == 'Avaliativa';
        });
    
        $notasAvaliacao = \App\Models\RespostasAvaliacoes::select('questoes.enunciado', 'respostas_avaliacoes.valor', 'respostas_avaliacoes.updated_at')
                                                ->join('questoes', 'questoes.id', 'respostas_avaliacoes.questao_id')
                                                ->where('respostas_avaliacoes.inscricao_id', $inscricao->id)
                                                ->get();
    
        $parecerAvaliacao = \App\Models\Parecer::select('users.name', 'pareceres.justificativa', 'pareceres.parecer')
                                   ->join('inscricoes', 'inscricoes.id', 'pareceres.inscricao_id')
                                   ->join('users', 'users.id', 'inscricoes.user_id')
                                   ->where('inscricoes.id', $inscricao->id)
                                   ->get();
    
        $valorMaxPorInscricao = $inscricao->tipo == 'Programa' ? $inscricao->edital->valor_max_programa : $inscricao->edital->valor_max_inscricao;
    
        $totalItens = \App\Models\Orcamento::where('inscricao_id', $inscricao->id)->sum('valor');
        $itensOrcamento = \App\Models\Orcamento::join('item', 'item.id', 'orcamento_itens.item')
                                    ->join('tipo_item', 'tipo_item.id', 'orcamento_itens.tipo_item')
                                    ->where('inscricao_id', $inscricao->id)
                                    ->get(['orcamento_itens.*', 'item.nome as item', 'tipo_item.nome as tipoitem']);

        $arquivos = Arquivo::where('modulo', 'editais')->where('referencia_id', $inscricao->id)->get(['nome_arquivo', 'url_arquivo']);

        $status = [
            'Deferido' => 'success',
            'Classificado' => 'success',
            'Salvo' => 'warning',
            'Submetido' => 'warning',
            'Avaliado' => 'success',
            'Indeferido' => 'danger',
            'Desclassificado' => 'danger',
            'Contemplado' => 'success'
        ];
        
        return view('inscricao.show-completo', 
            compact(
                    'inscricao', 
                    'totalItens', 
                    'itensOrcamento', 
                    'questoesAvaliacao', 
                    'notasAvaliacao',
                    'parecerAvaliacao',
                    'valorMaxPorInscricao',
                    'respostasQuestoes',
                    'status',
                    'arquivos'
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
        $user = User::where('email', Auth::user()->id)->first();
        $estados = Municipio::select('uf')->distinct('uf')->orderBy('uf')->get();
        $linhas_extensao = LinhaExtensao::all();
        $areas_tematicas = AreaTematica::all();
        $ods = ObjetivoDesenvolvimentoSustentavel::all();
        $cronograma = new Cronograma();

        if( $inscricao->user_id == $user->id || $user->hasRole('edital-administrador') ) {
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
                            'ods'
                        )
                    );
        }
        else {
            session()->flash('status', 'Desculpe! Não é permitido editar outra inscrião a não ser a sua.');
            session()->flash('alert', 'danger');

            return redirect()->back();
        }


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
        $user = User::where('email', Auth::user()->id)->first();
        if( $inscricao->user_id != $user->id || !$user->hasRole('edital-administrador') ) {
            session()->flash('status', 'Desculpe! Somente o coordenador pode editar');
            session()->flash('alert', 'danger');

            return redirect()->back();
        }
        
        $inputsParaValidar = $request->except(['estado', 'link_lattes', 'link_projeto', 'palavras_chaves']);
        $validar = array();

        foreach($inputsParaValidar as $key => $inputs) {
            if($key == 'resumo') {
                $validar[$key] = 'required|max:2500';
            }
            // elseif($key == 'pdf_projeto') {
            //     $validar[$key] = 'file:1,5120|mimes:pdf';
            // }
            elseif($key == 'comprovante_parceria') {
                $validar[$key] = 'file|max:5120|mimes:pdf';
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
        $validar['obj_desenvolvimento_sustentavel'] = 'required';
        $validar['pdf_projeto'] = 'required|file|max:5120|mimes:pdf';

        $validated = $request->validate($validar,$mensagens);

        //$inscricao = Inscricao::findOrFail($id);
        $areasTematicasInsert = array();
        $odsInsert = array();
        $respostasQuestoesInsert = array();
        $upload = new UploadFile();
        /* Atualização no banco de dados usando transação, caso alguma atualização de erro ele retorna o banco ao estado anterior */
        $transacao = DB::transaction(function() use( $request, $areasTematicasInsert,  $odsInsert, $respostasQuestoesInsert, $upload, $user, $inscricao) {

            $inscricao->titulo = $request->titulo;
            $inscricao->tipo = $request->tipo_extensao;
            $inscricao->municipio_id = $request->cidade;
            $inscricao->resumo = $request->resumo;
            $inscricao->palavras_chaves = $request->palavras_chaves;
            $inscricao->parceria = $request->parceria;
            if($request->comprovante_parceria != null || $request->comprovante_parceria != '') {
                $inscricao->anexo_parceria = $upload->execute($request, 'comprovante_parceria', 'pdf', 5000000);
            }
            if($request->pdf_projeto != null || $request->pdf_projeto != '') {
                $inscricao->anexo_projeto = $upload->execute($request, 'pdf_projeto', 'pdf', 5000000);
            }
            $inscricao->url_projeto = $request->link_projeto;
            $inscricao->url_lattes = $request->link_lattes;
            $inscricao->linha_extensao_id = $request->linha_extensao;
            $inscricao->qtde_alunos = $request->qtde_alunos;
            $inscricao->qtde_alunos_pg = $request->qtde_alunos_pg;
            $inscricaoAtualizada = $inscricao->save();

            DB::table('inscricoes_areas_tematicas')->where('inscricao_id', $inscricao->id)->delete();
            foreach($request->areas_tematicas as $area) {
                DB::table('inscricoes_areas_tematicas')->insert([
                    'area_tematica_id' => $area,
                    'inscricao_id' => $inscricao->id
                ]);
            }

            DB::table('inscricoes_editais_ods')->where('inscricao_id', $inscricao->id)->delete();
            foreach($request->obj_desenvolvimento_sustentavel as $ods) {
                DB::table('inscricoes_editais_ods')->insert([
                    'objetivo_desenvolvimento_sustentavel_id' => $ods,
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

            return redirect()->to("edital/$inscricao->edital_id/suas-inscricoes");
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
     * Display a listing of the resource.
     * @param  \App\Models\Edital $edital
     * @return \Illuminate\Http\Response
     */
    public function inscricoesPorUsuario(Edital $edital)
    {
        $user = User::where('email', Auth::user()->id)->first();

        if( $user->hasRole('edital-coordenador|edital-analista|edital-avaliador|edital-administrador|super|admin') ) {

            $inscricoes = Inscricao::where('user_id', $user->id)->where('edital_id', $edital->id)->get();

            $status = [
                'Deferido' => 'success',
                'Classificado' => 'success',
                'Salvo' => 'warning',
                'Submetido' => 'warning',
                'Avaliado' => 'success',
                'Indeferido' => 'danger',
                'Desclassificado' => 'danger',
                'Contemplado' => 'success'
            ];

            $cronograma = new Cronograma();
            return view('inscricao.enviadas', compact('inscricoes', 'user', 'cronograma', 'status'));
        }

        session()->flash('status', 'Desculpe! Acesso não autorizado');
        session()->flash('alert', 'warning');

        return redirect()->back();
    }

    /**
    * 
    * @param  \App\Models\Edital $edital
    * @return \Illuminate\Http\Response
    *
    */
    public function inscricoesPorEdital(Edital $edital) 
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
            'Desclassificado' => 'danger',
            'Contemplado' => 'success'
        ];

        /* lista todas as inscrições se o user for administrador */
        if($user->hasRole('edital-administrador')) {
            $inscricoes = Inscricao::orderBy('titulo', 'asc')->where('edital_id', $edital->id)->get();

            return view('inscricao.index', compact('inscricoes', 'user', 'cronograma', 'status'));
        }

        $userNaComissao = ComissaoUser::join('comissoes', 'comissoes.id', 'comissoes_users.comissao_id')
                                ->where('comissoes.edital_id', $edital->id)
                                ->where('comissoes_users.user_id', $user->id)
                                ->first();
        if($userNaComissao) {
            /* Lista as incrições se o user estiver em uma comissão */
            // if($edital->tipo === 'PEX') {
            //     $inscricoes = Inscricao::join('comissoes', 'comissoes.edital_id', 'inscricoes.edital_id')
            //         ->join('comissoes_users as cu', 'cu.comissao_id', 'comissoes.id')
            //         ->join('unidades', 'unidades.id', 'inscricoes.unidade_id')
            //         ->join('subcomissao_tematica', 'unidades.subcomissao_tematica_id', 'subcomissao_tematica.id')
            //         ->where('subcomissao_tematica.id', $user->unidade->subcomissao_tematica_id)
            //         ->where('cu.user_id', $user->id)
            //         ->where('inscricoes.edital_id', $edital->id)
            //         ->distinct()
            //         ->get(['inscricoes.*', 'comissoes.atribuicao']);
            // }
            // else {
                $inscricoes = Inscricao::join('comissoes', 'comissoes.edital_id', 'inscricoes.edital_id')
                    ->join('comissoes_users as cu', 'cu.comissao_id', 'comissoes.id')
                    //->join('unidades', 'unidades.id', 'inscricoes.unidade_id')
                    ->where('cu.user_id', $user->id)
                    ->where('inscricoes.edital_id', $edital->id)
                    ->distinct()
                    ->get(['inscricoes.*', 'comissoes.atribuicao']);
            // }         
            
            return view('inscricao.index', compact('inscricoes', 'user', 'cronograma', 'status'));
        }

        $avaliadorPorInscricao = AvaliadorPorInscricao::where('user_id', $user->id)->first();
    
        if($avaliadorPorInscricao) {
            $inscricoes = Inscricao::join('avaliadores_por_inscricao as ai', 'ai.inscricao_id', 'inscricoes.id')
                                ->where('ai.user_id', $user->id)
                                ->where('inscricoes.edital_id', $edital->id)
                                ->get(['inscricoes.*']);

            return view('inscricao.index', compact('inscricoes', 'user', 'cronograma', 'status'));
        }

        session()->flash('status', 'Desculpe! Acesso não autorizado');
        session()->flash('alert', 'warning');

        return redirect()->back();
    }

    
    public function contemplar(Request $request, Inscricao $inscricao)
    {
        $inscricao->qtde_contemplacao = $request->contemplacao;
        $inscricao->status = 'Contemplado';

        if($inscricao->update()) {
            session()->flash('status', 'Contemplado com sucesso!');
            session()->flash('alert', 'success');

            return redirect()->back();
        }
        else {
            session()->flash('status', 'Desculpe! Houve erro ao contemplar!');
            session()->flash('alert', 'warning');

            return redirect()->back();
        }
    }  
}
