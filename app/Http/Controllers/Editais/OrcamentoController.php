<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

use App\Models\Inscricao;
use App\Models\Edital;
use App\Models\Orcamento;
use App\Models\TipoItem;
use App\Models\User;

use App\Services\InscricaoEdital\ChecaPublicoAlvo;

class OrcamentoController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:edital-coordenador|edital-administrador|super');
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
     * @param \App\Models\Inscricao $inscricao
     * @return \Illuminate\Http\Response
     */
    public function create(Inscricao $inscricao)
    {
        $user = User::where('email', Auth::user()->id)->first();
        if( $inscricao->user_id != $user->id ) {
            session()->flash('status', 'Desculpe! Somente o coordenador pode editar');
            session()->flash('alert', 'warning');

            return redirect()->back();
        }
        //$inscricao = Inscricao::find($id);
        $edital = Edital::where('id', $inscricao->edital_id)->get(['valor_max_inscricao','valor_max_programa','tipo']);
        $valorMaxPorInscricao = $inscricao->tipo == 'Programa' ? $edital[0]['valor_max_programa'] : $edital[0]['valor_max_inscricao'] ;

        $orcamentoItens = Orcamento::join('item', 'item.id', 'orcamento_itens.item')
                                   ->join('tipo_item', 'tipo_item.id', 'orcamento_itens.tipo_item')
                                   ->where('inscricao_id', $inscricao->id)
                                   ->get(['orcamento_itens.*', 'item.nome as item', 'tipo_item.nome as tipoitem']);
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
        $user = User::where('email', Auth::user()->id)->first();
        $inscricao = Inscricao::find($request->inscricao_id);
        if( $inscricao->user_id != $user->id ) {
            session()->flash('status', 'Desculpe! Somente o coordenador pode editar');
            session()->flash('alert', 'warning');

            return redirect()->back();
        }

        $validated = $request->validate([
            'tipo_item' => 'required|max:190',
            'item' => 'required|max:190',
            'descricao' => 'required|max:190',
            'justificativa' => 'required|max:190',
            'valor' => 'required',
        ]);

        $valor = str_replace(',', '.', str_replace('.', '',$request->valor));

        $edital = Edital::where('id', $inscricao->edital_id)->get(['valor_max_inscricao','valor_max_programa','tipo']);
        $valorMaxPorInscricao = $inscricao->tipo == 'Programa' ? $edital[0]['valor_max_programa'] : $edital[0]['valor_max_inscricao'] ;
        $totalItens = Orcamento::where('inscricao_id', $inscricao->id)->sum('valor');
        $totalItens += $valor;

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
            'valor'  => $valor,
        ]);

        if($orcamento) {
            Log::channel('orcamento')->info('Usuario Nome: ' . $inscricao->user->name . ' - Usuario ID: ' . $inscricao->user->id . ' - Operação: Novo item de orcamento ' . $orcamento->id . ' - Endereço IP: ' . $request->ip());

            session()->flash('status', 'Item cadastrado com sucesso!');
            session()->flash('alert', 'success');

            return redirect()->to("/inscricao/$request->inscricao_id/orcamento");
        }
        else {
            Log::channel('orcamento')->error('Usuario Nome: ' . $inscricao->user->name . ' - Usuario ID: ' . $inscricao->user->id . ' - Operação: Novo item de orcamento ' . $orcamento->id . ' - Endereço IP: ' . $request->ip());

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
        $user = User::where('email', Auth::user()->id)->first();
        if( $orcamento->inscricao->user_id != $user->id ) {
            session()->flash('status', 'Desculpe! Somente o coordenador pode remover itens do orçamento');
            session()->flash('alert', 'warning');

            return redirect()->back();
        }
        
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
