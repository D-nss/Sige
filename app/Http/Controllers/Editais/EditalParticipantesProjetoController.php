<?php

namespace App\Http\Controllers\Editais;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

use App\Models\EditalParticipanteProjeto;
use App\Models\Inscricao;

class EditalParticipantesProjetoController extends Controller
{
    public function store(Request $request, Inscricao $inscricao)
    {   
        $validaded = $request->validate([
            'nome' => 'required|max:190',
            'categoria' => 'required|max:190',
            'carga_semanal' => 'required',
            'carga_total' => 'required',
        ]);

        $dados = $request->all();
        $dados['inscricao_id'] = $inscricao->id;

        $participante = EditalParticipanteProjeto::create(
            $dados
        );

        if($participante) {
            Log::channel('inscricao')->info('Usuario Nome: ' . Auth::user()->name . ' - Usuario ID: ' . Auth::user()->id . ' - Info: participante adicionado em relatorio final da inscricao ID: '. $inscricao->id .' - Endereço IP: ' . $request->ip());
            session()->flash('status', 'Dados enviado com sucesso!');
            session()->flash('alert', 'success');

            return redirect()->back();
        }
        else {
            Log::channel('inscricao')->info('Usuario Nome: ' . Auth::user()->name . ' - Usuario ID: ' . Auth::user()->id . ' - Info: erro ao adicionar participante em relatorio final da inscricao ID: '. $inscricao->id .' - Endereço IP: ' . $request->ip());
            session()->flash('status', 'Desculpe! Houve erro ao enviar o dados!');
            session()->flash('alert', 'warning');

            return redirect()->back();
        }
    }
}
