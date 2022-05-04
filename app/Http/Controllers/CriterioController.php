<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Criterio;
use App\Models\Edital;

class CriterioController extends Controller
{
    public function __construct()
    {
        //$this->middleware('role:super,admin');
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
    public function create()
    {
        //
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
            'descricao' => 'required',
            'edital_id' => 'required'
        ]);
        
        $criterio = Criterio::create([
            'descricao' => $request->descricao,
            'edital_id' => $request->edital_id,
        ]);

        if($criterio) {

            session()->flash('status', 'Critério cadastrado com sucesso!!!');
            session()->flash('alert', 'success');

            return redirect()->to("editais/$request->edital_id/criterios");
        }
        else {
            session()->flash('status', 'Desculpe! Houve erro ao cadastrar');
            session()->flash('alert', 'danger');

            return redirect()->back();
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Criterio $criterio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Criterio $criterio)
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
    public function update(Request $request, Criterio $criterio)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Criterio $criterio)
    {
        $edital = $criterio->edital;

        if($criterio->delete()) {

            session()->flash('status', 'Critério removido com sucesso!!!');
            session()->flash('alert', 'success');

            return redirect()->to("editais/$edital->id/criterios");
        }
        else {
            session()->flash('status', 'Desculpe! Houve erro ao remover');
            session()->flash('alert', 'danger');

            return redirect()->back();
        }
    }
}
