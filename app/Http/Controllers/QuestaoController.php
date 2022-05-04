<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Questao;
use App\Models\Edital;

class QuestaoController extends Controller
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
            'tipo' => 'required',
            'enunciado' => 'required|max:255',
            'edital_id' => 'required'
        ]);

        $questao = Questao::create([
            'tipo' => $request->tipo,
            'enunciado' => $request->enunciado,
            'edital_id' => $request->edital_id,
        ]);

        if($questao) {

            session()->flash('status', 'Questão cadastrada com sucesso!!!');
            session()->flash('alert', 'success');

            return redirect()->to("editais/$request->edital_id/questoes");
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
    public function show($id)
    {
        //
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
    public function destroy($id)
    {
        $questao = Questao::find($id);

        if($questao->delete()) {

            session()->flash('status', 'Questão removida com sucesso!!!');
            session()->flash('alert', 'success');

            return redirect()->to("editais/" . $questao->edital->id . "/questoes");
        }
        else {
            session()->flash('status', 'Desculpe! Houve erro ao remover');
            session()->flash('alert', 'danger');

            return redirect()->back();
        }
    }
}
