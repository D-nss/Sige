<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class CertificadoController extends Controller
{
    public function make()
    {
        $data = [
            'font' => public_path('storage') . '/SourceSansPro-Regular.ttf',
            'bg'   => url('storage/template_certificados/96d9c9ce_1.png') ,
        ];

        $pdf = Pdf::loadView('certificado.pdf', compact('data'));
        $pdf->setPaper('a4', 'landscape');
        return $pdf->download();

        //return view('certificado.pdf', compact('data'));
    }
}
