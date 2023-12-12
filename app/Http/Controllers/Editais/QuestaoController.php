<?php

namespace App\Http\Controllers\Editais;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Questao;
use App\Models\Edital;

class QuestaoController extends Controller
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
            'tipo' => 'required',
            'enunciado' => 'required|max:1000',
            'edital_id' => 'required'
        ]);

        $questao = Questao::create([
            'tipo' => $request->tipo,
            'enunciado' => $request->enunciado,
            'edital_id' => $request->edital_id,
        ]);

        if($questao) {
            Log::channel('editais')->info('Usuario Nome: ' . Auth::user()->name . ' - Usuario ID: ' . Auth::user()->id . ' - Info: Edital questão cadastrada ID: '. $questao->id .'  - Endereço IP: ' . $request->ip());
            session()->flash('status', 'Questão cadastrada com sucesso!!!');
            session()->flash('alert', 'success');

            return redirect()->to("editais/$request->edital_id/questoes");
        }
        else {
            Log::channel('editais')->error('Usuario Nome: ' . Auth::user()->name . ' - Usuario ID: ' . Auth::user()->id . ' - Info: Edital questão não cadastrada ID: '. $questao->id .'  - Endereço IP: ' . $request->ip());
            session()->flash('status', 'Desculpe! Houve erro ao cadastrar');
            session()->flash('alert', 'danger');

            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Questao $questao
     * @return \Illuminate\Http\Response
     */
    public function show(Questao $questao)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Questao $questao
     * @return \Illuminate\Http\Response
     */
    public function edit(Edital $edital)
    {
        return view('questoes.create', compact('edital'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Questao $questao
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Questao $questao)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Questao $questao
     * @return \Illuminate\Http\Response
     */
    public function destroy(Questao $questao, Request $request)
    {
        //$questao = Questao::find($id);

        if($questao->delete()) {
            Log::channel('editais')->info('Usuario Nome: ' . Auth::user()->name . ' - Usuario ID: ' . Auth::user()->id . ' - Info: Edital questão removida ID '. $questao->id .'  - Endereço IP: ' . $request->ip());
            session()->flash('status', 'Questão removida com sucesso!!!');
            session()->flash('alert', 'success');

            return redirect()->to("editais/" . $questao->edital->id . "/questoes");
        }
        else {
            Log::channel('editais')->error('Usuario Nome: ' . Auth::user()->name . ' - Usuario ID: ' . Auth::user()->id . ' - Info: Edital questão não removida ID '. $questao->id .'  - Endereço IP: ' . $request->ip());
            session()->flash('status', 'Desculpe! Houve erro ao remover');
            session()->flash('alert', 'danger');

            return redirect()->back();
        }
    }
}
