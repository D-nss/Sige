<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Avaliador;
use App\Models\User;

class AvaliadorController extends Controller
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
            'avaliador' => 'required',
            'edital_id' => 'required'
        ]);

        $avaliador = Avaliador::create([
            'user_id' => $request->avaliador,
            'edital_id' => $request->edital_id,
        ]);

        if($avaliador) {

            session()->flash('status', 'Avaliador cadastrado com sucesso!!!');
            session()->flash('alert', 'success');

            return redirect()->to("editais/$request->edital_id/avaliadores");
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
        $avaliador = Avaliador::find($id);

        if($avaliador->delete()) {

            session()->flash('status', 'Avaliador removido com sucesso!!!');
            session()->flash('alert', 'success');

            return redirect()->to("editais/" . $avaliador->edital->id . "/avaliadores");
        }
        else {
            session()->flash('status', 'Desculpe! Houve erro ao remover');
            session()->flash('alert', 'danger');

            return redirect()->back();
        }
    }

    public function getAvaliadorBySubcomissao(Request $request)
    {
        if($request->ajax()) {
            $avaliadores = User::join('unidades', 'users.unidade_id', 'unidades.id')
                    ->where('unidades.subcomissao_tematica_id', $request->get('subcomissao_id'))
                    ->get(['users.id', 'users.name']);

            echo json_encode($avaliadores);
        }

    }
}
