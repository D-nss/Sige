<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

use App\Models\Inscricao;
use App\Models\Recurso;
use App\Models\User;
use App\Models\AvaliadorPorInscricao;
use App\Models\Comentario;
use App\Models\ComissaoUser;

use App\Notifications\RecursoAdicionado;

class RecursoInscricaoController extends Controller
{
    public function create(Inscricao $inscricao) 
    {
        $user = User::where('email', Auth::user()->id)->first();

        // $avaliadorPorInscricao = AvaliadorPorInscricao::where('inscricao_id', $inscricao->id)
        //                                                 ->where('user_id', $user->id)
        //                                                 ->first();

        $userNaComissao = ComissaoUser::join('comissoes', 'comissoes.id', 'comissoes_users.comissao_id')
                                ->where('comissoes.edital_id', $inscricao->edital_id)
                                ->where('comissoes_users.user_id', $user->id)
                                ->first();

        if( $inscricao->user_id != $user->id || is_null($userNaComissao)) {
            session()->flash('status', 'Desculpe! Somente o coordenador pode abrir recurso');
            session()->flash('alert', 'warning');

            return redirect()->back();
        }

        $status = [
            'Aberto' => 'info',
            'Aceito' => 'success',
            'Recusado' => 'danger',
        ];

        return view('inscricao.recurso', compact('inscricao', 'user', 'userNaComissao', 'status'));
    }

    public function store(Request $request, Inscricao $inscricao) 
    {
        $validated = $request->validate([
            'argumentacao' => 'required|max:5000'
        ]);

        $users  = User::join('comissoes_users', 'comissoes_users.user_id', 'users.id')
                    ->join('comissoes', 'comissoes_users.comissao_id', 'comissoes.id')
                    ->where('comissoes.edital_id', $inscricao->edital_id)
                    ->get(['users.email']);
        
        Notification::send($users, new RecursoAdicionado($inscricao));

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

    public function avaliar(Request $request) 
    {
        $user = User::where('email', Auth::user()->id)->first();

        $recurso = Recurso::find($request->recurso_id);
        $recurso->status = $request->status;
        $recurso->user_id = $user->id;

        if( $recurso->save() ) {
            session()->flash('status', 'Recurso avaliado com sucesso!');
            session()->flash('alert', 'success');

            return redirect()->back();
        }
        else {
            session()->flash('status', 'Desculpe! Houve um erro ao avaliar recurso.');
            session()->flash('alert', 'danger');

            return redirect()->back();
        }

    }
}
