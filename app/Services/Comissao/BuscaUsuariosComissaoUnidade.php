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
        $usersComissao = User::join('comissoes_users as cmu', 'cmu.user_id', 'users.id')
                                    ->join('comissoes as c', 'c.id', 'cmu.comissao_id')
                                    ->where('c.unidade_id', $unidade->id)
                                    ->get('users.*');
        
        return $usersComissao;
    }
}