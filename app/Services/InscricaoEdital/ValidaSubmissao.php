<?php

namespace App\Services\InscricaoEdital;

use App\Models\Inscricao;
use App\Models\User;

class ValidaSubmissao
{
    public static function execute(Inscricao $inscricao, User $user)
    {
        if( $inscricao->user_id != $user->id ) {
            session()->flash('status', 'Desculpe! Somente o coordenador pode editar');
            session()->flash('alert', 'danger');

            return true;
        }

        if($inscricao->status === 'Submetido') {
            session()->flash('status', 'Inscrição já submetida.');
            session()->flash('alert', 'success');

            return true;
        }

        if( empty($inscricao->orcamento->toArray()) ) {
            session()->flash('status', 'Desculpe! Para submeter é necessário o preenchimento do orçamento.');
            session()->flash('alert', 'danger');

            return true;
        }
    }
}