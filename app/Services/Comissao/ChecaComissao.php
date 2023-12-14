<?php

namespace App\Services\Comissao;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use App\Models\Inscricao;
use App\Models\User;
use App\Models\Edital;
use App\Models\PublicoAlvo;
use App\Models\ComissaoUser;

class ChecaComissao
{
    public static function execute($local, $local_id, $atribuicao, $user_id)
    {
        $userNaComissao = ComissaoUser::join('comissoes', 'comissoes.id', 'comissoes_users.comissao_id')
                                ->where(function($query) use ($local, $local_id, $atribuicao, $user_id){
                                    $query->where("comissoes.".$local."_id", $local_id);
                                    $query->where("comissoes.atribuicao", $atribuicao);
                                    $query->where('comissoes_users.user_id', $user_id);
                                })
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