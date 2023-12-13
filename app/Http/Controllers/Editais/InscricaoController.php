<?php

namespace App\Http\Controllers\Editais;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;
use PDF;
use ZipArchive;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Notification;

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
use App\Services\InscricaoEdital\ChecaInscricaoAberta;
use App\Services\InscricaoEdital\ChecaUserInscrito;
use App\Services\InscricaoEdital\ChecaPeriodoInscricao;
use App\Services\InscricaoEdital\ValidarDadosInscricao;
use App\Services\InscricaoEdital\CriarInscricao;
use App\Services\InscricaoEdital\ValidaSubmissao;

use App\Notifications\EditalRealtorioFinalComissaoNotificar;

class InscricaoController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:edital-coordenador|edital-administrador|super|admin')->except('create', 'store', 'show', 'edit', 'update', 'inscricoesPorUsuario', 'submeter', 'relatorioFinalCriar', 'relatorioFinalUpload', 'relatorioFinalComprovarDespesas', 'relatorioFinalEnviarAprovacao');
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
        if(App::environment('local')){
            $user = User::where('id', 1)->first();
        } else {
            $user = User::where('email', Auth::user()->id)->first();
        }

        $edital = Edital::find($id);
        $totalInscricoes = $edital->inscricoes->count();
        $editalRecursoChecado = $totalInscricoes * $edital->valor_max_inscricao;

        if($editalRecursoChecado > $edital->total_recurso && $edital->tipo == "Fluxo Contínuo") {
            session()->flash('status', 'Desculpe! O total de recurso esta esgotado.');
            session()->flash('alert', 'warning');

            return redirect()->back();
        }

        if(ChecaPublicoAlvo::execute($id)) {
            return redirect()->back();
        }
        /* Checagem se o user já é inscrito no edital ou se possui uma inscrição em aberto em outros editais */

        if(ChecaUserInscrito::execute($id, $user) && ChecaInscricaoAberta::execute($id, $user)){
            return redirect()->back();
        }

        /* Checa se está no período de inscrições */
        if(ChecaPeriodoInscricao::execute($id)){
            return redirect()->back();
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
        ValidarDadosInscricao::execute($request);

        if(App::environment('local')){
            $user = User::where('id', 2)->first();
        } else {
            $user = User::where('email', Auth::user()->id)->first();
        }

        if(ChecaPublicoAlvo::execute($request->edital_id)) {
            return redirect()->back();
        }

        /* Checagem se o user já é inscrito no edital ou se possui uma inscrição em aberto em outros editais */
        if(ChecaUserInscrito::execute($request->edital_id, $user) && ChecaInscricaoAberta::execute($request->edital_id, $user)){
            return redirect()->back();
        }

        /* Inserção no banco de dados usando transação, caso alguma inserção de erro ele retorna o banco ao estado anterior */
        $inscricao = CriarInscricao::execute($request, $user);
       
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
        if(App::environment('local')){
            $user = User::where('id', 2)->first();
        } else {
            $user = User::where('email', Auth::user()->id)->first();
        }
        //$inscricao = Inscricao::find($id);
        $edital = Edital::findOrFail($inscricao->edital_id);
        $cronograma = new Cronograma();
        $avaliacaoResposta = false;

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

            $notasAvaliacao = RespostasAvaliacoes::select('questoes.enunciado', 'respostas_avaliacoes.valor', 'respostas_avaliacoes.user_id')
                                                    ->join('questoes', 'questoes.id', 'respostas_avaliacoes.questao_id')
                                                    ->where('respostas_avaliacoes.inscricao_id', $inscricao->id)
                                                    ->get();

            $parecerAvaliacao = Parecer::select('users.name', 'pareceres.justificativa', 'pareceres.parecer', 'pareceres.user_id')
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
                'Contemplado' => 'success',
                'Relatório em Análise' => 'warning',
                'Concluído' => 'success',
                'Bloqueado' => 'danger',
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
                    'user',
                    'userNaComissao'
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
    
        $notasAvaliacao = \App\Models\RespostasAvaliacoes::select('questoes.enunciado', 'respostas_avaliacoes.valor', 'respostas_avaliacoes.updated_at', 'respostas_avaliacoes.user_id')
                                                ->join('questoes', 'questoes.id', 'respostas_avaliacoes.questao_id')
                                                ->where('respostas_avaliacoes.inscricao_id', $inscricao->id)
                                                ->get();
    
        $parecerAvaliacao = \App\Models\Parecer::select('users.name', 'pareceres.justificativa', 'pareceres.parecer', 'pareceres.user_id')
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
            'Contemplado' => 'success',
            'Relatório em Análise' => 'warning',
            'Concluído' => 'success',
            'Bloqueado' => 'danger',
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
        if(App::environment('local')){
            $user = User::where('id', 2)->first();
        } else {
            $user = User::where('email', Auth::user()->id)->first();
        }

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
        if(App::environment('local')){
            $user = User::where('id', 2)->first();
        } else {
            $user = User::where('email', Auth::user()->id)->first();
        }

        if( $inscricao->user_id != $user->id ) {
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
            Log::channel('inscricao')->error('Usuario Nome: ' . $user->name . ' - Usuario ID: ' . $user->id . ' - Operação: Erro ao atualizar inscricao ' . $inscricao->id . ' - Endereço IP: ' . $request->ip());
            session()->flash('status', 'Desculpe! Houve erro ao enviar a inscrição');
            session()->flash('alert', 'danger');

            return redirect()->back();
        }
        else {
            Log::channel('inscricao')->info('Usuario Nome: ' . $user->name . ' - Usuario ID: ' . $user->id . ' - Operação: Inscricao atualizada ' . $inscricao->id . ' - Endereço IP: ' . $request->ip());
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
        if(App::environment('local')){
            $user = User::where('id', 2)->first();
        } else {
            $user = User::where('email', Auth::user()->id)->first();
        }

        if(ValidaSubmissao::execute($inscricao, $user)){
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
            Log::channel('inscricao')->error('Usuario Nome: ' . $inscricao->user->name . ' - Usuario ID: ' . $inscricao->user->id . ' - Operação: Erro na submissao de inscricao ' . $inscricao->id . ' - Endereço IP: ' . $request->ip());
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
        if(App::environment('local')){
            $user = User::where('id', 2)->first();
        } else {
            $user = User::where('email', Auth::user()->id)->first();
        }

        if( $user->hasRole('edital-coordenador|edital-analista|edital-avaliador|edital-administrador|super|admin') || !ChecaPublicoAlvo::execute($edital->id) ) {

            $inscricoes = Inscricao::where('user_id', $user->id)->where('edital_id', $edital->id)->get();

            $status = [
                'Deferido' => 'success',
                'Classificado' => 'success',
                'Salvo' => 'warning',
                'Submetido' => 'warning',
                'Avaliado' => 'success',
                'Indeferido' => 'danger',
                'Desclassificado' => 'danger',
                'Contemplado' => 'success',
                'Relatório em Análise' => 'warning',
                'Concluído' => 'success',
                'Bloqueado' => 'danger',
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
        if(App::environment('local')){
            $user = User::where('id', 2)->first();
        } else {
            $user = User::where('email', Auth::user()->id)->first();
        }

        $cronograma = new Cronograma();

        $status = [
            'Submetido' => 'warning',
            'Salvo' => 'warning',
            'Deferido' => 'success',
            'Classificado' => 'success',
            'Avaliado' => 'primary',
            'Indeferido' => 'danger',
            'Desclassificado' => 'danger',
            'Contemplado' => 'success',
            'Relatório em Análise' => 'warning',
            'Concluído' => 'success',
            'Bloqueado' => 'danger',
        ];

        $userNaComissao = ComissaoUser::join('comissoes', 'comissoes.id', 'comissoes_users.comissao_id')
            ->where('comissoes.edital_id', $edital->id)
            ->where('comissoes_users.user_id', $user->id)
            ->first();

        $avaliadorPorInscricao = AvaliadorPorInscricao::where('user_id', $user->id)->first();

        /* lista todas as inscrições se o user for administrador */
        if($user->hasRole('edital-administrador')) {
            $inscricoes = Inscricao::orderBy('titulo', 'asc')->where('edital_id', $edital->id)->get();

            return view('inscricao.index', compact('edital', 'inscricoes', 'user', 'cronograma', 'status', 'userNaComissao', 'avaliadorPorInscricao'));
        }

       
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
            
            return view('inscricao.index', compact('edital', 'inscricoes', 'user', 'cronograma', 'status', 'userNaComissao', 'userNaComissao', 'avaliadorPorInscricao'));
        }
    
        if($avaliadorPorInscricao) {
            $inscricoes = Inscricao::join('avaliadores_por_inscricao as ai', 'ai.inscricao_id', 'inscricoes.id')
                                ->where('ai.user_id', $user->id)
                                ->where('inscricoes.edital_id', $edital->id)
                                ->get(['inscricoes.*']);

            return view('inscricao.index', compact('edital', 'inscricoes', 'user', 'cronograma', 'status', 'userNaComissao', 'avaliadorPorInscricao'));
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
            //notificar user inscricao
            Log::channel('inscricao')->info('Usuario Nome: ' . Auth::user()->name . ' - Usuario ID: ' . Auth::user()->id . ' - Operação: inscricao contemplada' . $inscricao->id . ' - Endereço IP: ' . $request->ip());
            session()->flash('status', 'Contemplado com sucesso!');
            session()->flash('alert', 'success');

            return redirect()->back();
        }
        else {
            Log::channel('inscricao')->error('Usuario Nome: ' . Auth::user()->name . ' - Usuario ID: ' . Auth::user()->id . ' - Operação: Error na inscricao contemplada' . $inscricao->id . ' - Endereço IP: ' . $request->ip());
            session()->flash('status', 'Desculpe! Houve erro ao contemplar!');
            session()->flash('alert', 'warning');

            return redirect()->back();
        }
    }

    public function relatorioFinalCriar(Inscricao $inscricao)
    {
        if(App::environment('local')){
            $user = User::where('id', 2)->first();
        } else {
            $user = User::where('email', Auth::user()->id)->first();
        }

        if( $inscricao->user_id != $user->id ) {
            session()->flash('status', 'Desculpe! Somente o coordenador pode editar');
            session()->flash('alert', 'danger');

            return redirect()->back();
        }

        $cronograma = new Cronograma();
        
        if(
            (
                strtotime(date('Y-m-d')) >= strtotime($cronograma->getDate('dt_fim_execucao', $inscricao->edital_id)) 
                && 
                strtotime(date('Y-m-d')) <= strtotime($cronograma->getDate('dt_fim_relatorio', $inscricao->edital_id))
                &&
                $inscricao->tipo == 'Projeto'
            )
            ||
            (
                strtotime(date('Y-m-d')) >= strtotime($cronograma->getDate('dt_fim_execucao_programa', $inscricao->edital_id)) 
                && 
                strtotime(date('Y-m-d')) <= strtotime($cronograma->getDate('dt_fim_relatorio_programa', $inscricao->edital_id))
                &&
                $inscricao->tipo == 'Programa'
            )
            || 
            (
                $inscricao->edital->tipo == 'Fluxo Contínuo'
            )

        ) {
            return view('inscricao.relatorio-final.create', compact('inscricao'));
        }
        else{
            session()->flash('status', 'Desculpe! Esta fora do período de envio do relatório final.');
            session()->flash('alert', 'danger');

            return redirect()->back();
        }
        
    }

    public function relatorioFinalAdicionarTempoExecucao(Request $request, Inscricao $inscricao){
        $validated = $request->validate([
            'execucao_inicio' => 'required|date',
            'execucao_fim' => 'required|date',
        ]);

        $dataInicio = strtotime($request->execucao_inicio);
        $dataFim = strtotime($request->execucao_fim);

        if($inscricao->status == 'Contemplado' && $dataInicio <= $dataFim) {
            $inscricao->execucao_inicio = $request->execucao_inicio;
            $inscricao->execucao_fim = $request->execucao_fim;
            Log::channel('inscricao')->info('Usuario Nome: ' . Auth::user()->name . ' - Usuario ID: ' . Auth::user()->id . ' - Operação: Relatorio final adicionar tempo execucao incricao ID:' . $inscricao->id . ' - Endereço IP: ' . $request->ip());
            $inscricao->update();
            
            session()->flash('status', 'Data de execução registrada com sucesso.');
            session()->flash('alert', 'success');

            return redirect()->back();
        }
        else {
            Log::channel('inscricao')->error('Usuario Nome: ' . Auth::user()->name . ' - Usuario ID: ' . Auth::user()->id . ' - Operação: Relatorio final adicionar tempo execucao - Periodo de execução ja registrado ou a data de inicio da execução é maior que a data de fim da execução incricao ID:' . $inscricao->id . ' - Endereço IP: ' . $request->ip());
            session()->flash('status', 'Desculpe! Periodo de execução ja registrado ou a data de inicio da execução é maior que a data de fim da execução.');
            session()->flash('alert', 'warning');

            return redirect()->back();
        }

    }

    public function relatorioFinalUpload(Request $request, Inscricao $inscricao)
    {
        if(App::environment('local')){
            $user = User::where('id', 2)->first();
        } else {
            $user = User::where('email', Auth::user()->id)->first();
        }

        if( $inscricao->user_id != $user->id ) {
            session()->flash('status', 'Desculpe! Somente o coordenador pode editar');
            session()->flash('alert', 'danger');

            return redirect()->back();
        }

        $validated = $request->validate([
            'arquivo_relatorio' => 'required|file|max:5120|mimes:pdf',
        ]);

        $upload = new UploadFile();
        $inscricao->arquivo_relatorio = $upload->execute($request, 'arquivo_relatorio', 'pdf', 5000000);

        if($inscricao->update()) {
            Log::channel('inscricao')->info('Usuario Nome: ' . Auth::user()->name . ' - Usuario ID: ' . Auth::user()->id . ' - Operação: upload de arquivo no relatorio final da incricao ID: ' . $inscricao->id . ' - Endereço IP: ' . $request->ip());
            session()->flash('status', 'Arquivo enviado com sucesso!');
            session()->flash('alert', 'success');

            return redirect()->back();
        }
        else {
            Log::channel('inscricao')->error('Usuario Nome: ' . Auth::user()->name . ' - Usuario ID: ' . Auth::user()->id . ' - Operação: Erro no upload de arquivo no relatorio final da incricao ID: ' . $inscricao->id . ' - Endereço IP: ' . $request->ip());
            session()->flash('status', 'Desculpe! Houve erro ao enviar o arquivo!');
            session()->flash('alert', 'warning');

            return redirect()->back();
        }
    }

    public function relatorioFinalComprovarDespesas(Request $request, Inscricao $inscricao)
    {
        if(App::environment('local')){
            $user = User::where('id', 2)->first();
        } else {
            $user = User::where('email', Auth::user()->id)->first();
        }

        if( $inscricao->user_id != $user->id ) {
            session()->flash('status', 'Desculpe! Somente o coordenador pode editar');
            session()->flash('alert', 'danger');

            return redirect()->back();
        }

        $validated = $request->validate([
            'arquivo_comprovante' => 'required|file|max:5120|mimes:pdf',
            'total_orcamento_realizado' => 'required',
            'justificativa_orcamento_realizado' => 'required|max:1000',
        ]);

        $upload = new UploadFile();
        $inscricao->arquivo_prestacao_contas = $upload->execute($request, 'arquivo_comprovante', 'pdf', 5000000);
        $inscricao->total_orcamento_realizado = str_replace(',', '.', str_replace('.', '', $request->total_orcamento_realizado));
        $inscricao->justificativa_orcamento_realizado = $request->justificativa_orcamento_realizado;

        if($inscricao->update()) {
            Log::channel('inscricao')->info('Usuario Nome: ' . Auth::user()->name . ' - Usuario ID: ' . Auth::user()->id . ' - Operação: Comprovação de despesas no relatorio final da incricao ID: ' . $inscricao->id . ' - Endereço IP: ' . $request->ip());
            session()->flash('status', 'Dados enviado com sucesso!');
            session()->flash('alert', 'success');

            return redirect()->back();
        }
        else {
            Log::channel('inscricao')->error('Usuario Nome: ' . Auth::user()->name . ' - Usuario ID: ' . Auth::user()->id . ' - Operação: Erro na Comprovação de despesas no relatorio final da incricao ID: ' . $inscricao->id . ' - Endereço IP: ' . $request->ip());
            session()->flash('status', 'Desculpe! Houve erro ao enviar o dados!');
            session()->flash('alert', 'warning');

            return redirect()->back();
        }
    }

    public function relatorioFinalEnviarAprovacao(Request $request, Inscricao $inscricao)
    {
        if(App::environment('local')){
            $user = User::where('id', 2)->first();
        } else {
            $user = User::where('email', Auth::user()->id)->first();
        }

        if( $inscricao->user_id != $user->id ) {
            session()->flash('status', 'Desculpe! Somente o coordenador pode editar');
            session()->flash('alert', 'danger');

            return redirect()->back();
        }

        $inscricao->status = 'Relatório em Análise';

        if($inscricao->update()) {
            $users  = User::join('comissoes_users', 'comissoes_users.user_id', 'users.id')
            ->join('comissoes', 'comissoes_users.comissao_id', 'comissoes.id')
            ->where('comissoes.edital_id', $inscricao->edital_id)
            ->get(['users.email']);

            Notification::send($users, new EditalRealtorioFinalComissaoNotificar($inscricao));
            Log::channel('inscricao')->info('Usuario Nome: ' . $inscricao->user->name . ' - Usuario ID: ' . $inscricao->user->id . ' - Inscrição "'. $inscricao->titulo .'" enviada para aprovação do relatório final  - Endereço IP: ' . $request->ip());
            
            session()->flash('status', 'Relatório enviado para análise com sucesso!');
            session()->flash('alert', 'success');

            return redirect()->back();
        }
        else {
            Log::channel('inscricao')->error('Usuario Nome: ' . $inscricao->user->name . ' - Usuario ID: ' . $inscricao->user->id . ' - Inscrição "'. $inscricao->titulo .'" erro ao enviar para aprovação do relatório final  - Endereço IP: ' . $request->ip());
            session()->flash('status', 'Desculpe! Houve erro ao enviar o relatório!');
            session()->flash('alert', 'warning');

            return redirect()->to("inscricao/$inscricao->id");
        }
    }

    public function analisarRelatorioFinal(Request $request, Inscricao $inscricao)
    {
        $validated = $request->validate([
            'relatorio_final_status' => 'required',
            'relatorio_final_observacao' => 'required|max:1000',
        ]);

        if($request->relatorio_final_status == 'Aceito') {
            $inscricao->status = "Concluído";
        }
        elseif($request->relatorio_final_status == 'Negado') {
            $inscricao->status = "Bloqueado";
        }
        
        $inscricao->relatorio_final_status = $request->relatorio_final_status;
        $inscricao->relatorio_final_observacao = $request->relatorio_final_observacao;

        if($inscricao->update()) {

            $inscricao->user->notify(new \App\Notifications\InscricaoAnaliseRelatorioFinalNotificar($inscricao));
            Log::channel('inscricao')->info('Usuario Nome: ' . Auth::user()->name . ' - Usuario ID: ' . Auth::user()->id . ' - Inscrição "'. $inscricao->titulo .'" efetuado análise do relatório final  - Endereço IP: ' . $request->ip());
            
            session()->flash('status', 'Relatório analisado com sucesso!');
            session()->flash('alert', 'success');

            return redirect()->back();
        }
        else {
            Log::channel('inscricao')->error('Usuario Nome: ' . Auth::user()->name . ' - Usuario ID: ' . Auth::user()->id . ' - Inscrição "'. $inscricao->titulo .'" erro ao efetuar análise do relatório final  - Endereço IP: ' . $request->ip());
            session()->flash('status', 'Desculpe! Houve erro ao analisar o relatório!');
            session()->flash('alert', 'warning');

            return redirect()->to("inscricao/$inscricao->id");
        }
    }
}
