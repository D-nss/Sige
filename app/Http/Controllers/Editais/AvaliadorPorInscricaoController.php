<?php

namespace App\Http\Controllers\Editais;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use App\Models\AvaliadorPorInscricao;
use App\Models\User;
use App\Models\Inscricao;
use App\Models\RespostasAvaliacoes;

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

        $avaliadorSeExiste = AvaliadorPorInscricao::where('user_id', $request->avaliador_id,)
                                                  ->where('inscricao_id', $request->inscricao_id)
                                                  ->first();

        if($avaliadorSeExiste) {
            session()->flash('status', 'Avaliador já cadastrado.');
            session()->flash('alert', 'warning');

            return redirect()->back();
        }

        $avaliadorPorInscricao = AvaliadorPorInscricao::create([
            'user_id' => $request->avaliador_id,
            'inscricao_id' => $request->inscricao_id
        ]);

        if($avaliadorPorInscricao) {
            Log::channel('editais')->info('Usuario Nome: ' . Auth::user()->name . ' - Usuario ID: ' . Auth::user()->id . ' - Info: Avaliador com user_id ' . $request->avaliador_id  .' cadastrado na inscricao ' . $request->inscricao_id . ' - Endereço IP: ' . $request->ip());
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
        $respostasAvaliacoes = RespostasAvaliacoes::where('user_id', $request->user_id)
                                                    ->where('inscricao_id', $request->inscricao_id)
                                                    ->count();
                                                
        if($respostasAvaliacoes > 0) {
            session()->flash('status', 'Avaliador não pode ser removido, pois já possui avaliação para esta inscrição.');
            session()->flash('alert', 'warning');

            return redirect()->back();
        }                       

        $avaliadorPorInscricao = AvaliadorPorInscricao::where('user_id', $request->user_id)
                                        ->where('inscricao_id', $request->inscricao_id)
                                        ->delete();

        if($avaliadorPorInscricao > 0) {
            Log::channel('editais')->info('Usuario Nome: ' . Auth::user()->name . ' - Usuario ID: ' . Auth::user()->id . ' - Info: Avaliador com user_id ' . $request->avaliador_id  .' REMOVIDO da inscricao ' . $request->inscricao_id . ' - Endereço IP: ' . $request->ip());
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

    public function notificar(Inscricao $inscricao)
    {
        foreach($inscricao->avaliadores as $avaliador) {
            $avaliador->notify(new \App\Notifications\PareceristasNotificar($inscricao));
        }
        
        session()->flash('status', 'Notificações enviadas com sucesso');
        session()->flash('alert', 'success');

        return redirect()->back();
    }
}
