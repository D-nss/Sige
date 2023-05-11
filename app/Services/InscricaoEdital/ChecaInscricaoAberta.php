<?php

namespace App\Services\InscricaoEdital;

use Illuminate\Http\Request;

use App\Models\Inscricao;
use App\Models\User;
use App\Models\Edital;

class ChecaInscricaoAberta
{
    public static function execute($id, $user)
    {
        $checaInscricaoEmAberto = Inscricao::where('user_id', $user->id)->where('status', '<>', 'Concluido')->first();
        if(!!$checaInscricaoEmAberto){
            session()->flash('status', 'Desculpe! Você possui inscrição em aberto!');
            session()->flash('alert', 'warning');

            return true;
        }
    }
}