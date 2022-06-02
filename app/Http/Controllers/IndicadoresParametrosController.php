<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\IndicadoresParametros;

class IndicadoresParametrosController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:indicadores-admin|super');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $indicadoresParametros = IndicadoresParametros::first();

        return view('indicadores.manage', compact('indicadoresParametros'));
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
            'ano_base' => 'required|max:4',
            'data_limite' => 'required'
        ]);
        
        if(!!$request->id) {
            $indicadoresParametros = IndicadoresParametros::find($request->id);
        }
        else {
            $indicadoresParametros = new IndicadoresParametros();
        }

        $indicadoresParametros->ano_base = $request->ano_base;
        $indicadoresParametros->data_limite = $request->data_limite;

        if($indicadoresParametros->save()) {
            session()->flash('status', 'Parâmetros atualizados com sucesso!!!');
            session()->flash('alert', 'success');

            return redirect()->back();
        }
        else {
            session()->flash('status', 'Desculpe! Houve erro ao atualizar os parâmetros');
            session()->flash('alert', 'danger');

            return redirect()->back();
        }
    }

}
