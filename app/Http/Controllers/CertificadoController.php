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

        if($participante->certificado == NULL){
            session()->flash('status', 'O inscrito/participante não possui certificado para este evento');
            session()->flash('alert', 'danger');
            return back();
        }

        //diretório de armazenamento + caminho do certificado do evento enviado
        $bg = url('storage/' . $participante->evento->certificado->arquivo);
        //pegando o conteudo da imagem
        $data = file_get_contents($bg);
        $type = 'png';
        //convertendo para base64
        $bg_base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

        //Não tá exibindo a imagem de background que esta salvo no evento
        $pdf = Pdf::loadView('certificado.pdf', compact('participante', 'meses', 'bg_base64', 'tipo'));
        $pdf->setPaper('a4', 'landscape');
        return $pdf->stream();
        //return view('certificado.pdf', compact('participante', 'meses', 'bg'));
    }

    function index(){
        return view('certificado.index');
    }

    function validarCertificado(Request $request) {
        $this->validate($request, [
            'codigo' => ['required']
        ]);
            $encontrado = EventoInscrito::where('certificado', $request->codigo)->first(); // verifique se o codigo existe no banco de dados

            if ($encontrado) {
                return view('certificado.index', compact('encontrado'));
            } else {
                session()->flash('status', 'Desculpe! Certificado não encontrado.');
                session()->flash('alert', 'danger');

                return view('certificado.index');
            }

        return $this->validar($request->codigo);
    }
}
