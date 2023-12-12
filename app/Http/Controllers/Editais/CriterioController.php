<?php

namespace App\Http\Controllers\Editais;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use App\Models\Criterio;
use App\Models\Edital;

class CriterioController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:edital-administrador|super');
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
            Log::channel('editais')->info('Usuario Nome: ' . Auth::user()->name . ' - Usuario ID: ' . Auth::user()->id . ' - Info: Critério de edital cadastrado no edital '.$request->edital_id.'  - Endereço IP: ' . $request->ip());
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
     * @param  \App\Models\Criterio $criterio
     * @return \Illuminate\Http\Response
     */
    public function show(Criterio $criterio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Criterio $criterio
     * @return \Illuminate\Http\Response
     */
    public function edit(Edital $edital)
    {
        $criterios = $edital->criterios;

        return view('criterios.create', compact('edital', 'criterios'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Criterio $criterio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Criterio $criterio)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Criterio $criterio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Criterio $criterio)
    {
        $edital = $criterio->edital;

        if($criterio->delete()) {
            Log::channel('editais')->info('Usuario Nome: ' . Auth::user()->name . ' - Usuario ID: ' . Auth::user()->id . ' - Info: Critério de edital removido do edital '.$edital->id.' - Endereço IP: ' . $request->ip());
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
