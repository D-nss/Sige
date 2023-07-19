<?php

namespace App\Services\InscricaoEdital;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use App\Models\Inscricao;
use App\Models\User;
use App\Models\Edital;
use App\Models\PublicoAlvo;

class ChecaPublicoAlvo
{
    public static function execute($id)
    {
        $checaUserPublicoAlvo = PublicoAlvo::join('tipos_publico', 'tipos_publico.id', 'publicos_alvo.tipo_publico_id')
        ->where('publicos_alvo.edital_id', $id)
        ->where('tipos_publico.descricao', Auth::user()->employeetype)
        ->get(['publicos_alvo.*']);

        Log::info('Usuario: ', 
            [
                'email' => Auth::user()->id,
                'user' => Auth::user()->name,
                'employeetype' => Auth::user()->employeetype
            ]
        );
        
        if($checaUserPublicoAlvo->count() < 1){
            session()->flash('status', 'Desculpe! Você não faz parte do publico alvo!');
            session()->flash('alert', 'warning');

            return true;
        }
    }
}