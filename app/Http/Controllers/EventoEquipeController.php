<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Evento;
use App\Models\EventoEquipe;

class EventoEquipeController extends Controller
{
    public function index(Evento $evento)
    {
        $equipe = EventoEquipe::where('evento_id', $evento->id)->get();
        return view('eventos.equipe.index', compact('evento', 'equipe'));
    }

    public function create(Evento $evento)
    {
        $users = \App\Models\User::all();
        return view('eventos.equipe.create', compact('users', 'evento'));
    }

    public function edit(Evento $evento, $membro_id)
    {
        $membro = EventoEquipe::find($membro_id);
        $users = \App\Models\User::all();
        return view('eventos.equipe.edit', compact('evento', 'membro', 'users'));
    }

    public function store(Request $request, Evento $evento)
    {
        $validated = $request->validate(
            [
                'nome' => 'required',
                'cpf' => 'required',
                'email' => 'required',
                'funcao_evento' => 'required',
                'titulo_palestra' => 'required_if:funcao_evento,"Palestrante"'
            ]
        );

        $input = $request->except('_token');

        $input['evento_id'] = $evento->id;

        /* Trecho comentado para poder adicionar o mesmo membro, para emissão de certificado para palestras diferentes
        $membroEquipeJaCadastrado = EventoEquipe::where('email', $input['email'])->where('evento_id', $evento->id)->first();

        if($membroEquipeJaCadastrado) {
            session()->flash('status', 'Membro de equipe de evento já cadastrado.');
            session()->flash('alert', 'warning');

            return redirect()->to('evento/' . $evento->id . '/equipe');
        }
        */

        $options = [
            'cost' => 10,
            ];

        if($input['funcao_evento'] == "Palestrante"){
            $input['certificado']  = str_replace('$2y$10$', '', password_hash("palestrante-".$input['evento_id'].$input['titulo_palestra'], PASSWORD_BCRYPT, $options));
        }
        else{
            $input['certificado']  = str_replace('$2y$10$', '', password_hash("staff-".$input['evento_id'].$input['cpf'], PASSWORD_BCRYPT, $options));
        }

        $membroEquipe = EventoEquipe::create($input);

        if($membroEquipe) {
            session()->flash('status', 'Membro da equipe do evento cadastrado com sucesso.');
            session()->flash('alert', 'success');

            return redirect()->to('evento/' . $evento->id . '/equipe');
        }
        else {
            session()->flash('status', 'Desculpe! Houve um erro ao cadastrar o membro da equipe do evento.');
            session()->flash('alert', 'danger');

            return redirect()->back();
        }
    }

    public function show(Evento $evento, $id)
    {
        $membroEquipe = EventoEquipe::find($id);

        return view('eventos.equipe.show', compact('evento', 'membroEquipe'));
    }

    public function update(Request $request, Evento $evento, $id)
    {
        $dados = [];

        $validated = $request->validate(
            [
                'nome' => 'required',
                'cpf' => 'required',
                'email' => 'required',
                'funcao_evento' => 'required',
            ]
        );

        $inputs = $request->except('_token', '_method');
        $inputs['evento_id'] = $evento->id;
        // $emailJaCadastrado = EventoEquipe::where('email', $inputs['email'])->first();

        // if($emailJaCadastrado) {
        //     session()->flash('status', 'E-mail já cadastrado.');
        //     session()->flash('alert', 'warning');

        //     return redirect()->back();
        // }

        foreach($inputs as $key => $value) {
            $dados[$key] = $value;
        }

        $membroEquipe = EventoEquipe::where('id', $id)->update($dados);

        if($membroEquipe) {
            session()->flash('status', 'Membro da equipe do evento atualizado com sucesso.');
            session()->flash('alert', 'success');

            return redirect()->to('evento/' . $evento->id . '/equipe');
        }
        else {
            session()->flash('status', 'Desculpe! Houve um erro ao atualizar o membro da equipe do evento.');
            session()->flash('alert', 'danger');

            return redirect()->back();
        }
    }

    public function destroy(Evento $evento, $id)
    {
        $membroEquipe = EventoEquipe::find($id);

        if($membroEquipe->delete()) {
            session()->flash('status', 'Membro da equipe do evento removido com sucesso.');
            session()->flash('alert', 'success');

            return redirect()->back();
        }
        else {
            session()->flash('status', 'Desculpe! Houve um erro ao remover o membro da equipe do evento.');
            session()->flash('alert', 'danger');

            return redirect()->back();
        }
    }
}
