<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Indicador;

class IndicadoresController extends Controller
{
    public function index()
    {
       $indicadores = Indicador::all();

       return view('indicadores.itens.index', compact('indicadores'));
    }

    public function create()
    {
        return view('indicadores.itens.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'indicador' => 'required|max:500',
            'descricao_indicador' => 'required|max:500',
            'item_planes' => 'required|max:500',
        ]);

        $indicador = Indicador::create(
            [
                'indicador' => $request->indicador,
                'descricao_indicador' => $request->descricao_indicador,
                'item_planes' => $request->item_planes,
                'ativo' => $request->ativo,
            ]
        );

        if($indicador) {
            session()->flash('status', 'Indicador cadastrado com sucesso.');
            session()->flash('alert', 'success');

            return redirect()->to('indicadores-itens');
        }
        else {
            session()->flash('status', 'Erro ao  cadastrar indicador.');
            session()->flash('alert', 'danger');

            return redirect()->back();
        }
    }

    public function show(Indicador $indicador) 
    {
        return view('indicadores.itens.show', compact('indicador'));
    }

    public function edit(Indicador $indicador) 
    {
        return view('indicadores.itens.edit', compact('indicador'));
    }

    public function update(Request $request, Indicador $indicador)
    {
        $validated = $request->validate([
            'indicador' => 'required|max:500',
            'descricao_indicador' => 'required|max:500',
            'item_planes' => 'required|max:500',
        ]);

        $updated = $indicador->update([
            'indicador' => $request->indicador,
            'descricao_indicador' => $request->descricao_indicador,
            'item_planes' => $request->item_planes,
            'ativo' => $request->ativo,
        ]);

        if($updated) {
            session()->flash('status', 'Indicador atualizado com sucesso.');
            session()->flash('alert', 'success');

            return redirect()->to('indicadores-itens');
        }
        else {
            session()->flash('status', 'Erro ao  atualizar indicador.');
            session()->flash('alert', 'danger');

            return redirect()->back();
        }

    }

    public function destroy(Indicador $indicador)
    {
        if($indicador->delete()) {
            session()->flash('status', 'Indicador deletado com sucesso.');
            session()->flash('alert', 'success');

            return redirect()->to('indicadores-itens');
        }
        else {
            session()->flash('status', 'Erro ao  deletar indicador.');
            session()->flash('alert', 'danger');

            return redirect()->back();
        }
    }
}
