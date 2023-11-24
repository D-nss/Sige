<?php

namespace App\Services\Comissao;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use App\Models\Inscricao;
use App\Models\User;
use App\Models\Edital;
use App\Models\PublicoAlvo;

class ChecaComissao
{
    public static function execute($local, $unidade_id, $user_id)
    {
        $userNaComissao = ComissaoUser::join('comissoes', 'comissoes.id', 'comissoes_users.comissao_id')
                                ->where("comissoes.".$local."_id", $unidade_id)
                                ->where('comissoes_users.user_id', $user_id)
                                ->first();
        
        if(!$userNaComissao){
            session()->flash('status', 'Desculpe! Você não faz parte da comissão necessária para acesso!');
            session()->flash('alert', 'warning');

            return false;
        }else {
            return true;
        }
    }
}