<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Inscricao;
use App\Models\Comentario;
use App\Models\User;

class ComentarioController extends Controller
{
    public function store(Inscricao $inscricao, Request $request)
    {
        $validated = $request->validate([
            'comentario' => 'required|max:1000'
        ]);
        //$user = User::where('email', Auth::user()->id)->first();
        $user = User::where('id', 3)->first();

        $comentario = new Comentario();
        $comentario->inscricao_id = $inscricao->id;
        $comentario->user_id = $user->id;
        $comentario->comentario = $request->comentario;
        $comentario->save();

        $comentarios = Comentario::where('inscricao_id', $inscricao->id)->get();

        session()->flash('status', 'Comentario feito!');
        session()->flash('alert', 'success');

        return redirect()->back();
    }

    public function destroy(Comentario $comentario)
    {
        if($comentario->delete()) {
            session()->flash('status', 'Comentario removido!');
            session()->flash('alert', 'success');

            return redirect()->back();
        }
        else {
            session()->flash('status', 'Comentario não removido!');
            session()->flash('alert', 'danger');

            return redirect()->back();
        }
        
    }
}
