<?php

namespace App\Services\Curricularizacao;

use Illuminate\Http\Request;

use App\Models\Unidade;

class PreparaUnidade
{
    public static function execute($unidade)
    {
        $munidensi = explode(' ', $unidade);
        $unidade = '';
        foreach($munidensi as $v) {
            if($v[0] == '"') {
                $string = str_split($v);
                unset($string[0]);
                
                $unidade .= $v[1];
            }

            if($v == 'Reitoria') {
                $unidade = strtoupper(substr($v, 0, 4));
                break;
            }
            
            if(ctype_upper($v[0])) {
                
                $unidade .= $v[0];
            }
        }

        if($unidade == 'FECAU') {
            $unidade = 'FECFAU';
        } 
        
        return Unidade::where('sigla', $unidade)->get(['id']);
    }
}