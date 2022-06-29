<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\SubcomissaoTematica;

class SubcomissaoTematicaController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:edital-administrador|super');
    }
    
    public function index()
    {
        $subComissoesTematicas = SubcomissaoTematica::all();
        return view('subcomissao_tematica.index', compact('subComissoesTematicas'));
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
            'nome' => 'required|max:191'
        ]);

        $subComissaoTematica = SubcomissaoTematica::create([
            'nome' => $request->nome
        ]);

        if($subComissaoTematica) {

            session()->flash('status', 'Subcomissão cadastrada com sucesso!!!');
            session()->flash('alert', 'success');

            return redirect()->back();
        }
        else {
            session()->flash('status', 'Desculpe! Houve erro ao cadastrar');
            session()->flash('alert', 'danger');

            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubcomissaoTematica $subcomissao
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubcomissaoTematica $subcomissao)
    {
        //$subComissaoTematica = SubcomissaoTematica::findOrFail($id);
        
        if($subComissaoTematica->delete()) {

            session()->flash('status', 'Subcomissão deletada com sucesso!!!');
            session()->flash('alert', 'success');

            return redirect()->back();
        }
        else {
            session()->flash('status', 'Desculpe! Houve erro ao deletar');
            session()->flash('alert', 'danger');

            return redirect()->back();
        }
    }
}
