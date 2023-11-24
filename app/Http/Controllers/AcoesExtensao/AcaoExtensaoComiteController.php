<?php

namespace App\Http\Controllers\AcoesExtensao;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

use App\Models\AcaoExtensao;
use App\Models\User;

class AcaoExtensaoComiteController extends Controller
{
    public function index() {
        $acoes_extensao = AcaoExtensao::where('status', 'Aprovado')->where('modalidade', 1)->get();
        return view('acoes-extensao.comite.index', compact('acoes_extensao'));
    }

    public function create(AcaoExtensao $acao_extensao){
        $users = User::join('unidades', 'users.unidade_id', 'unidades.id')
                        ->orderBy('name', 'asc')
                        ->get(['users.*', 'unidades.sigla']);
        return view('acoes-extensao.comite.create', compact('acao_extensao', 'users'));
    }

    public function store(Request $request, AcaoExtensao $acao_extensao)
    {
        $acao_extensao->comite_user_id = $request->user_id;
        $user_comite = User::find($request->user_id);

        if($acao_extensao->save()) {
            Notification::send($user_comite, new \App\Notifications\AcaoExtensaoNotificacaoComite($acao_extensao));
            session()->flash('status', 'Membro do comitê adicionado a inscrição com sucesso');
            session()->flash('alert', 'success');

            return redirect()->back();
        }
        else {
            session()->flash('status', 'Desculpe! Houve um erro ao adicionar membro a inscrição.');
            session()->flash('alert', 'danger');

            return redirect()->back();
        }
    }

    public function parecer(Request $request, AcaoExtensao $acao_extensao)
    {
        $acao_extensao->parecer_comite = $request->parecer_comite;
        $acao_extensao->aceite_comite = $request->aceite_comite;

        if($acao_extensao->save()) {
            $at_conext = User::role('at_conext')->get();
            Notification::send($at_conext, new \App\Notifications\AcaoExtensaoNotificaAtConextParecerComite($acao_extensao));
            session()->flash('status', 'Parecer  adicionado a inscrição com sucesso');
            session()->flash('alert', 'success');

            return redirect()->back();
        }
        else {
            session()->flash('status', 'Desculpe! Houve um erro ao adicionar parecer a inscrição.');
            session()->flash('alert', 'danger');

            return redirect()->back();
        }
    }
}
