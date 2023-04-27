<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\UploadFile;
use App\Models\Arquivo;

class UploadArquivoController extends Controller
{
    public function __construct()
    {
        //$this->middleware('role:edital-administrador|super|admin');
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

    public function destroy(Arquivo $arquivo)
    {
        $arquivoExists = Storage::disk('public')->exists($arquivo->url_arquivo);
        if($arquivoExists) {
            $arquivoDeletadoStorage = Storage::disk('public')->delete($arquivo->url_arquivo);
            $arquivoDeletadoDb = $arquivo->delete();
        }
        else {
            session()->flash('status', 'O arquivo não existe.');
            session()->flash('alert', 'danger');

            return redirect()->back();
        }
        
        if($arquivoDeletadoStorage && $arquivoDeletadoDb) {
            session()->flash('status', 'Arquivo deletado com sucesso!!!');
            session()->flash('alert', 'success');

            return redirect()->back();
        }
        else {
            session()->flash('status', 'Erro ao deletar arquivo');
            session()->flash('alert', 'danger');

            return redirect()->back();
        }
    }
}
