<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUnidadeRequest;
use App\Http\Requests\UpdateUnidadeRequest;
use App\Models\Unidade;

class UnidadeController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:super');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $unidades = Unidade::all();
        return view('unidades.index', [
            'unidades' => $unidades
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('unidades.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUnidadeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUnidadeRequest $request)
    {
        $unidade = new Unidade();
        $unidade->nome = $request->nome;
        $unidade->sigla = $request->sigla;
        $unidade->save();
        return redirect()->route('unidade.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Unidade  $unidade
     * @return \Illuminate\Http\Response
     */
    public function show(Unidade $unidade)
    {
        return view('unidades.show', [
            'unidade' => $unidade
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Unidade  $unidade
     * @return \Illuminate\Http\Response
     */
    public function edit(Unidade $unidade)
    {
        return view('unidades.edit', [
            'unidade' => $unidade
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUnidadeRequest  $request
     * @param  \App\Models\Unidade  $unidade
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUnidadeRequest $request, Unidade $unidade)
    {
        $unidade->nome = $request->nome;
        $unidade->sigla = $request->sigla;
        $unidade->save();
        return redirect()->route('unidade.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Unidade  $unidade
     * @return \Illuminate\Http\Response
     */
    public function destroy(Unidade $unidade)
    {
        $unidade->delete();
        return redirect()->route('unidade.index');
    }
}
