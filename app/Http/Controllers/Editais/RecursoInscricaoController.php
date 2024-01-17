<?php

namespace App\Http\Controllers\Editais;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Log;

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
        $user = User::where('uid', Auth::user()->id)->first();

        // $avaliadorPorInscricao = AvaliadorPorInscricao::where('inscricao_id', $inscricao->id)
        //                                                 ->where('user_id', $user->id)
        //                                                 ->first();

        $userNaComissao = ComissaoUser::join('comissoes', 'comissoes.id', 'comissoes_users.comissao_id')
                                ->where('comissoes.edital_id', $inscricao->edital_id)
                                ->where('comissoes_users.user_id', $user->id)
                                ->first();

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

        $recurso = Recurso::create([
            'inscricao_id' => $inscricao->id,
            'argumentacao' => $request->argumentacao,
            'status' => 'Aberto',
        ]);

        if($recurso) {
            Log::channel('inscricao')->info('Usuario Nome: ' . $inscricao->user->name . ' - Usuario ID: ' . $inscricao->user->id . ' - Info: Recurso adicionado a inscricao ID: '. $inscricao->id .' - Endereço IP: ' . $request->ip());
            Notification::send($inscricao->analista, new RecursoAdicionado($inscricao));
            session()->flash('status', 'Recurso cadastrado com sucesso!');
            session()->flash('alert', 'success');

            return redirect()->back();
        }
        else {
            Log::channel('inscricao')->error('Usuario Nome: ' . $inscricao->user->name . ' - Usuario ID: ' . $inscricao->user->id . ' - Info: Recurso não adicionado a inscricao ID: '. $inscricao->id .' - Endereço IP: ' . $request->ip());
            session()->flash('status', 'Desculpe! Houve um erro ao cadastrar recurso.');
            session()->flash('alert', 'danger');

            return redirect()->back();
        }

    }

    public function avaliar(Request $request)
    {
        $user = User::where('uid', Auth::user()->id)->first();

        $recurso = Recurso::find($request->recurso_id);
        $recurso->status = $request->status;
        $recurso->user_id = $user->id;

        if( $recurso->save() ) {
            Log::channel('inscricao')->info('Usuario Nome: ' . $user->name . ' - Usuario ID: ' . $user->id . ' - Info: Recurso avaliado para inscricao ID: '. $inscricao->id .' - Endereço IP: ' . $request->ip());
            session()->flash('status', 'Recurso avaliado com sucesso!');
            session()->flash('alert', 'success');

            return redirect()->back();
        }
        else {
            Log::channel('inscricao')->error('Usuario Nome: ' . $user->name . ' - Usuario ID: ' . $user->id . ' - Info: Recurso não avaliado para inscricao ID: '. $inscricao->id .' - Endereço IP: ' . $request->ip());
            session()->flash('status', 'Desculpe! Houve um erro ao avaliar recurso.');
            session()->flash('alert', 'danger');

            return redirect()->back();
        }

    }
}
