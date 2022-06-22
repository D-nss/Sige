<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAcaoExtensaoRequest;
use App\Http\Requests\UpdateAcaoExtensaoRequest;
use App\Models\AcaoExtensao;
use App\Models\LinhaExtensao;

class AcaoExtensaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $acoesExtensao = AcaoExtensao::all();
        return view('acoes-extensao.index', [
            'acoesExtensao' => $acoesExtensao
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $linhas = LinhaExtensao::all();
        return view('acoes-extensao.create', [
            'linhas' => $linhas
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
        $acaoExtensao = new AcaoExtensao();
        //$acaoExtensao->atributo = $request->atributo;
        $acaoExtensao->save();
        return redirect()->route('acao-extensao.index');
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
            'acaoExtensao' => $acaoExtensao
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
        return view('acoes-extensao.edit', [
            'acaoExtensao' => $acaoExtensao
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
        return redirect()->route('acao-extensao.index');
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
        return redirect()->route('acao-extensao.index');
    }
}
