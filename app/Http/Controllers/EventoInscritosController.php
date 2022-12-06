<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Mail\InscritoMail;

use App\Models\Evento;
use App\Models\EventoInscrito;
use App\Models\UploadFile;

class EventoInscritosController extends Controller
{
    public function index(Evento $evento)
    {
        $confirmados = EventoInscrito::where('confirmacao', 1)->where('evento_id', $evento->id)->get();
        $listaEspera = EventoInscrito::where('lista_espera', 1)->where('evento_id', $evento->id)->get();
        $naoConfirmados = EventoInscrito::where('confirmacao', 0)->where('evento_id', $evento->id)->get();
        $cancelados = EventoInscrito::where('confirmacao', 2)->where('evento_id', $evento->id)->get();

        return view('eventos.inscritos.index', compact('evento', 'confirmados', 'listaEspera', 'naoConfirmados', 'cancelados'));
    }

    public function create(Evento $evento)
    {
        if(
            !is_null($evento->inscricao_inicio) 
            && 
            strtotime(date('Y-m-d')) >= strtotime($evento->inscricao_inicio) 
            && 
            strtotime(date('Y-m-d')) <= strtotime($evento->inscricao_fim)
        ) {
            return view('eventos.inscritos.create', compact('evento'));
        }
        else {
            session()->flash('status', 'Desculpe, ainda não está no prazo de inscrição.');
            session()->flash('alert', 'warning');
            return redirect()->back();
        }
        
    }

    public function store(Request $request, Evento $evento)
    {
        $inputs = $request->except('_token');
        $inputs['evento_id'] = $evento->id;
        
        if( isset($request->arquivo) || !$request->arquivo == '') {
            $upload = new UploadFile();
            $inputs['arquivo'] = $upload->execute($request, 'arquivo', 'pdf', 3000000);
        }

        $inscrito = EventoInscrito::create($inputs);

        if($inscrito) {
            $inscrito->notify( new \App\Notifications\EventoInscritoNotificar([
                'titulo_evento' => $evento->titulo,
                'nome' => $inscrito->nome,
                'id' => $inscrito->id
            ]));

            session()->flash('status', 'Inscrição realizada com sucesso.');
            session()->flash('alert', 'success');
            //trocar o redirecionamento para a pagina de listagem de eventos para usuarios não autenticados
            return redirect()->back();
        }
        else {
            session()->flash('status', 'Desculpe! Houve um erro ao realizar inscrição.');
            session()->flash('alert', 'danger');

            return redirect()->back();
        }
    }

    public function confirmar($codigo, $id)
    {
        $data = explode('/', $codigo);

        $inscrito = EventoInscrito::find($data[1]);
        if($inscrito && $data[0] == 'sim')
        {
            $inscrito->confirmacao = 1;
            if($inscrito->update()) {
                return view('eventos.inscritos.confirmacao', compact('inscrito'));
            }
            else {
                session()->flash('status', 'Desculpe! Houve um erro ao realizar a confirmação inscrição.');
                session()->flash('alert', 'danger');

                return redirect()->back();
            }
        }
        else {
            session()->flash('status', 'Desculpe! Não foi possível confirmação inscrição.');
            session()->flash('alert', 'danger');

            return redirect()->back();
        }
    }

    public function cancelar($codigo)
    {
        $data = explode('/', $codigo);

        $inscrito = EventoInscrito::find($data[1]);
        if($inscrito && $data[0] == 'nao')
        {
            $inscrito->confirmacao = 2;
            if($inscrito->update()) {
                return view('eventos.inscritos.confirmacao', compact('inscrito'));
            }
            else {
                session()->flash('status', 'Desculpe! Houve um erro ao realizar a confirmação inscrição.');
                session()->flash('alert', 'danger');

                return redirect()->back();
            }
        }
        else {
            session()->flash('status', 'Desculpe! Não foi possível confirmação inscrição.');
            session()->flash('alert', 'danger');

            return redirect()->back();
        }
    }
}
