<?php

namespace App\Services\Comissao;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use App\Models\Inscricao;
use App\Models\User;
use App\Models\Edital;
use App\Models\Comissao;

class BuscaUsuariosComissaoUnidade
{
    public static function execute($unidade)
    {
        $usersComissao = Comissao::join('comissoes_users as cmu', 'cmu.comissao_id', 'comissoes.id')
                                    ->join('users as u', 'u.id', 'cmu.user_id')
                                    ->where('comissoes.unidade_id', $unidade->id)
                                    ->get('u.*');
        
        return $usersComissao;
    }
}