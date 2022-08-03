<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\AvaliadorPorInscricao;

class AvaliadorPorInscricaoController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:edital-analista|edital-administrador|super');
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
            'avaliador_id' => 'required'
        ]);

        $avaliadorPorInscricao = AvaliadorPorInscricao::create([
            'user_id' => $request->avaliador_id,
            'inscricao_id' => $request->inscricao_id
        ]);

        if($avaliadorPorInscricao) {
            session()->flash('status', 'Avaliador cadastrado com sucesso');
            session()->flash('alert', 'success');

            return redirect()->back();
        }
        else {
            session()->flash('status', 'Não foi possível cadastrar o avaliador.');
            session()->flash('alert', 'danger');

            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\AvaliadorPorInscricao $avaliador_inscricao
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $avaliadorPorInscricao = AvaliadorPorInscricao::where('user_id', $request->user_id)
                                        ->where('inscricao_id', $request->inscricao_id)
                                        ->delete();

        if($avaliadorPorInscricao > 0) {
            session()->flash('status', 'Avaliador removido com sucesso');
            session()->flash('alert', 'success');

            return redirect()->back();
        }
        else {
            session()->flash('status', 'Não foi possível remover o avaliador.');
            session()->flash('alert', 'danger');

            return redirect()->back();
        }
    }
}
