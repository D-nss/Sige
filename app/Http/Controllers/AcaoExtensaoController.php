<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

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

class AcaoExtensaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $acoes_extensao = AcaoExtensao::all();
        return view('acoes-extensao.index', [
            'acoes_extensao' => $acoes_extensao
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
        $dados['areas_tematicas'] = implode(",", $request->areas_tematicas);
        $dados['municipio_id'] = $request->cidade;
        $dados['investimento'] = str_replace(',', '.', str_replace('.', '',$request->investimento));
        $dados_form = $request->all();
        $dados = array_merge($dados_form, $dados);
        $dados['status'] = 'Pendente';
        $acao_extensao = AcaoExtensao::create($dados);
        if($acao_extensao){
            session()->flash('status', 'Ação de Extensão adicionada com sucesso!');
            session()->flash('alert', 'success');
        } else {
            session()->flash('status', 'Erro ao adicionar a Ação de Extensão ao banco de dados.');
            session()->flash('alert', 'danger');
            return back();
        }
        //$acao_extensao->save();
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

        return view('acoes-extensao.edit', [
            'acao_extensao' => $acaoExtensao
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
        //$acaoExtensao->nome = $request->nome;
        $acaoExtensao->save();
        return redirect()->route('acao_extensao.index');
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
}
