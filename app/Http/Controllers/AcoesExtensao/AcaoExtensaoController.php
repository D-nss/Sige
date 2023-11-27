<?php

namespace App\Http\Controllers\AcoesExtensao;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;

use App\Http\Requests\StoreAcaoExtensaoRequest;
use App\Http\Requests\UpdateAcaoExtensaoRequest;
use App\Models\AcaoExtensao;
use App\Models\AcaoExtensaoColaborador;
use App\Models\AcaoExtensaoDataLocal;
use App\Models\AcaoExtensaoOcorrencia;
use App\Models\AcaoExtensaoODS;
use App\Models\AcaoExtensaoParceiro;
use App\Models\LinhaExtensao;
use App\Models\AreaTematica;
use App\Models\Arquivo;
use App\Models\Comentario;
use App\Models\Comissao;
use App\Models\ComissaoUser;
use App\Models\GrauEnvolvimentoEquipe;
use App\Models\Unidade;
use App\Models\User;
use App\Models\Municipio;
use App\Models\ObjetivoDesenvolvimentoSustentavel;
use App\Models\TipoParceiro;
use App\Models\UploadFile;

use App\Services\Avaliacao\ComissaoConext;

class AcaoExtensaoController extends Controller
{
    public function __construct()
    {
        //$this->middleware('role:admin|super');
    }

    public function dashboard(){

        if(App::environment('local')){
            $user = User::where('id', 1)->first();
        } else {
            $user = User::where('email', Auth::user()->id)->first();
        }

        $unidade = Unidade::where('id', $user->unidade_id)->first();

        $userNaComissao = ComissaoUser::join('comissoes', 'comissoes.id', 'comissoes_users.comissao_id')
        ->where('comissoes.unidade_id', $unidade->id)
        ->where('comissoes_users.user_id', $user->id)
        ->first();

        $userNaComissaoConext = ComissaoUser::join('comissoes', 'comissoes.id', 'comissoes_users.comissao_id')
        ->where('comissoes.atribuicao', 'Conext')
        ->where('comissoes_users.user_id', $user->id)
        ->first();

        $acoes_extensao = AcaoExtensao::where('unidade_id', $unidade->id)->where('status', 'Aprovado')->limit(3)->get();

        if($userNaComissao) {
            $pendentes_unidade = AcaoExtensao::where('unidade_id', $unidade->id)
            ->where('status', 'Pendente')
            ->wherenot('user_id', $user->id) //para não mostrar as suas próprias ações, pois usuário não pode aprovar ele mesmo
            ->get();
        } else{
            $pendentes_unidade = array(null);
        }

        if($userNaComissaoConext) {
            $pendentes = AcaoExtensao::whereNotNull('aprovado_user_id')
            ->where('status', 'Aprovado')
            ->whereNull('avaliacao_conext_user_id')
            ->whereNull('status_avaliacao_conext')
            ->wherenot('user_id', $user->id) //para não mostrar as suas próprias ações, pois usuário não pode aprovar ele mesmo
            ->get();
        }else {
            $pendentes = AcaoExtensao::where('unidade_id', $unidade->id)->where('status', 'Pendente')->get();
        }

        $rascunhos = AcaoExtensao::where('unidade_id', $unidade->id)->where('status', 'Rascunho')->get();

        //pegar id do usuario
        $acoes_extensao_usuario =  AcaoExtensao::where('user_id', $user->id)->get();

        $total = AcaoExtensao::where('status', 'Aprovado')->count();
        $total_unidade = AcaoExtensao::where('unidade_id', $unidade->id)->where('status', 'Aprovado')->count();
        if(!$total == 0){
            $porcentagem_unidade = (int) ($total_unidade*100/$total);
        } else{
            $porcentagem_unidade = 0;
        }

        $total_cadastrados = AcaoExtensao::where('user_id', $user->id)->count();
        $total_aprovados = AcaoExtensao::where('user_id', $user->id)->where('status', 'Aprovado')->count();
        $total_pendentes = AcaoExtensao::where('user_id', $user->id)->where('status', 'Pendente')->count();
        $total_desativados = AcaoExtensao::where('user_id', $user->id)->where('status', 'Desativado')->count();

        return view('acoes-extensao.dashboard', [
            'unidade' => $unidade,
            'acoes_extensao_usuario' => $acoes_extensao_usuario,
            'user' => $user,
            'userNaComissao' => $userNaComissao,
            'userNaComissaoConext' => $userNaComissaoConext,
            'acoes_extensao' => $acoes_extensao,
            'pendentes' => $pendentes,
            'pendentes_unidade' => $pendentes_unidade,
            'rascunhos' => $rascunhos,
            'total' => $total,
            'total_unidade' => $total_unidade,
            'porcentagem_unidade' => $porcentagem_unidade,
            'total_cadastrados' => $total_cadastrados,
            'total_aprovados' => $total_aprovados,
            'total_pendentes' => $total_pendentes,
            'total_desativados' => $total_desativados
        ]);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Collection $acoes_extensao = null)
    {
        if(App::environment('local')){
            $user = User::where('id', 1)->first();
        } else {
            $user = User::where('email', Auth::user()->id)->first();
        }

        if(is_null($acoes_extensao)){
            $acoes_extensao = AcaoExtensao::all();
        }

        //populando formulário (filtro)
        $unidades = Unidade::all();
        $linhas_extensao = LinhaExtensao::all();
        $areas_tematicas = AreaTematica::all();
        $estados = Municipio::select('uf')->distinct('uf')->orderBy('uf')->get();

        $acoes_extensao = $acoes_extensao->where('status', 'Aprovado')->where('unidade_id', $user->unidade->id);

        return view('acoes-extensao.index', [
            'acoes_extensao' => $acoes_extensao,
            'unidades' => $unidades,
            'linhas_extensao' => $linhas_extensao,
            'areas_tematicas' => $areas_tematicas,
            'estados' => $estados,
            'user'    => $user
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function catalogo(Collection $acoes_extensao = null)
    {
        // if(is_null($acoes_extensao)){
        //     $acoes_extensao = AcaoExtensao::all();
        // }

        //populando formulário (filtro)
        $unidades = Unidade::all();
        $linhas_extensao = LinhaExtensao::all();
        $areas_tematicas = AreaTematica::all();
        $estados = Municipio::select('uf')->distinct('uf')->orderBy('uf')->get();

        $acoes_extensao = AcaoExtensao::where('status_avaliacao_conext', 'Aprovado')->get();

        return view('acoes-extensao.catalogo', [
            'acoes_extensao' => $acoes_extensao,
            'unidades' => $unidades,
            'linhas_extensao' => $linhas_extensao,
            'areas_tematicas' => $areas_tematicas,
            'estados' => $estados
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $linhas_extensao = LinhaExtensao::all();
        $areas_tematicas = AreaTematica::all();
        $ods = ObjetivoDesenvolvimentoSustentavel::all();
        $estados = Municipio::select('uf')->distinct('uf')->orderBy('uf')->get();
        $programas = AcaoExtensao::where('modalidade', 1)->where('status', 'Aprovado')->get(['id', 'titulo']);

        return view('acoes-extensao.create', [
            'linhas_extensao' => $linhas_extensao,
            'areas_tematicas' => $areas_tematicas,
            'ods' => $ods,
            'estados' => $estados,
            'programas' => $programas
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AcaoExtensao  $acaoExtensao
     * @return \Illuminate\Http\Response
     */
    public function edit(AcaoExtensao $acaoExtensao)
    {
        if(App::environment('local')){
            $user = User::where('id', 1)->first();
        } else {
            $user = User::where('email', Auth::user()->id)->first();
        }

        //restringindo usuario aprovar sua ação
        if($acaoExtensao->user_id != $user->id){
            session()->flash('status', 'Apenas o Coordenador pode editar a Ação.');
            session()->flash('alert', 'danger');
            return back();
        }

        $acaoLocal = Municipio::select('uf', 'nome_municipio')->where('id', $acaoExtensao->municipio_id)->get();
        $linhas_extensao = LinhaExtensao::all();
        $areas_tematicas = AreaTematica::all();
        $ods = ObjetivoDesenvolvimentoSustentavel::all();
        $estados = Municipio::select('uf')->distinct('uf')->orderBy('uf')->get();
        $programas = AcaoExtensao::where('modalidade', 1)->where('status', 'Aprovado')->get(['id', 'titulo']);

        return view('acoes-extensao.edit', [
            'acao_extensao' => $acaoExtensao,
            'acaoLocal' => $acaoLocal,
            'linhas_extensao' => $linhas_extensao,
            'areas_tematicas' => $areas_tematicas,
            'ods' => $ods,
            'estados' => $estados,
            'programas' => $programas
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAcaoExtensaoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAcaoExtensaoRequest $request)
    {
        if(App::environment('local')){
            $user = User::where('id', 2)->first();
            $vinculo_coordenador = 'Teste Vinculo Coordenador';
        } else {
            $user = User::where('email', Auth::user()->id)->first();
            $vinculo_coordenador = Auth::user()->employeetype;
        }
        $dados = array('user_id' => $user->id);
        $dados['unidade_id'] = $user->unidade_id;
        $dados['nome_coordenador'] = $user->name;
        $dados['email_coordenador'] = $user->email;
        $dados['vinculo_coordenador'] = $vinculo_coordenador;
        $dados['municipio_id'] = $request->cidade;
        //$dados['investimento'] = str_replace(',', '.', str_replace('.', '',$request->investimento));
        $dados_form = $request->all();
        $upload = new UploadFile();
        $dados_form['arquivo'] = $upload->execute($request, 'arquivo', 'pdf', 5000000);
        $dados = array_merge($dados_form, $dados);
        $dados['status'] = 'Rascunho';
        $areasTematicasInsert = array();
        $odsInsert = array();

        $acao_extensao = DB::transaction(function() use( $dados, $areasTematicasInsert, $odsInsert) {
            // Faz a inserção da ação
            $acaoCriada = AcaoExtensao::create($dados);
            // Prepara os dados para inserção das areas temáticas
            foreach($dados['areas_tematicas'] as $area) {
                array_push($areasTematicasInsert,[
                    'area_tematica_id' => $area,
                    'acao_extensao_id' => $acaoCriada->id
                ]);
            }
            // faz a inserção das áreas temáticas
            DB::table('acoes_extensao_areas_tematicas')->insert($areasTematicasInsert);
            // Prepara os dados para inserção dos objetivos desenvolvimento sustentavel
            foreach($dados['ods'] as $objetivo) {
                array_push($odsInsert,[
                    'objetivo_desenvolvimento_sustentavel_id' => $objetivo,
                    'acao_extensao_id' => $acaoCriada->id
                ]);
            }
            // faz a inserção dos objetivos  desenvolvimento sustentavel
            DB::table('acoes_extensao_ods')->insert($odsInsert);

            return $acaoCriada;
        });

        if($acao_extensao){
            Log::channel('acao_extensao')->info('Usuario Nome: ' . $user->name . ' - Usuario ID: ' . $user->id . ' - Operação: Nova Ação de Extensão: ' . $acao_extensao->id . ' - Endereço IP: ' . $request->ip());
            session()->flash('status', 'Ação de Extensão adicionada com sucesso!');
            session()->flash('alert', 'success');
        } else {
            Log::channel('acao_extensao')->error('Usuario Nome: ' . $user->name . ' - Usuario ID: ' . $user->id . ' - Erro: Ação não inserida  - Endereço IP: ' . $request->ip());
            session()->flash('status', 'Erro ao adicionar a Ação de Extensão ao banco de dados.');
            session()->flash('alert', 'danger');
            return back();
        }

        return redirect()->route('acao_extensao.show', ['acao_extensao' => $acao_extensao->id] );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAcaoExtensaoRequest  $request
     * @param  \App\Models\AcaoExtensao  $acaoExtensao
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAcaoExtensaoRequest $request, AcaoExtensao $acaoExtensao)
    {
        if(App::environment('local')){
            $user = User::where('id', 1)->first();
            $vinculo_coordenador = 'Teste Vinculo Coordenador';
        } else {
            $user = User::where('email', Auth::user()->id)->first();
            $vinculo_coordenador = Auth::user()->employeetype;
        }

        $dados = array('user_id' => $user->id);
        $dados['unidade_id'] = $user->unidade_id;
        $dados['nome_coordenador'] = $user->name;
        $dados['email_coordenador'] = $user->email;
        $dados['vinculo_coordenador'] = $vinculo_coordenador;
        $dados['municipio_id'] = $request->cidade;
        $dados['investimento'] = str_replace(',', '.', str_replace('.', '',$request->investimento));
        $dados_form = $request->all();

        if( isset($dados_form['arquivo']) && !is_null($dados_form['arquivo']) ) {
            $arquivoExiste = Storage::disk('public')->exists($acaoExtensao->arquivo);
            if($arquivoExiste) {
                Storage::disk('public')->delete($acaoExtensao->arquivo);
            }
            $upload = new UploadFile();
            $dados_form['arquivo'] = $upload->execute($request, 'arquivo', 'pdf', 5000000);
        }

        $dados = array_merge($dados_form, $dados);
        $dados['status'] = 'Rascunho';
        $dados['aprovado_user_id'] = null;
        $dados['avaliacao_conext_user_id'] = null;
        $dados['status_avaliacao_conext'] = null;
        $areasTematicasInsert = array();
        $odsInsert = array();

        $transacao = DB::transaction(function() use( $dados, $areasTematicasInsert, $acaoExtensao, $odsInsert) {
            $acaoExtensao->user_id = $dados['user_id'];
            $acaoExtensao->modalidade = $dados['modalidade'];
            $acaoExtensao->linha_extensao_id = $dados['linha_extensao_id'];
            $acaoExtensao->titulo = $dados['titulo'];
            $acaoExtensao->descricao = $dados['descricao'];
            $acaoExtensao->publico_alvo = $dados['publico_alvo'];
            $acaoExtensao->palavras_chaves = $dados['palavras_chaves'];
            $acaoExtensao->url = $dados['url'];
            $acaoExtensao->publico_alvo = $dados['publico_alvo'];
            $acaoExtensao->estimativa_publico = $dados['estimativa_publico'];
            $acaoExtensao->vagas_curricularizacao = $dados['vagas_curricularizacao'];
            $acaoExtensao->qtd_horas_curricularizacao = $dados['qtd_horas_curricularizacao'];
            $acaoExtensao->municipio_id = $dados['municipio_id'];
            $acaoExtensao->unidade_id = $dados['unidade_id'];
            $acaoExtensao->impactos_universidade = $dados['impactos_universidade'];
            $acaoExtensao->impactos_sociedade = $dados['impactos_sociedade'];
            $acaoExtensao->status = $dados['status'];
            $acaoExtensao->aprovado_user_id = $dados['aprovado_user_id'];
            $acaoExtensao->avaliacao_conext_user_id = $dados['avaliacao_conext_user_id'];
            $acaoExtensao->status_avaliacao_conext = $dados['status_avaliacao_conext'];
            if(isset($dados_form['arquivo']) && !is_null($dados['arquivo'])) {
                $acaoExtensao->arquivo = $dados['arquivo'];
            }
            $acaoAtualizada = $acaoExtensao->save();

            //remove areas temáticas anteriores
            DB::table('acoes_extensao_areas_tematicas')->where('acao_extensao_id', $acaoExtensao->id)->delete();

            // Prepara os dados para inserção das areas temáticas
            foreach($dados['areas_tematicas'] as $area) {
                array_push($areasTematicasInsert,[
                    'area_tematica_id' => $area,
                    'acao_extensao_id' => $acaoExtensao->id
                ]);
            }
            // faz a inserção das áreas temáticas
            DB::table('acoes_extensao_areas_tematicas')->insert($areasTematicasInsert);

            //remove objetivos desenvolvimento sustentavel anteriores
            DB::table('acoes_extensao_ods')->where('acao_extensao_id', $acaoExtensao->id)->delete();

             // Prepara os dados para inserção dos objetivos desenvolvimento sustentavel
             foreach($dados['ods'] as $objetivo) {
                array_push($odsInsert,[
                    'objetivo_desenvolvimento_sustentavel_id' => $objetivo,
                    'acao_extensao_id' => $acaoExtensao->id
                ]);
            }
            // faz a inserção dos objetivos  desenvolvimento sustentavel
            DB::table('acoes_extensao_ods')->insert($odsInsert);

            return $acaoAtualizada;
        });

        if(is_null($transacao) || empty($transacao)) {
            Log::channel('acao_extensao')->error('Usuario Nome: ' . $user->name . ' - Usuario ID: ' . $user->id . ' - Erro: atualização da Ação de Extensão' . $acaoExtensao->id . ' - Endereço IP: ' . $request->ip());
            session()->flash('status', 'Desculpe! Houve erro na atualização da Ação de Extensão');
            session()->flash('alert', 'danger');
            return redirect()->back();
        }
        else {
            Log::channel('acao_extensao')->info('Usuario Nome: ' . $user->name . ' - Usuario ID: ' . $user->id . ' - Operação: Atualização Ação de Extensão' . $acaoExtensao->id . ' - Endereço IP: ' . $request->ip());
            session()->flash('status', 'Ação de Extensão atualizada com sucesso!');
            session()->flash('alert', 'success');
            return redirect()->route('acao_extensao.show', ['acao_extensao' => $acaoExtensao->id] );
        }
    }

    public function insereUnidade(Request $request)
    {
        $this->validate($request, [
            'unidade_id' => ['required']
        ]);

        $unidadeRelacionada =  DB::table('acoes_extensao_unidades')->insert([
            'acao_extensao_id' => $request->acao_extensao_id,
            'unidade_id' => $request->unidade_id
        ]);

        if(App::environment('local')){
            $user = User::where('id', 1)->first();
        } else {
            $user = User::where('email', Auth::user()->id)->first();
        }

        if($unidadeRelacionada){
            Log::channel('acao_extensao')->info('Usuario Nome: ' . $user->name . ' - Usuario ID: ' . $user->id . ' - Operação: Ação de Extensão ('. $request->acao_extensao_id . ') - Adição de Unidade: ' . $request->unidade_id . ' - Endereço IP: ' . $request->ip());
            session()->flash('status', 'Unidade adicionada com sucesso!');
            session()->flash('alert', 'success');
        } else {
            Log::channel('acao_extensao')->error('Usuario Nome: ' . $user->name . ' - Usuario ID: ' . $user->id . ' - Erro: Ação de Extensão ('. $request->acao_extensao_id . ') - Adição de Unidade: ' . $request->unidade_id . ' - Endereço IP: ' . $request->ip());
            session()->flash('status', 'Erro ao adicionar unidade ao banco de dados.');
            session()->flash('alert', 'danger');
            return back();
        }

        $acaoExtensao = AcaoExtensao::where('id', $request->acao_extensao_id)->first();

        return redirect()->route('acao_extensao.show', ['acao_extensao' => $acaoExtensao->id] );
    }

    public function removeUnidade(Request $request, $id)
    {
        $unidadeRelacionada = DB::table('acoes_extensao_unidades')
                                ->where(function($query) use ($request, $id) {
                                    $query->where('unidade_id', $id)
                                    ->where('acao_extensao_id', $request->acao_extensao_id);
                                })->limit(1)->delete();
        $acaoExtensao = AcaoExtensao::where('id', $request->acao_extensao_id)->first();

        if(App::environment('local')){
            $user = User::where('id', 1)->first();
        } else {
            $user = User::where('email', Auth::user()->id)->first();
        }

        if($unidadeRelacionada) {
            Log::channel('acao_extensao')->info('Usuario Nome: ' . $user->name . ' - Usuario ID: ' . $user->id . ' - Operação: Ação de Extensão ('. $acaoExtensao->id . ') - Remoção de Unidade: ' . $request->acao_extensao_id);
            session()->flash('status', 'Unidade relacionada removida!');
            session()->flash('alert', 'success');

            return redirect()->route('acao_extensao.show', ['acao_extensao' => $acaoExtensao->id] );
        }
        else {
            Log::channel('acao_extensao')->error('Usuario Nome: ' . $user->name . ' - Usuario ID: ' . $user->id . ' - Erro: Ação de Extensão ('. $acaoExtensao->id . ') - Remoção de Unidade: ' . $request->acao_extensao_id);
            session()->flash('status', 'Unidade relacionada não removida!');
            session()->flash('alert', 'danger');

            return redirect()->route('acao_extensao.show', ['acao_extensao' => $acaoExtensao->id] );
        }
    }

    /* remover futuro
    public function insereDataLocal(Request $request)
    {
        $this->validate($request, [
            'data_hora_inicio' => ['required','date','before:' . today()],
            'data_hora_fim' => ['required','date','after:data_hora_inicio'],
            'local' => ['required']
        ]);

        if(App::environment('local')){
            $user = User::where('id', 1)->first();
        } else {
            $user = User::where('email', Auth::user()->id)->first();
        }

        $dataLocalCriado = AcaoExtensaoDataLocal::create($request->all());

        if($dataLocalCriado){
            Log::channel('acao_extensao')->info('Usuario Nome: ' . $user->name . ' - Usuario ID: ' . $user->id . ' - Operação: Adição de Data/Local Ação de Extensão ('. $request->acao_extensao_id . ') - Local: ' . $request->local . ' - Endereço IP: ' . $request->ip());
            session()->flash('status', 'Data e Local adicionado com sucesso!');
            session()->flash('alert', 'success');
        } else {
            Log::channel('acao_extensao')->error('Usuario Nome: ' . $user->name . ' - Usuario ID: ' . $user->id . ' - Erro: Adição de Data/Local Ação de Extensão ('. $request->acao_extensao_id . ') - Local: ' . $request->local . ' - Endereço IP: ' . $request->ip());
            session()->flash('status', 'Erro ao adicionar data e local ao banco de dados.');
            session()->flash('alert', 'danger');
            return back();
        }
        $acaoExtensao = AcaoExtensao::where('id', $request->acao_extensao_id)->first();

        return redirect()->route('acao_extensao.show', ['acao_extensao' => $acaoExtensao->id] );
    }

    public function removeLocal($id)
    {
        if(App::environment('local')){
            $user = User::where('id', 1)->first();
        } else {
            $user = User::where('email', Auth::user()->id)->first();
        }

        $acaoExtensaoDataLocal = AcaoExtensaoDataLocal::where('id', $id)->first();
        $acaoExtensao = AcaoExtensao::where('id', $acaoExtensaoDataLocal->acao_extensao_id)->first();
        if($acaoExtensaoDataLocal->delete()) {
            Log::channel('acao_extensao')->info('Usuario Nome: ' . $user->name . ' - Usuario ID: ' . $user->id . ' - Operação: Remoção de Data/Local Ação de Extensão ('. $acaoExtensao->id . ') - Local: ' . $acaoExtensaoDataLocal->local);
            session()->flash('status', 'Local removido!');
            session()->flash('alert', 'success');
        }
        else {
            Log::channel('acao_extensao')->error('Usuario Nome: ' . $user->name . ' - Usuario ID: ' . $user->id . ' - Erro: Remoção de Data/Local Ação de Extensão ('. $acaoExtensao->id . ') - Local: ' . $acaoExtensaoDataLocal->local);
            session()->flash('status', 'Local não removido!');
            session()->flash('alert', 'danger');
        }

        return redirect()->route('acao_extensao.show', ['acao_extensao' => $acaoExtensao->id] );
    }

    public function equipe(AcaoExtensao $acaoExtensao)
    {
        $colaboradores_acao_extensao = AcaoExtensaoColaborador::where('acao_extensao_id', $acaoExtensao->id)->orderBy('nome')->get();
        $lista_documento = array('CPF', 'Estrangeiro (RNE)');
        $lista_vinculo = array('Aluno Graduação (Unicamp)', 'Aluno Pós-Graduação (Unicamp)', 'Docente (Unicamp)', 'Pesquisador (Unicamp)', 'Técnico-Administrativo (Unicamp)','Externo à universidade');
        $graus_envolvimento_equipe = GrauEnvolvimentoEquipe::all();

        return view('acoes-extensao.equipe', [
            'acao_extensao' => $acaoExtensao,
            'colaboradores_acao_extensao'=> $colaboradores_acao_extensao,
            'lista_documento' => $lista_documento,
            'lista_vinculo' => $lista_vinculo,
            'graus_envolvimento_equipe' => $graus_envolvimento_equipe
        ]);
    }

    public function insereColaborador(Request $request)
    {
        $this->validate($request, [
            'nome' => ['required'],
            'email' => ['required'],
            'documento' => ['required'],
            'numero_doc' => ['required'],
            'carga_horaria' => ['required'],
            'vinculo' => ['required']
        ]);

        if(App::environment('local')){
            $user = User::where('id', 1)->first();
        } else {
            $user = User::where('email', Auth::user()->id)->first();
        }

        $colaboradorCriado = AcaoExtensaoColaborador::create($request->all());

        if($colaboradorCriado){
            Log::channel('acao_extensao')->info('Usuario Nome: ' . $user->name . ' - Usuario ID: ' . $user->id . ' - Operação: Adição de colaborador na equipe na Ação de Extensão ('. $request->acao_extensao_id . ') - Email: ' . $request->email . ' - Endereço IP: ' . $request->ip());
            session()->flash('status', 'Colaborador(a) adicionado(a) com sucesso!');
            session()->flash('alert', 'success');
        } else {
            Log::channel('acao_extensao')->error('Usuario Nome: ' . $user->name . ' - Usuario ID: ' . $user->id . ' - Erro: Adição de colaborador na equipe na Ação de Extensão ('. $request->acao_extensao_id . ') - Email: ' . $request->email . ' - Endereço IP: ' . $request->ip());
            session()->flash('status', 'Erro ao adicionar colaborador(a) ao banco de dados.');
            session()->flash('alert', 'danger');
            return back();
        }
        $acaoExtensao = AcaoExtensao::where('id', $request->acao_extensao_id)->first();

        return redirect()->route('acao_extensao.show', ['acao_extensao' => $acaoExtensao->id] );
    }

    public function removeColaborador($id)
    {
        if(App::environment('local')){
            $user = User::where('id', 1)->first();
        } else {
            $user = User::where('email', Auth::user()->id)->first();
        }

        $acaoExtensaoColadorador = AcaoExtensaoColaborador::where('id', $id)->first();

        $acaoExtensao = AcaoExtensao::where('id', $acaoExtensaoColadorador->acao_extensao_id)->first();
        if($acaoExtensaoColadorador->delete()) {
            Log::channel('acao_extensao')->info('Usuario Nome: ' . $user->name . ' - Usuario ID: ' . $user->id . ' - Operação: Remoção de colaborador na equipe na Ação de Extensão ('. $acaoExtensao->id . ') - Email: ' . $acaoExtensaoColadorador->email);
            session()->flash('status', 'Colaborador removido!');
            session()->flash('alert', 'success');
        }
        else {
            Log::channel('acao_extensao')->error('Usuario Nome: ' . $user->name . ' - Usuario ID: ' . $user->id . ' - Erro: Remoção de colaborador na equipe na Ação de Extensão ('. $acaoExtensao->id . ') - Email: ' . $acaoExtensaoColadorador->email);
            session()->flash('status', 'Colaborador não removido!');
            session()->flash('alert', 'danger');
        }

        return redirect()->route('acao_extensao.show', ['acao_extensao' => $acaoExtensao->id] );
    }
    */

    public function grau_equipe(Request $request)
    {
        if(App::environment('local')){
            $user = User::where('id', 1)->first();
        } else {
            $user = User::where('email', Auth::user()->id)->first();
        }

        $this->validate($request, [
            'grau_envolvimento_equipe_id' => ['required']
        ]);
        $dados = $request->all();
        $acaoAtualizada = AcaoExtensao::where('id', $request->acao_extensao_id)->first();
        $acaoAtualizada->fill($dados)->save();
        if($acaoAtualizada){
            Log::channel('acao_extensao')->info('Usuario Nome: ' . $user->name . ' - Usuario ID: ' . $user->id . ' - Operação: Alteração grau de envolvimento da equipe na Ação de Extensão ('. $acaoAtualizada->id . ') - para: ' . $acaoAtualizada->grau_envolvimento_equipe_id . ' - Endereço IP: ' . $request->ip());
            session()->flash('status', 'Dados de Curricularização atualizados com sucesso');
            session()->flash('alert', 'success');
        } else {
            Log::channel('acao_extensao')->error('Usuario Nome: ' . $user->name . ' - Usuario ID: ' . $user->id . ' - Erro: Alteração grau de envolvimento da equipe na Ação de Extensão ('. $acaoAtualizada->id . ') - para: ' . $acaoAtualizada->grau_envolvimento_equipe_id . ' - Endereço IP: ' . $request->ip());
            session()->flash('status', 'Erro ao atualizar dados de Curricularização.');
            session()->flash('alert', 'danger');
        }

        return redirect()->route('acao_extensao.show', ['acao_extensao' => $acaoAtualizada->id] );
    }

    /*remover futuro
    public function locais(AcaoExtensao $acaoExtensao)
    {
        $locais_acao_extensao = AcaoExtensaoDataLocal::where('acao_extensao_id', $acaoExtensao->id)->orderBy('local')->get();

        return view('acoes-extensao.locais', [
            'acao_extensao' => $acaoExtensao,
            'locais_acao_extensao' => $locais_acao_extensao
        ]);
    }
    */

    public function parceiros(AcaoExtensao $acaoExtensao)
    {
        $parceiros_acao_extensao = AcaoExtensaoParceiro::where('acao_extensao_id', $acaoExtensao->id)->orderBy('nome')->get();
        $lista_tipos = TipoParceiro::all();

        return view('acoes-extensao.parceiros', [
            'acao_extensao' => $acaoExtensao,
            'parceiros_acao_extensao'=> $parceiros_acao_extensao,
            'lista_tipos' => $lista_tipos
        ]);
    }

    public function insereParceiro(Request $request)
    {
        $this->validate($request, [
            'nome' => ['required'],
            'tipo_parceiro_id' => ['required'],
            'colaboracao' => ['required']
        ]);

        if(App::environment('local')){
            $user = User::where('id', 1)->first();
        } else {
            $user = User::where('email', Auth::user()->id)->first();
        }

        $parceiroCriado = AcaoExtensaoParceiro::create($request->all());
        if($parceiroCriado){
            Log::channel('acao_extensao')->info('Usuario Nome: ' . $user->name . ' - Usuario ID: ' . $user->id . ' - Operação: Inclusão de parceiro na Ação de Extensão ('. $request->acao_extensao_id . ') - nome: ' . $request->nome . ' - Endereço IP: ' . $request->ip());
            session()->flash('status', 'Parceiro(a) adicionado(a) com sucesso!');
            session()->flash('alert', 'success');
        } else {
            Log::channel('acao_extensao')->error('Usuario Nome: ' . $user->name . ' - Usuario ID: ' . $user->id . ' - Erro: Inclusão de parceiro na Ação de Extensão ('. $request->acao_extensao_id . ') - nome: ' . $request->nome . ' - Endereço IP: ' . $request->ip());
            session()->flash('status', 'Erro ao adicionar parceiro(a) ao banco de dados.');
            session()->flash('alert', 'danger');

            return back();
        }
        $acaoExtensao = AcaoExtensao::where('id', $request->acao_extensao_id)->first();

        return redirect()->route('acao_extensao.show', ['acao_extensao' => $acaoExtensao->id] );
    }

    public function removeParceiro($id)
    {
        if(App::environment('local')){
            $user = User::where('id', 1)->first();
        } else {
            $user = User::where('email', Auth::user()->id)->first();
        }

        $acaoExtensaoParceiro = AcaoExtensaoParceiro::where('id', $id)->first();
        $acaoExtensao = AcaoExtensao::where('id', $acaoExtensaoParceiro->acao_extensao_id)->first();
        if($acaoExtensaoParceiro->delete()) {
            Log::channel('acao_extensao')->info('Usuario Nome: ' . $user->name . ' - Usuario ID: ' . $user->id . ' - Operação: Remoção de parceiro na Ação de Extensão ('. $acaoExtensao->id . ') - nome: ' . $acaoExtensaoParceiro->nome);
            session()->flash('status', 'Colaborador removido!');
            session()->flash('alert', 'success');
        }
        else {
            Log::channel('acao_extensao')->error('Usuario Nome: ' . $user->name . ' - Usuario ID: ' . $user->id . ' - Erro: Remoção de parceiro na Ação de Extensão ('. $acaoExtensao->id . ') - nome: ' . $acaoExtensaoParceiro->nome);
            session()->flash('status', 'Colaborador não removido!');
            session()->flash('alert', 'danger');
        }

        return redirect()->route('acao_extensao.show', ['acao_extensao' => $acaoExtensao->id] );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AcaoExtensao  $acaoExtensao
     * @return \Illuminate\Http\Response
     */
    public function show(AcaoExtensao $acaoExtensao)
    {
        $unidades = Unidade::where('id', '!=', $acaoExtensao->unidade->id)->orderBy('sigla')->get();
        $unidades_envolvidas_acao_extensao = Unidade::select('unidades.*')
                                                    ->join('acoes_extensao_unidades', 'acoes_extensao_unidades.unidade_id', '=', 'unidades.id')
                                                    ->where('acoes_extensao_unidades.acao_extensao_id', $acaoExtensao->id)
                                                    ->get();
        $graus_envolvimento_equipe = GrauEnvolvimentoEquipe::all();
        $colaboradores_acao_extensao = AcaoExtensaoColaborador::where('acao_extensao_id', $acaoExtensao->id)->orderBy('nome')->get();
        $lista_documento = array('CPF', 'Estrangeiro (RNE)');
        $lista_vinculo = array('Aluno Graduação (Unicamp)', 'Aluno Pós-Graduação (Unicamp)', 'Docente (Unicamp)', 'Pesquisador (Unicamp)', 'Técnico-Administrativo (Unicamp)','Externo à universidade');
        //$datas_locais_acao_extensao = AcaoExtensaoDataLocal::where('acao_extensao_id', $acaoExtensao->id)->orderBy('local')->get();
        $ocorrencias = AcaoExtensaoOcorrencia::where('acao_extensao_id', $acaoExtensao->id)->orderBy('data_hora_inicio')->get();
        $parceiros_acao_extensao = AcaoExtensaoParceiro::where('acao_extensao_id', $acaoExtensao->id)->orderBy('nome')->get();
        $lista_tipos = TipoParceiro::all();

        $arquivos = Arquivo::where('modulo', 'acoes-extensao')->where('referencia_id', $acaoExtensao->id)->get(['id', 'nome_arquivo', 'url_arquivo']);

        if(App::environment('local')){
            $user = User::where('id', 1)->first();
        } else {
            $user = User::where('email', Auth::user()->id)->first();
        }

        $userNaComissao = ComissaoUser::join('comissoes', 'comissoes.id', 'comissoes_users.comissao_id')
                                        ->where('comissoes.unidade_id', $acaoExtensao->unidade_id)
                                        ->where('comissoes_users.user_id', $user->id)
                                        ->first();

        $userNaComissaoConext = ComissaoUser::join('comissoes', 'comissoes.id', 'comissoes_users.comissao_id')
                                        ->where('comissoes_users.user_id', $user->id)
                                        ->where('comissoes.atribuicao', 'Conext')
                                        ->first();

        //restringindo usuario aprovar sua ação
        if($acaoExtensao->user_id == $user->id){
            $userNaComissao = false;
            $userNaComissaoConext = false;
            $userCoordenadorAcao = $user;
        } else {
            $userCoordenadorAcao = false;
        }

        return view('acoes-extensao.show', [
            'acao_extensao' => $acaoExtensao,
            'unidades' => $unidades,
            'unidades_envolvidas_acao_extensao' => $unidades_envolvidas_acao_extensao,
            'graus_envolvimento_equipe' => $graus_envolvimento_equipe,
            'colaboradores_acao_extensao' => $colaboradores_acao_extensao,
            'lista_documento' => $lista_documento,
            'lista_vinculo' => $lista_vinculo,
            'ocorrencias' => $ocorrencias,
            'parceiros_acao_extensao' => $parceiros_acao_extensao,
            'lista_tipos' => $lista_tipos,
            'userNaComissao' => $userNaComissao,
            'userNaComissaoConext' => $userNaComissaoConext,
            'userCoordenadorAcao' => $userCoordenadorAcao,
            'arquivos' => $arquivos,
            'user' => $user
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AcaoExtensao  $acaoExtensao
     * @return \Illuminate\Http\Response
     */
    public function destroy(AcaoExtensao $acaoExtensao)
    {
        $acaoExtensao->delete();
        return redirect()->route('acao_extensao.index');
    }

    public function desativar(AcaoExtensao $acaoExtensao)
    {
        $acaoExtensao->status = 'Desativado';
        $acaoExtensao->update();
        return redirect()->route('acao_extensao.index');
    }

    public function submeter(AcaoExtensao $acaoExtensao)
    {
        $acaoExtensao->status = 'Pendente';
        $acaoExtensao->save();
        $acaoExtensao->user->notify(new \App\Notifications\AcaoExtensaoSubmetida($acaoExtensao));

        $comissaoUnidade = BuscaUsuariosComissaoUnidade::execute($acaoExtensao->unidade);
        Notification::send($comissaoUnidade, new \App\Notifications\AcaoExtensaoNotificarComissaoUnidade($acaoExtensao));

        session()->flash('status', 'Ação de Extensão Submetida para aprovação!');
        session()->flash('alert', 'success');

        return redirect()->route('acao_extensao.index');
    }

    public function aprovar(AcaoExtensao $acaoExtensao){

        if(App::environment('local')){
            $user = User::where('id', 4)->first();
            $acaoExtensao->aprovado_user_id = 4;
        } else {
            $user = User::where('email', Auth::user()->id)->first();
            $acaoExtensao->aprovado_user_id = $user->id;
        }

        if($acaoExtensao->user_id == $user->id) {
            session()->flash('status', 'Desculpe! Você não pode aprovar sua própria ação de extensão.');
            session()->flash('alert', 'warning');

            return redirect()->back();
        }

        if(!\App\Services\Comissao\ChecaComissao::execute($acaoExtensao->user_id)) {
            session()->flash('status', 'Desculpe! Para aprovar esta ação você deve estar na comissão da unidade '. $acaoExtensao->unidade->sigla .'.');
            session()->flash('alert', 'warning');

            return redirect()->back();
        }

        $acaoExtensao->status = 'Aprovado';
        $acaoExtensao->save();
        Log::channel('acao_extensao')->info('Usuario Nome: ' . $user->name . ' - Usuario ID: ' . $user->id . ' - Operação: Aprovação da Ação de Extensão ('. $acaoExtensao->id . ')' );
        $acaoExtensao->user->notify(new \App\Notifications\AcaoExtensaoAprovadaUnidade($acaoExtensao));

        $at_conext = User::role('at_conext')->get();
        Notification::send($at_conext, new \App\Notifications\AcaoExtensaoNotificaAtConext($acaoExtensao));
        session()->flash('status', 'Ação de Extensão aprovada!');
        session()->flash('alert', 'success');

        return redirect()->route('acao_extensao.index');
    }

    public function enviarComentario(AcaoExtensao $acaoExtensao, Request $request)
    {
        $validated = $request->validate([
            'comentario' => 'required|max:1000',
        ]);

        if(App::environment('local')){
            $user = User::where('id', 1)->first();
        } else {
            $user = User::where('email', Auth::user()->id)->first();
        }

        $comentario = new Comentario();
        $comentario->acao_extensao_id = $acaoExtensao->id;
        $comentario->user_id = $user->id;
        $comentario->comentario = $request->comentario;
        $comentario->save();
        Log::channel('acao_extensao')->info('Usuario Nome: ' . $user->name . ' - Usuario ID: ' . $user->id . ' - Operação: Novo Comentário na Ação de Extensão ('. $acaoExtensao->id . ')' . ' - Endereço IP: ' . $request->ip());
        $acaoExtensao->user->notify(new \App\Notifications\AcaoExtensaoNovoComentario($acaoExtensao));
        session()->flash('status', 'Comentario feito! Coordenador da Ação será notificado');
        session()->flash('alert', 'success');

        return redirect()->route('acao_extensao.show', ['acao_extensao' => $acaoExtensao->id]);
    }

    public function acoesPorUnidade(Unidade $unidade){
        $acoes_extensao = AcaoExtensao::where('unidade_id', $unidade->id)->get();
        return redirect()->route('acao_extensao.index', ['acoes_extensao' => $acoes_extensao] );
        //return $this->index($acoes_extensao);
    }

    public function acoesPorArea(AreaTematica $areaTematica){
       // return dd($areaTematica->id);
        $acoes_extensao = AcaoExtensao::join('acoes_extensao_areas_tematicas as at', 'at.acao_extensao_id', 'acoes_extensao.id')
                                        ->where('at.area_tematica_id', $areaTematica->id)
                                        ->get(['acoes_extensao.*']);

        return $this->index($acoes_extensao);
    }

    public function acoesPorODS(ObjetivoDesenvolvimentoSustentavel $ods){
        $acoes_extensao = AcaoExtensao::join('acoes_extensao_ods as ao', 'ao.acao_extensao_id', 'acoes_extensao.id')
                                        ->where('ao.objetivo_desenvolvimento_sustentavel_id', $ods->id)
                                        ->get(['acoes_extensao.*']);

        return $this->index($acoes_extensao);
    }

    public function acoesPorLinha(LinhaExtensao $linhaExtensao){
        $acoes_extensao = AcaoExtensao::where('linha_extensao_id', $linhaExtensao->id)->get();
        return $this->index($acoes_extensao);
    }

    public function acoesPorCidade(Municipio $municipio){
        $acoes_extensao = AcaoExtensao::where('municipio_id', $municipio->id)->get();
        return $this->index($acoes_extensao);
    }

    public function acoesPorModalidade($id){
        $acoes_extensao = AcaoExtensao::where('modalidade', $id)->get();
        return $this->index($acoes_extensao);
    }

    public function acoesPorGrauEnvolvimentoEquipe(GrauEnvolvimentoEquipe $grauEnvolvimentoEquipe){
        $acoes_extensao = AcaoExtensao::where('grau_envolvimento_equipe_id', $grauEnvolvimentoEquipe->id)->get();
        return $this->index($acoes_extensao);
    }

    public function acoesPorPalavraChave($palavraChave){
        $acoes_extensao = AcaoExtensao::where('palavras_chaves', 'like', "%{$palavraChave}%")->get();
        return $this->index($acoes_extensao);
    }

    public function acoesPorUsuario(User $usuario){
        $acoes_extensao = AcaoExtensao::where('user_id', $usuario->id)->get();
        return $this->index($acoes_extensao);
    }

    public function filtrar(Request $request){
        $filtro = array();
        if($request->nome_coordenador){
            array_push($filtro, ['nome_coordenador', 'like', "%{$request->nome_coordenador}%"]);
        }
        if($request->unidade_id){
            array_push($filtro, ['unidade_id', $request->unidade_id]);
        }
        if($request->modalidade){
            array_push($filtro, ['modalidade', $request->modalidade]);
        }
        if($request->area_tematica_id){
            array_push($filtro, ['at.area_tematica_id', $request->area_tematica_id]);
        }
        if($request->linha_extensao_id){
            array_push($filtro, ['linha_extensao_id', $request->linha_extensao_id]);
        }
        if($request->palavra_chave){
            array_push($filtro, ['palavras_chaves', $request->palavra_chave]);
        }
        if($request->cidade){
            array_push($filtro, ['municipio_id', $request->cidade]);
        }
        array_push($filtro, ['status', 'Aprovado']);
        $acoes_extensao = AcaoExtensao::join('acoes_extensao_areas_tematicas as at', 'at.acao_extensao_id', 'acoes_extensao.id')
                                        ->where($filtro)
                                        ->get(['acoes_extensao.*']);

        return $this->index($acoes_extensao);
    }

    public function filtrarMapa(Request $request){
        $filtro = array();
        if($request->nome_coordenador){
            array_push($filtro, ['nome_coordenador', 'like', "%{$request->nome_coordenador}%"]);
        }
        if($request->unidade_id){
            array_push($filtro, ['unidade_id', $request->unidade_id]);
        }
        if($request->modalidade){
            array_push($filtro, ['modalidade', $request->modalidade]);
        }
        if($request->area_tematica_id){
            array_push($filtro, ['at.area_tematica_id', $request->area_tematica_id]);
        }
        if($request->linha_extensao_id){
            array_push($filtro, ['linha_extensao', $request->linha_extensao_id]);
        }
        if($request->palavra_chave){
            array_push($filtro, ['palavra_chave', $request->palavra_chave]);
        }
        if($request->cidade){
            array_push($filtro, ['municipio_id', $request->cidade]);
        }
        array_push($filtro, ['georreferenciacao', '<>', '']);
        array_push($filtro, ['status', 'Aprovado']);
        $acoes_extensao = AcaoExtensao::join('acoes_extensao_areas_tematicas as at', 'at.acao_extensao_id', 'acoes_extensao.id')
                                        ->where($filtro)
                                        ->get(['acoes_extensao.*']);

        return $this->mapaExtensao($acoes_extensao);
    }

    public function mapaExtensao(Collection $acoes_extensao = null){
        $marcadores = array();

        if(is_null($acoes_extensao)){
            $acoes_extensao = AcaoExtensao::all();
        }

        /*foreach ($acoes_extensao as $acao){
            $campos = explode(',', $acao->georreferenciacao);
            if (count($campos) == 3){
                $marcador = array();
                $marcador['lat'] = $campos[1];
                $marcador['long'] = $campos[2];
                $link_acao = '/acoes-extensao/'.$acao->id;
                $marcador['info'] = '<a href=' . $link_acao . '>' . $acao->titulo . '<br>' . 'Local: '. $campos[0] . '</a>';
                array_push($marcadores, $marcador);
            }
        }*/

        //Adicionando marcadores pela cidade - teste
        foreach ($acoes_extensao as $acao){
                $marcador = array();
                $marcador['lat'] = $acao->municipio->latitude;
                $marcador['long'] = $acao->municipio->longitude;
                $link_acao = '/acoes-extensao/'.$acao->id;
                $marcador['info'] = '<a href=' . $link_acao . '>' . $acao->titulo . '<br>' . 'Local: '. $acao->municipio->nome_municipio . '</a>';
                array_push($marcadores, $marcador);
        }
        $unidades = Unidade::all();
        $linhas_extensao = LinhaExtensao::all();
        $areas_tematicas = AreaTematica::all();
        $estados = Municipio::select('uf')->distinct('uf')->orderBy('uf')->get();

        return view('acoes-extensao.mapa', [
            'acoes_extensao' => $acoes_extensao,
            'unidades' => $unidades,
            'linhas_extensao' => $linhas_extensao,
            'areas_tematicas' => $areas_tematicas,
            'estados' => $estados,
            'marcadores' => $marcadores
        ]);
    }
}
