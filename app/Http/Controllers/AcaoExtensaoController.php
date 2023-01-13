<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Http\Requests\StoreAcaoExtensaoRequest;
use App\Http\Requests\UpdateAcaoExtensaoRequest;
use App\Models\AcaoExtensao;
use App\Models\AcaoExtensaoColaborador;
use App\Models\AcaoExtensaoLocal;
use App\Models\AcaoExtensaoODS;
use App\Models\AcaoExtensaoParceiro;
use App\Models\LinhaExtensao;
use App\Models\AreaTematica;
use App\Models\Comentario;
use App\Models\ComissaoUser;
use App\Models\GrauEnvolvimentoEquipe;
use App\Models\Unidade;
use App\Models\User;
use App\Models\Municipio;
use App\Models\ObjetivoDesenvolvimentoSustentavel;
use App\Models\TipoParceiro;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class AcaoExtensaoController extends Controller
{
    public function dashboard(){

        if(App::environment('local')){
            $user = User::where('id', 1)->first();
        } else {
            $user = User::where('email', Auth::user()->id)->first();
        }

        $unidade = Unidade::where('id', $user->unidade_id)->first();
        $acoes_extensao = AcaoExtensao::where('unidade_id', $unidade->id)->limit(3)->get();
        $pendentes = AcaoExtensao::where('unidade_id', $unidade->id)->where('status', 'Pendente')->get();
        $rascunhos = AcaoExtensao::where('unidade_id', $unidade->id)->where('status', 'Rascunho')->get();

        //pegar id do usuario
        $acoes_extensao_usuario =  AcaoExtensao::where('user_id', $user->id)->get();

        $total = AcaoExtensao::all()->count();
        $total_unidade = AcaoExtensao::where('unidade_id', $unidade->id)->where('status', 'Aprovado')->count();
        if(!$total == 0){
            $porcentagem_unidade = (int) ($total_unidade*100/$total);
        } else{
            $porcentagem_unidade = 0;
        }

        $total_concluidos = AcaoExtensao::where('unidade_id', $unidade->id)->where('status', 'Concluido')->count();
        $total_andamento = AcaoExtensao::where('unidade_id', $unidade->id)->where('status', 'Aprovado')->count();
        $total_desativados = AcaoExtensao::where('unidade_id', $unidade->id)->where('status', 'Desativado')->count();


        return view('acoes-extensao.dashboard', [
            'unidade' => $unidade,
            'acoes_extensao_usuario' => $acoes_extensao_usuario,
            'acoes_extensao' => $acoes_extensao,
            'pendentes' => $pendentes,
            'rascunhos' => $rascunhos,
            'total' => $total,
            'total_unidade' => $total_unidade,
            'porcentagem_unidade' => $porcentagem_unidade,
            'total_concluidos' => $total_concluidos,
            'total_andamento' => $total_andamento,
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
        if(is_null($acoes_extensao)){
            $acoes_extensao = AcaoExtensao::all();
        }
        $unidades = Unidade::all();
        $linhas_extensao = LinhaExtensao::all();
        $areas_tematicas = AreaTematica::all();
        $estados = Municipio::select('uf')->distinct('uf')->orderBy('uf')->get();

        return view('acoes-extensao.index', [
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
        if(App::environment('local')){
            $user = User::where('id', 1)->first();
        } else {
            $user = User::where('email', Auth::user()->id)->first();
        }
        $unidade = Unidade::where('id', $user->unidade_id)->first();
        //$user = User::where('email', Auth::user()->id)->first();
        $estados = Municipio::select('uf')->distinct('uf')->orderBy('uf')->get();
        $tipos_parceiro = TipoParceiro::all();
        $graus_envolvimento_equipe = GrauEnvolvimentoEquipe::all();

        return view('acoes-extensao.create', [
            'linhas_extensao' => $linhas_extensao,
            'areas_tematicas' => $areas_tematicas,
            'ods' => $ods,
            'estados' => $estados,
            'unidade' => $unidade,
            'tipos_parceiro' => $tipos_parceiro,
            'graus_envolvimento_equipe' => $graus_envolvimento_equipe
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
        $acaoLocal = Municipio::select('uf', 'nome_municipio')->where('id', $acaoExtensao->municipio_id)->get();
        $linhas_extensao = LinhaExtensao::all();
        $areas_tematicas = AreaTematica::all();
        $ods = ObjetivoDesenvolvimentoSustentavel::all();
        $unidades = Unidade::all();
        $estados = Municipio::select('uf')->distinct('uf')->orderBy('uf')->get();
        $tipos_parceiro = TipoParceiro::all();
        $graus_envolvimento_equipe = GrauEnvolvimentoEquipe::all();

        return view('acoes-extensao.edit', [
            'acao_extensao' => $acaoExtensao,
            'acaoLocal' => $acaoLocal,
            'linhas_extensao' => $linhas_extensao,
            'areas_tematicas' => $areas_tematicas,
            'ods' => $ods,
            'estados' => $estados,
            'unidades' => $unidades,
            'tipos_parceiro' => $tipos_parceiro,
            'graus_envolvimento_equipe' => $graus_envolvimento_equipe
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
            $user = User::where('id', 1)->first();
            $vinculo_coordenador = 'Teste Vinculo Coordenador';
        } else {
            $user = User::where('email', Auth::user()->id)->first();
            $vinculo_coordenador = Auth::user()->employeetype;
        }
        $dados = array('user_id' => $user->id);
        $dados['nome_coordenador'] = $user->name;
        $dados['email_coordenador'] = $user->email;
        $dados['vinculo_coordenador'] = $vinculo_coordenador;
        $dados['municipio_id'] = $request->cidade;
        $dados['investimento'] = str_replace(',', '.', str_replace('.', '',$request->investimento));
        $dados_form = $request->all();
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
            session()->flash('status', 'Ação de Extensão adicionada com sucesso!');
            session()->flash('alert', 'success');
        } else {
            session()->flash('status', 'Erro ao adicionar a Ação de Extensão ao banco de dados.');
            session()->flash('alert', 'danger');
            return back();
        }

        return redirect()->route('acao_extensao.equipe', ['acao_extensao' => $acao_extensao->id] );
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
        $dados['nome_coordenador'] = $user->name;
        $dados['email_coordenador'] = $user->email;
        $dados['vinculo_coordenador'] = $vinculo_coordenador;
        $dados['municipio_id'] = $request->cidade;
        $dados['investimento'] = str_replace(',', '.', str_replace('.', '',$request->investimento));
        $dados_form = $request->all();
        $dados = array_merge($dados_form, $dados);
        $dados['status'] = 'Rascunho';
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
            $acaoExtensao->data_inicio = $dados['data_inicio'];
            $acaoExtensao->data_fim = $dados['data_fim'];
            $acaoExtensao->municipio_id = $dados['municipio_id'];
            $acaoExtensao->unidade_id = $dados['unidade_id'];
            $acaoExtensao->impactos_universidade = $dados['impactos_universidade'];
            $acaoExtensao->impactos_sociedade = $dados['impactos_sociedade'];
            $acaoExtensao->investimento = $dados['investimento'];
            $acaoExtensao->status = $dados['status'];
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
            session()->flash('status', 'Desculpe! Houve erro na atualização da Ação de Extensão');
            session()->flash('alert', 'danger');
            return redirect()->back();
        }
        else {
            session()->flash('status', 'Ação de Extensão atualizada com sucesso!');
            session()->flash('alert', 'success');
            return redirect()->route('acao_extensao.equipe', ['acao_extensao' => $acaoExtensao->id] );
        }
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
        $colaboradorCriado = AcaoExtensaoColaborador::create($request->all());
        if($colaboradorCriado){
            session()->flash('status', 'Colaborador(a) adicionado(a) com sucesso!');
            session()->flash('alert', 'success');
        } else {
            session()->flash('status', 'Erro ao adicionar colaborador(a) ao banco de dados.');
            session()->flash('alert', 'danger');
            return back();
        }
        $acaoExtensao = AcaoExtensao::where('id', $request->acao_extensao_id)->first();

        return redirect()->route('acao_extensao.equipe', ['acao_extensao' => $acaoExtensao->id] );
    }

    public function removeColaborador($id)
    {
        $acaoExtensaoColadorador = AcaoExtensaoColaborador::where('id', $id)->first();
        $acaoExtensao = AcaoExtensao::where('id', $acaoExtensaoColadorador->acao_extensao_id)->first();
        if($acaoExtensaoColadorador->delete()) {
            session()->flash('status', 'Colaborador removido!');
            session()->flash('alert', 'success');
        }
        else {
            session()->flash('status', 'Colaborador não removido!');
            session()->flash('alert', 'danger');
        }

        return redirect()->route('acao_extensao.equipe', ['acao_extensao' => $acaoExtensao->id] );
    }

    public function curricularizacao(Request $request)
    {
        $this->validate($request, [
            'vagas_curricularizacao' => ['required'],
            'grau_envolvimento_equipe_id' => ['required']
        ]);
        $dados = $request->all();
        $acaoAtualizada = AcaoExtensao::where('id', $request->acao_extensao_id)->first();
        $acaoAtualizada->fill($dados)->save();
        if($acaoAtualizada){
            session()->flash('status', 'Dados de Curricularização atualizados com sucesso');
            session()->flash('alert', 'success');
        } else {
            session()->flash('status', 'Erro ao atualizar dados de Curricularização.');
            session()->flash('alert', 'danger');
        }

        return redirect()->route('acao_extensao.equipe', ['acao_extensao' => $acaoAtualizada->id] );
    }

    public function locais(AcaoExtensao $acaoExtensao)
    {
        $locais_acao_extensao = AcaoExtensaoLocal::where('acao_extensao_id', $acaoExtensao->id)->orderBy('local')->get();

        return view('acoes-extensao.locais', [
            'acao_extensao' => $acaoExtensao,
            'locais_acao_extensao' => $locais_acao_extensao
        ]);
    }

    public function insereLocal(Request $request)
    {
        $localCriado = AcaoExtensaoLocal::create($request->all());
        if($localCriado){
            session()->flash('status', 'Local adicionado com sucesso!');
            session()->flash('alert', 'success');
        } else {
            session()->flash('status', 'Erro ao adicionar local ao banco de dados.');
            session()->flash('alert', 'danger');
            return back();
        }
        $acaoExtensao = AcaoExtensao::where('id', $request->acao_extensao_id)->first();

        return redirect()->route('acao_extensao.locais', ['acao_extensao' => $acaoExtensao->id] );
        //return $this->locais($acaoExtensao);
    }

    public function removeLocal($id)
    {
        $acaoExtensaoLocal = AcaoExtensaoLocal::where('id', $id)->first();
        $acaoExtensao = AcaoExtensao::where('id', $acaoExtensaoLocal->acao_extensao_id)->first();
        if($acaoExtensaoLocal->delete()) {
            session()->flash('status', 'Local removido!');
            session()->flash('alert', 'success');
        }
        else {
            session()->flash('status', 'Local não removido!');
            session()->flash('alert', 'danger');
        }

        return redirect()->route('acao_extensao.locais', ['acao_extensao' => $acaoExtensao->id] );
    }

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
        $parceiroCriado = AcaoExtensaoParceiro::create($request->all());
        if($parceiroCriado){
            session()->flash('status', 'Parceiro(a) adicionado(a) com sucesso!');
            session()->flash('alert', 'success');
        } else {
            session()->flash('status', 'Erro ao adicionar parceiro(a) ao banco de dados.');
            session()->flash('alert', 'danger');

            return back();
        }
        $acaoExtensao = AcaoExtensao::where('id', $request->acao_extensao_id)->first();

        return redirect()->route('acao_extensao.parceiros', ['acao_extensao' => $acaoExtensao->id] );
        //return $this->parceiros($acaoExtensao);
    }

    public function removeParceiro($id)
    {
        $acaoExtensaoParceiro = AcaoExtensaoParceiro::where('id', $id)->first();
        $acaoExtensao = AcaoExtensao::where('id', $acaoExtensaoParceiro->acao_extensao_id)->first();
        if($acaoExtensaoParceiro->delete()) {
            session()->flash('status', 'Colaborador removido!');
            session()->flash('alert', 'success');
        }
        else {
            session()->flash('status', 'Colaborador não removido!');
            session()->flash('alert', 'danger');
        }

        return redirect()->route('acao_extensao.parceiros', ['acao_extensao' => $acaoExtensao->id] );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AcaoExtensao  $acaoExtensao
     * @return \Illuminate\Http\Response
     */
    public function show(AcaoExtensao $acaoExtensao)
    {
        $colaboradores_acao_extensao = AcaoExtensaoColaborador::where('acao_extensao_id', $acaoExtensao->id)->orderBy('nome')->get();
        $locais_acao_extensao = AcaoExtensaoLocal::where('acao_extensao_id', $acaoExtensao->id)->orderBy('local')->get();
        $parceiros_acao_extensao = AcaoExtensaoParceiro::where('acao_extensao_id', $acaoExtensao->id)->orderBy('nome')->get();

        if(App::environment('local')){
            $user = User::where('id', 1)->first();
        } else {
            $user = User::where('email', Auth::user()->id)->first();
        }

        $userNaComissao = ComissaoUser::join('comissoes', 'comissoes.id', 'comissoes_users.comissao_id')
                                        ->where('comissoes.unidade_id', $acaoExtensao->unidade_id)
                                        ->where('comissoes_users.user_id', $user->id)
                                        ->first();

        //restringindo usuario aprovar sua ação
        if($acaoExtensao->user_id == $user->id){
            $userNaComissao = false;
            $userCoordenadorAcao = $user;
        }

        return view('acoes-extensao.show', [
            'acao_extensao' => $acaoExtensao,
            'colaboradores_acao_extensao' => $colaboradores_acao_extensao,
            'locais_acao_extensao' => $locais_acao_extensao,
            'parceiros_acao_extensao' => $parceiros_acao_extensao,
            'userNaComissao' => $userNaComissao,
            '$userCoordenadorAcao' => $userCoordenadorAcao
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

    public function submeter(AcaoExtensao $acaoExtensao){

        if(App::environment('local')){
            $acaoExtensao->aprovado_user_id = 1;
        } else {
            $user = User::where('email', Auth::user()->id)->first();
            $acaoExtensao->aprovado_user_id = $user->id;
        }

        $acaoExtensao->status = 'Pendente';
        $acaoExtensao->save();
        session()->flash('status', 'Ação de Extensão Submetida para aprovação!');
        session()->flash('alert', 'success');

        return redirect()->route('acao_extensao.index');
    }

    public function aprovar(AcaoExtensao $acaoExtensao){

        if(App::environment('local')){
            $acaoExtensao->aprovado_user_id = 1;
        } else {
            $user = User::where('email', Auth::user()->id)->first();
            $acaoExtensao->aprovado_user_id = $user->id;
        }

        $acaoExtensao->status = 'Aprovado';
        $acaoExtensao->save();
        session()->flash('status', 'Ação de Extensão aprovada!');
        session()->flash('alert', 'success');

        return redirect()->route('acao_extensao.index');
    }

    public function enviarComentario(AcaoExtensao $acaoExtensao, Request $request){
        //$user = User::where('email', Auth::user()->id)->first();
        $user = User::where('id', 1)->first();

        $comentario = new Comentario();
        $comentario->acao_extensao_id = $acaoExtensao->id;
        $comentario->user_id = $user->id;
        $comentario->comentario = $request->comentario;
        $comentario->save();

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

    /*
    public function acoesPorSituacao($id){
        $acoes_extensao = AcaoExtensao::where('situacao', $id)->get();
        return $this->index($acoes_extensao);
    }*/

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
            array_push($filtro, ['linha_extensao', $request->linha_extensao_id]);
        }
        if($request->palavra_chave){
            array_push($filtro, ['palavra_chave', $request->palavra_chave]);
        }
        if($request->cidade){
            array_push($filtro, ['municipio_id', $request->cidade]);
        }
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
        $acoes_extensao = AcaoExtensao::join('acoes_extensao_areas_tematicas as at', 'at.acao_extensao_id', 'acoes_extensao.id')
                                        ->where($filtro)
                                        ->get(['acoes_extensao.*']);

        return $this->mapaExtensao($acoes_extensao);
    }

    public function mapaExtensao(Collection $acoes_extensao = null){
        $marcadores = array();

        if(is_null($acoes_extensao)){
            $acoes_extensao = AcaoExtensao::where('georreferenciacao', '<>', '')->get();
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
