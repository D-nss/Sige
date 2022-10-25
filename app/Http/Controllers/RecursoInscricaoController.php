<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Inscricao;
use App\Models\Recurso;
use App\Models\User;
use App\Models\AvaliadorPorInscricao;
use App\Models\Comentario;

class RecursoInscricaoController extends Controller
{
    public function create(Inscricao $inscricao) 
    {
        $user = User::where('email', Auth::user()->id)->first();

        $avaliadorPorInscricao = AvaliadorPorInscricao::where('inscricao_id', $inscricao->id)
                                                        ->where('user_id', $user->id)
                                                        ->first();

        return view('inscricao.recurso', compact('inscricao', 'user', 'avaliadorPorInscricao'));
    }

    public function store(Request $request, Inscricao $inscricao) 
    {
        $validated = $request->validate([
            'argumentacao' => 'required|max:5000'
        ]);

        $recurso = Recurso::create([
            'inscricao_id' => $inscricao->id,
            'argumentacao' => $request->argumentacao,
            'status' => 'Aberto',
        ]);

        if($recurso) {
            session()->flash('status', 'Recurso cadastrado com sucesso!');
            session()->flash('alert', 'success');

            return redirect()->back();
        }
        else {
            session()->flash('status', 'Desculpe! Houve um erro ao cadastrar recurso.');
            session()->flash('alert', 'danger');

            return redirect()->back();
        }


    }
}
