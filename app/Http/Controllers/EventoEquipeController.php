<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Evento;
use App\Models\EventoEquipe;

class EventoEquipeController extends Controller
{
    public function index()
    {
        return view('eventos.equipe.index', compact('users', 'evento'));
    }

    public function create(Evento $evento)
    {
        $users = \App\Models\User::all();
        return view('eventos.equipe.create', compact('users', 'evento'));
    }

    public function store(Request $request, Evento $evento)
    {
        $input = $request->except('_token');

        $input['evento_id'] = $evento->id;

        $membroEquipeJaCadastrado = EventoEquipe::where('email', $input['email'])->first();

        if($membroEquipeJaCadastrado) {
            session()->flash('status', 'Membro de equipe de evento já cadastrado.');
            session()->flash('alert', 'warning');

            return redirect()->back();
        }

        $membroEquipe = EventoEquipe::create($input);

        if($membroEquipe) {
            session()->flash('status', 'Membro da equipe do evento cadastrado com sucesso.');
            session()->flash('alert', 'success');

            return redirect()->to('/eventos');
        }
        else {
            session()->flash('status', 'Desculpe! Houve um erro ao cadastrar o membro da equipe do evento.');
            session()->flash('alert', 'danger');

            return redirect()->back();
        }
    }
}
