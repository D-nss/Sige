<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\EditalParticipanteProjeto;
use App\Models\Inscricao;

class EditalPartipantesProjetoController extends Controller
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
            session()->flash('status', 'Dados enviado com sucesso!');
            session()->flash('alert', 'success');

            return redirect()->back();
        }
        else {
            session()->flash('status', 'Desculpe! Houve erro ao enviar o dados!');
            session()->flash('alert', 'warning');

            return redirect()->back();
        }
    }
}
