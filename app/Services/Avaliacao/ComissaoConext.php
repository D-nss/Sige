<?php

namespace App\Services\Avaliacao;

use Illuminate\Http\Request;
use App\Services\AvaliacaoInterface;

use App\Models\AcaoExtensao;
use App\Models\Cronograma;
use App\Models\ComissaoUser;
use App\Models\Inscricao;
use App\Models\EventoInscrito;
use App\Models\User;

class ComissaoConext implements AvaliacaoInterface
{
    public function getAvaliacao(Request $request, Inscricao $inscricao, User $user) {}
    public function execute(Request $request, Inscricao $inscricao, User $user) {}
    public function update(Request $request, Inscricao $inscricao, User $user) {}
    public function executeAvaliacaoInscritoEvento(Request $request, EventoInscrito $inscrito, User $user) {}

    public function executeAvaliacaoConext(Request $request, AcaoExtensao $acao_extensao, User $user)
    {
        if($acao_extensao->user_id == $user->id) {
            session()->flash('status', 'Desculpe! Não é permitido a análise da própria inscrição');
            session()->flash('alert', 'danger');

            return ['redirect' => "/acoes-extensao/$acao_extensao->id", 'status' => false];
        }

        $acao_extensao->avaliacao_conext_user_id = $user->id;
        $acao_extensao->status_avaliacao_conext = 'Aprovado';

        if( $acao_extensao->update() )
        {
            session()->flash('status', 'Avaliação Conext cadastrada com sucesso!');
            session()->flash('alert', 'success');

            return ['redirect' => "/acoes-extensao/$acao_extensao->id", 'status' => true];
        }
        else
        {
            session()->flash('status', 'Desculpe! Houve um problema ao enviar avaliação Conext');
            session()->flash('alert', 'danger');

            return ['redirect' => "/acoes-extensao/$acao_extensao->id", 'status' => false];
        }
    }
}