<?php

namespace App\Services\InscricaoEdital;

use Illuminate\Http\Request;

use App\Models\Inscricao;
use App\Models\User;
use App\Models\Edital;

class ValidarDadosInscricao
{
    public static function execute(Request $request)
    {
        $inputsParaValidar = $request->except(['estado']);
        $validar = array();

        foreach($inputsParaValidar as $key => $inputs) {
            if($key == 'resumo') {
                $validar[$key] = 'required|max:2500';
            }
            elseif($key == 'palavras_chaves') {
                $validar[$key] = 'max:190';
            }
            elseif($key == 'pdf_projeto') {
                $validar[$key] = 'required|mimes:pdf';
            }
            elseif($key == 'comprovante_parceria') {
                $validar[$key] = 'mimes:pdf';
            }
            elseif(substr($key, 0, 8) == 'questao-'){
                $validar[$key] = 'required|max:10000';
            }
            else {
                $validar[$key] = 'required';
            }
        }

        $mensagens = array();

        foreach($inputsParaValidar as $key => $inputs) {
            if(substr($key, 0, 8) == 'questao-') {
                $mensagens[$key.'.required'] = 'Uma questão complementar não foi preenchida';
                $mensagens[$key.'.max'] = 'Uma questão complementar ultrapassou o máximo permitido de caracteres';
            }
        }

        $validar['areas_tematicas'] = 'required';
        $validar['obj_desenvolvimento_sustentavel'] = 'required';
        $validar['pdf_projeto'] = 'required|mimes:pdf';
        $validar['link_lattes'] = 'max:190';
        $validar['link_projeto'] = 'max:190';
        $validar['cidade'] = 'required';

        $validated = $request->validate($validar,$mensagens);
    }
}