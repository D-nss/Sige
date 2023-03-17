<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

use App\Models\EventoEquipe;
use App\Models\Evento;
use App\Models\EventoInscrito;

class CertificadoController extends Controller
{
    public function make(Request $request, Evento $evento, $id)
    {
        //identifica quem solicitou se é um inscrito ou um membro da equipe
        $tipo = explode('/', $request->url())[5];

        if($tipo == 'equipe') {
            $participante = EventoEquipe::find($id);
        }

        if($tipo == 'inscrito') {
            $participante = EventoInscrito::find($id);
        }
        //
        $meses = [
            '01' => 'Janeiro', 
            '02' => 'Fevereiro', 
            '03' => 'Março', 
            '04' => 'Abril', 
            '05' => 'Maio', 
            '06' => 'Junho', 
            '07' => 'Julho', 
            '08' => 'Agosto', 
            '09' => 'Setembro', 
            '10' => 'Outubro', 
            '11' => 'Novembro', 
            '12' => 'Dezembro'
        ];

        $bg = $participante->evento->certificado->arquivo;
        //Não tá exibindo a imagem de background que esta salvo no evento
        $pdf = Pdf::loadView('certificado.pdf', compact('participante', 'meses', 'bg'));
        $pdf->setPaper('a4', 'landscape');
        return $pdf->stream();
        //return view('certificado.pdf', compact('participante', 'meses', 'bg'));
    }
}
