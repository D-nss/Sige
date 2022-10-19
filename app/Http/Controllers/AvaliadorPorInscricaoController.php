<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\AvaliadorPorInscricao;
use App\Models\User;
use App\Models\Inscricao;

class AvaliadorPorInscricaoController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:edital-coordenador|edital-analista|edital-administrador|super');
    }

    public function create(Inscricao $inscricao)
    {
        $users = User::join('unidades', 'users.unidade_id', 'unidades.id')
                        ->orderBy('name', 'asc')
                        ->get(['users.*', 'unidades.sigla']);

        $user = User::where('email', Auth::user()->id)->first();

        if($inscricao->user_id == $user->id) {
            session()->flash('status', 'Desculpe! Não é permitido adicionar avaliadores à própria inscrição');
            session()->flash('alert', 'danger');

            return redirect()->back();
        }

        return view('inscricao.avaliadores', compact('inscricao', 'users'));
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
            $avaliadorPorInscricao->user->notify(new \App\Notifications\AdicionarAvaliador($avaliadorPorInscricao));
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
