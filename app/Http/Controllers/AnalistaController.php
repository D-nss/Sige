<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Inscricao;

class AnalistaController extends Controller
{
    public function create(Inscricao $inscricao)
    {
        //$inscricao = Inscricao::findOrFail($id);
        $users = User::orderBy('name', 'asc')->get();

        $user = User::where('id', 1)->first();

        if($inscricao->user_id == $user->id) {
            session()->flash('status', 'Desculpe! Não é permitido adicionar avaliadores à própria inscrição');
            session()->flash('alert', 'danger');

            return redirect()->back();
        }

        return view('inscricao.indicar-analista', compact('inscricao', 'users'));
    }

    public function store(Request $request, Inscricao $inscricao)
    {
        $validated = $request->validate([
            'analista_id' => 'required',
        ]);

        //$inscricao = Inscricao::findOrFail($id);
        $inscricao->analista_user_id = $request->analista_id;

        if($inscricao->update()) {
            session()->flash('status', 'Analista cadastrado com sucesso.');
            session()->flash('alert', 'success');

            return redirect()->back();
        }
    }

    public function destroy(Request $request, Inscricao $inscricao)
    {
        //$inscricao = Inscricao::findOrFail($id);
        $inscricao->analista_user_id = NULL;

        if($inscricao->update()) {
            session()->flash('status', 'Analista removido com sucesso.');
            session()->flash('alert', 'success');

            return redirect()->back();
        }

    }
}
