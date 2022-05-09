<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Inscricao;
use App\Models\Edital;
use App\Models\Orcamento;
use App\Models\TipoItem;

class OrcamentoController extends Controller
{
    public function __construct()
    {
        //$this->middleware('role:docente,super,admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $inscricao = Inscricao::find($id);
        $valorMaxPorInscricao = Edital::where('id', $inscricao->edital_id)->get(['valor_max_inscricao']);
        $valorMaxPorInscricao = $valorMaxPorInscricao[0]['valor_max_inscricao'];
        $orcamentoItens = Orcamento::where('inscricao_id', $inscricao->id)->get();
        $totalItens = Orcamento::where('inscricao_id', $inscricao->id)->sum('valor');

        $tiposItens = TipoItem::all();
        
        return view('orcamento.create', compact('inscricao', 'valorMaxPorInscricao', 'orcamentoItens', 'totalItens', 'tiposItens'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'tipo_item' => 'required|max:190',
            'item' => 'required|max:190',
            'descricao' => 'required|max:190',
            'justificativa' => 'required|max:190',
            'valor' => 'required|numeric',
        ]);

        $inscricao = Inscricao::find($request->inscricao_id);
        $valorMaxPorInscricao = Edital::where('id', $inscricao->edital_id)->get(['valor_max_inscricao']);
        $valorMaxPorInscricao = $valorMaxPorInscricao[0]['valor_max_inscricao'];
        $totalItens = Orcamento::where('inscricao_id', $inscricao->id)->sum('valor');
        $totalItens += $request->valor;

        if($totalItens > $valorMaxPorInscricao) {
            session()->flash('status', 'Desculpe! O valor ultrapassa o total disponível');
            session()->flash('alert', 'warning');

            return redirect()->back(); 
        }

        $orcamento = Orcamento::create([
            'inscricao_id' => $request->inscricao_id,
            'tipo_item'  => $request->tipo_item,
            'item'  => $request->item,
            'descricao'  => $request->descricao,
            'justificativa'  => $request->justificativa,
            'valor'  => floatval(str_replace('.','', $request->valor))
        ]);

        if($orcamento) {
            session()->flash('status', 'Item cadastrado com sucesso!');
            session()->flash('alert', 'success');

            return redirect()->to("/inscricao/$request->inscricao_id/orcamento");
        }
        else {
            session()->flash('status', 'Desculpe! Houve erro ao cadastrar item.');
            session()->flash('alert', 'warning');

            return redirect()->back(); 
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Orcamento $orcamento)
    {
        if($orcamento->delete()) {
            session()->flash('status', 'Item removido com sucesso!');
            session()->flash('alert', 'success');

            return redirect()->to("/inscricao/$orcamento->inscricao_id/orcamento");
        }
        else {
            session()->flash('status', 'Desculpe! Houve erro ao remover item.');
            session()->flash('alert', 'warning');

            return redirect()->back(); 
        }
    }
}
