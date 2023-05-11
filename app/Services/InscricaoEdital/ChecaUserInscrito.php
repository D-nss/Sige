<?php

namespace App\Services\InscricaoEdital;

use Illuminate\Http\Request;

use App\Models\Inscricao;
use App\Models\User;
use App\Models\Edital;

class ChecaUserInscrito
{
    public static function execute($id, $user)
    {
        $checaInscricaoExistente = Inscricao::where('edital_id', $id)->where('user_id', $user->id)->first();
        if(!!$checaInscricaoExistente){
            session()->flash('status', 'Desculpe! Você possui uma inscrição em aberto!');
            session()->flash('alert', 'warning');

            return true;
        }
    }
}