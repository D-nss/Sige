<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

use App\Models\Evento;
use App\Models\ModeloCertificado;
use App\Models\User;
use App\Models\UploadFile;
use Illuminate\Support\Facades\App;

class EventoController extends Controller
{
    public function index()
    {
        $grupo = '';

        if(App::environment('local')){
            $user = User::where('id', 1)->first();
        } else {
            $user = User::where('email', Auth::user()->id)->first();
        }

        foreach($user->getRoleNames() as $role) {
            if(substr($role, 0, 3) === 'gr_') {
                $grupo = $role;
            }
        }

        $eventosAbertos = Evento::where('grupo_usuario', $grupo)->where('status', 'Aberto')->get();
        $eventosEncerrados = Evento::where('grupo_usuario', $grupo)->where('status', 'Encerrado')->get();
        $eventosCancelados = Evento::where('grupo_usuario', $grupo)->where('status', 'Cancelado')->get();

        return view('eventos.index', compact('eventosAbertos', 'eventosEncerrados', 'eventosCancelados'));
    }

    public function create()
    {
        return view('eventos.create');
    }

    public function store(Request $request)
    {
        $dadosEvento = $request->except(['_token']);
        $toValidate = [
            "titulo" => 'required',
            "local" => 'required',
            "data_inicio" => 'required',
            "data_fim" => 'required',
            "detalhes" => 'required',
            "inscricao_inicio" => isset($request->inscricao) ? 'required' : '',
            "inscricao_fim" => isset($request->inscricao) ? 'required' : '',
            "prazo_envio_arquivo" => isset($request->ck_arquivo) ? 'required' : '',
            "input_personalizado" => isset($request->input_personalizado) ? 'max:255' : '',
            "modelo" => isset($request->enviar_modelo) ? 'required|mimes:jpg' : '',
        ];

        $request->validate($toValidate);

        if( isset($request->modelo) || !$request->modelo == '') {
            $upload = new UploadFile();
            $certificado = new ModeloCertificado();
            $certificado->titulo = 'Certificado-'.uniqid();
            $certificado->arquivo = $upload->execute($request, 'modelo', 'jpg', 3000000);
            $certificado->save();
        }

        $dadosEvento = $request->except(['_token', 'inscricao']);

        if(App::environment('local')){
            $user = User::where('id', 1)->first();
        } else {
            $user = User::where('email', Auth::user()->id)->first();
        }

        //$certificado_id = 1;
        foreach($user->getRoleNames() as $role) {
            if(substr($role, 0, 3) === 'gr_') {
                $grupo = $role;
            }
        }
        $dadosEvento['user_id'] = $user->id;
        if(!isset($certificado->id)) {
            $certificadoPadrao = ModeloCertificado::select('id')->where('padrao', 1)->first();
            $dadosEvento['modelo_certificado_id'] = $certificadoPadrao->id;
        }
        else {
            $dadosEvento['modelo_certificado_id'] = $certificado->id;
        }

        if(isset($grupo)) {
            $dadosEvento['grupo_usuario'] = $grupo;
        }
        else {
            session()->flash('status', 'Desculpe! Você não está em um grupo que permita criar um novo evento. Solicite a inclusão ao suporte.');
            session()->flash('alert', 'warning');

            return redirect()->to('/eventos');
        }

        $dadosEvento['status'] = 'Aberto';

        $evento = Evento::create($dadosEvento);

        if($evento) {
            session()->flash('status', 'Evento cadastrado com sucesso.');
            session()->flash('alert', 'success');

            return redirect()->to('/eventos');
        }
        else {
            session()->flash('status', 'Desculpe! Houve um erro ao cadastrar o evento.');
            session()->flash('alert', 'danger');

            return redirect()->back();
        }
    }

    public function show(Evento $evento)
    {
        return view('eventos.show', compact('evento'));
    }

    public function edit(Evento $evento)
    {
        return view('eventos.edit', compact('evento'));
    }

    public function update(Request $request, Evento $evento)
    {
        $toValidate = [
            "titulo" => 'required',
            "local" => 'required',
            "data_inicio" => 'required',
            "data_fim" => 'required',
            "detalhes" => 'required',
            "inscricao_inicio" => isset($request->inscricao) ? 'required' : '',
            "inscricao_fim" => isset($request->inscricao) ? 'required' : '',
            "prazo_envio_arquivo" => isset($request->ck_arquivo) ? 'required' : '',
            "input_personalizado" => isset($request->input_personalizado) ? 'max:255' : '',
            "modelo" => isset($request->enviar_modelo) ? 'required|mimes:jpg' : '',
        ];

        $request->validate($toValidate);

        if( isset($request->modelo) || !$request->modelo == '') {
            $upload = new UploadFile();
            $certificado = ModeloCertificado::find($evento->certificado_id);
            echo json_encode($certificado);
            // $certificadoAntigo = $certificado->arquivo;
            // Storage::delete($certificadoAntigo);
            // $certificado->arquivo = $upload->execute($request, 'modelo', 'jpg', 3000000);
            // $certificado->save();
        }

        // $dados = [];
        // $inputs = $request->except('_token', '_method');
        // foreach($inputs as $key => $value) {
        //     $dados[$key] = $value;
        // }

        // if($evento->update($dados)) {
        //     session()->flash('status', 'Evento Atualizado com sucesso.');
        //     session()->flash('alert', 'success');

        //     return redirect()->to("eventos/$evento->id");
        // }
        // else {
        //     session()->flash('status', 'Desculpe! Houve um erro ao atualizar o evento.');
        //     session()->flash('alert', 'danger');

        //     return redirect()->back();
        // }
    }

    public function destroy(Evento $evento)
    {
        $evento->status = 'Cancelado';

        if($evento->save()) {
            session()->flash('status', 'Evento Cancelado com sucesso.');
            session()->flash('alert', 'success');

            return redirect()->to('/eventos');
        }
        else {
            session()->flash('status', 'Desculpe! Houve um erro ao Cancelar o evento.');
            session()->flash('alert', 'danger');

            return redirect()->back();
        }
    }

}
