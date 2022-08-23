<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Http\Requests\StoreAcaoExtensaoRequest;
use App\Http\Requests\UpdateAcaoExtensaoRequest;
use App\Models\AcaoExtensao;
use App\Models\LinhaExtensao;
use App\Models\AreaTematica;
use App\Models\GrauEnvolvimentoEquipe;
use App\Models\Unidade;
use App\Models\User;
use App\Models\Municipio;
use App\Models\TipoParceiro;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class AcaoExtensaoController extends Controller
{
    public function dashboard(){

        //pegar id unidade do usuario
        $unidade = Unidade::where('id', 1)->first();
        $acoes_extensao = AcaoExtensao::where('unidade_id', 1)->limit(3)->get();
        $pendentes = AcaoExtensao::where('unidade_id', 1)->where('status', 'Pendente')->get();
        $total = AcaoExtensao::all()->count();
        $total_unidade = AcaoExtensao::where('unidade_id', 1)->count();
        $total_concluidos = AcaoExtensao::where('unidade_id', 1)->where('situacao', 3)->count();
        $total_andamento = AcaoExtensao::where('unidade_id', 1)->where('situacao', 2)->count();
        $total_desativados = AcaoExtensao::where('unidade_id', 1)->where('situacao', 1)->count();

        $unidades = Unidade::all();
        $linhas_extensao = LinhaExtensao::all();
        $areas_tematicas = AreaTematica::all();
        $estados = Municipio::select('uf')->distinct('uf')->orderBy('uf')->get();

        return view('acoes-extensao.dashboard', [
            'unidade' => $unidade,
            'acoes_extensao' => $acoes_extensao,
            'pendentes' => $pendentes,
            'total' => $total,
            'total_unidade' => $total_unidade,
            'total_concluidos' => $total_concluidos,
            'total_andamento' => $total_andamento,
            'total_desativados' => $total_desativados,
            'unidades' => $unidades,
            'linhas_extensao' => $linhas_extensao,
            'areas_tematicas' => $areas_tematicas,
            'estados' => $estados
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
        $unidades = Unidade::all();
        //$user = User::where('email', Auth::user()->id)->first();
        $estados = Municipio::select('uf')->distinct('uf')->orderBy('uf')->get();
        $tipos_parceiro = TipoParceiro::all();
        $graus_envolvimento_equipe = GrauEnvolvimentoEquipe::all();

        return view('acoes-extensao.create', [
            'linhas_extensao' => $linhas_extensao,
            'areas_tematicas' => $areas_tematicas,
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
        //$user = User::where('email', Auth::user()->id)->first();
        $dados = array('user_id' => 1);
        //$dados['areas_tematicas'] = implode(",", $request->areas_tematicas);
        $dados['municipio_id'] = $request->cidade;
        $dados['investimento'] = str_replace(',', '.', str_replace('.', '',$request->investimento));
        $dados_form = $request->all();
        $dados = array_merge($dados_form, $dados);
        $dados['status'] = 'Pendente';
        $areasTematicasInsert = array();

        $acao_extensao = DB::transaction(function() use( $dados, $areasTematicasInsert) {
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

        return redirect()->route('acao_extensao.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AcaoExtensao  $acaoExtensao
     * @return \Illuminate\Http\Response
     */
    public function show(AcaoExtensao $acaoExtensao)
    {
        return view('acoes-extensao.show', [
            'acao_extensao' => $acaoExtensao
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
        $unidades = Unidade::all();
        //$user = User::where('email', Auth::user()->id)->first();
        $estados = Municipio::select('uf')->distinct('uf')->orderBy('uf')->get();
        $tipos_parceiro = TipoParceiro::all();
        $graus_envolvimento_equipe = GrauEnvolvimentoEquipe::all();

        return view('acoes-extensao.edit', [
            'acao_extensao' => $acaoExtensao,
            'acaoLocal' => $acaoLocal,
            'linhas_extensao' => $linhas_extensao,
            'areas_tematicas' => $areas_tematicas,
            'estados' => $estados,
            'unidades' => $unidades,
            'tipos_parceiro' => $tipos_parceiro,
            'graus_envolvimento_equipe' => $graus_envolvimento_equipe
        ]);
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
        //$user = User::where('email', Auth::user()->id)->first();
        $dados = array('user_id' => 1);
        //$dados['areas_tematicas'] = implode(",", $request->areas_tematicas);
        $dados['municipio_id'] = $request->cidade;
        $dados['investimento'] = str_replace(',', '.', str_replace('.', '',$request->investimento));
        $dados_form = $request->all();
        $dados = array_merge($dados_form, $dados);
        $dados['status'] = 'Pendente';
        $areasTematicasInsert = array();

        $transacao = DB::transaction(function() use( $dados, $areasTematicasInsert, $acaoExtensao) {

            $acaoExtensao->user_id = $dados['user_id'];
            $acaoExtensao->tipo = $dados['tipo'];
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
            $acaoExtensao->situacao = $dados['situacao'];
            $acaoExtensao->georreferenciacao = $dados['georreferenciacao'];
            $acaoExtensao->unidade_id = $dados['unidade_id'];
            $acaoExtensao->nome_coordenador = $dados['nome_coordenador'];
            $acaoExtensao->tipo_coordenador = $dados['tipo_coordenador'];
            $acaoExtensao->equipe = $dados['equipe'];
            $acaoExtensao->qtd_graduacao = $dados['qtd_graduacao'];
            $acaoExtensao->qtd_pos_graduacao = $dados['qtd_pos_graduacao'];
            $acaoExtensao->parceiro = $dados['parceiro'];
            $acaoExtensao->tipo_parceiro_id = $dados['tipo'];
            $acaoExtensao->impactos_universidade = $dados['impactos_universidade'];
            $acaoExtensao->impactos_sociedade = $dados['impactos_sociedade'];
            $acaoExtensao->grau_envolvimento_equipe_id = $dados['grau_envolvimento_equipe_id'];
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

            return redirect()->route('acao_extensao.index');
        }
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

    public function aprovar(AcaoExtensao $acaoExtensao){
        $acaoExtensao->aprovado_user_id = 1;
        $acaoExtensao->status = 'Aprovado';
        $acaoExtensao->save();
        session()->flash('status', 'Ação de Extensão aprovada!');
        session()->flash('alert', 'success');

        return redirect()->route('acao_extensao.index');
    }

    public function acoesPorUnidade(Unidade $unidade){
        $acoes_extensao = AcaoExtensao::where('unidade_id', $unidade->id)->get();
        return $this->index($acoes_extensao);
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

    public function acoesPorTipo($id){
        $acoes_extensao = AcaoExtensao::where('tipo', $id)->get();
        return $this->index($acoes_extensao);
    }

    public function acoesPorSituacao($id){
        $acoes_extensao = AcaoExtensao::where('situacao', $id)->get();
        return $this->index($acoes_extensao);
    }

    public function acoesPorTipoParceiro(TipoParceiro $tipoParceiro){
        $acoes_extensao = AcaoExtensao::where('tipo_parceiro_id', $tipoParceiro->id)->get();
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

    public function filtrar(Request $request){
        $filtro = array();
        if($request->nome_coordenador){
            array_push($filtro, ['nome_coordenador', 'like', "%{$request->nome_coordenador}%"]);
        }
        if($request->unidade_id){
            array_push($filtro, ['unidade_id', $request->unidade_id]);
        }
        if($request->tipo){
            array_push($filtro, ['tipo', $request->tipo]);
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
        if($request->tipo){
            array_push($filtro, ['tipo', $request->tipo]);
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
