<?php

namespace App\Services\InscricaoEdital;

use Illuminate\Http\Request;

use App\Models\Inscricao;
use App\Models\User;
use App\Models\Edital;

class ChecaPeriodoInscricao
{
    public static function execute($id)
    {
        $edital = Edital::find($id);
        foreach($edital->cronogramas as $cronograma) {
            if($cronograma->dt_input == 'dt_inscricao' && strtotime(date('Y-m-d')) < strtotime($cronograma->data) ) {
                session()->flash('status', 'Desculpe! As inscrições ainda não estão abertas!');
                session()->flash('alert', 'warning');

                return true;
            }

            if($cronograma->dt_input == 'dt_termino_inscricao' && strtotime(date('Y-m-d')) > strtotime($cronograma->data) ) {
                session()->flash('status', 'Desculpe! As inscrições já se encerraram!');
                session()->flash('alert', 'warning');

                return true;
            }
        }
    }
}