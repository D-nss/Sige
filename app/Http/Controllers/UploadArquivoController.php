<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\UploadFile;
use App\Models\Arquivo;

class UploadArquivoController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:edital-administrador|super|admin');
    }

    public function store(Request $request)
    {
        $validated = $request->validate(
            [
            'arquivo-anexo' => 'required|mimes:pdf',
            'nome_arquivo' => 'required|max:190'
            ],
        );

        $upload = new UploadFile();
        $arquivo = $upload->execute($request, 'arquivo-anexo', 'pdf', 3000000);

        $arquivo_uploaded = Arquivo::create([
            'nome_arquivo'  => $request->nome_arquivo,
            'url_arquivo'   => $arquivo,
            'modulo'        => $request->modulo,
            'referencia_id' => $request->referencia_id
        ]);

        if($arquivo_uploaded) {
            session()->flash('status', 'Arquivo Enviado com sucesso!!!');
            session()->flash('alert', 'success');

            return redirect()->back();
        }
        else {
            session()->flash('status', 'Erro ao enviar arquivo');
            session()->flash('alert', 'danger');

            return redirect()->back();
        }
    }
}
