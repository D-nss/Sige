<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

use App\Models\Evento;
use App\Models\EventoInscrito;
use App\Models\ModeloCertificado;
use App\Models\User;
use App\Models\UploadFile;
use Illuminate\Support\Facades\App;

use App\Notifications\EventoCancelamentoNotificar;
use App\Notifications\EventoAberturaVagaInscritoNotificar;

class EventoController extends Controller
{
    public function index()
    {
        $grupo = '';

        if(App::environment('local')){
            $user = User::where('id', 2)->first();
        } else {
            $user = User::where('email', Auth::user()->id)->first();
        }

        foreach($user->getRoleNames() as $role) {
            if(substr($role, 0, 3) === 'gr_') {
                $grupo = $role;
            }
        }

        $diasSemana = [
            'Mon' => 'Seg',
            'Tue' => 'Ter',
            'Wed' => 'Qua',
            'Thu' => 'Qui',
            'Fri' => 'Sex',
            'Sat' => 'Sáb',
            'Sun' => 'Dom',
        ];

        $meses = [
            '01' => 'Jan',
            '02' => 'Fev',
            '03' => 'Mar',
            '04' => 'Abr',
            '05' => 'Mai',
            '06' => 'Jun',
            '07' => 'Jul',
            '08' => 'Ago',
            '09' => 'Set',
            '10' => 'Out',
            '11' => 'Nov',
            '12' => 'Dez'
        ];

        $eventosAbertos = Evento::where('grupo_usuario', $grupo)->where('status', 'Aberto')->get();
        $eventosEncerrados = Evento::where('grupo_usuario', $grupo)->where('status', 'Encerrado')->get();
        $eventosCancelados = Evento::where('grupo_usuario', $grupo)->where('status', 'Cancelado')->get();

        return view('eventos.index', compact('eventosAbertos', 'eventosEncerrados', 'eventosCancelados', 'meses', 'diasSemana'));
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
            "modelo" => isset($request->enviar_modelo) ? 'required|mimes:png' : '',
        ];

        $request->validate($toValidate);

        if( isset($request->modelo) || !$request->modelo == '') {
            $upload = new UploadFile();
            $certificado = new ModeloCertificado();
            $certificado->titulo = 'Certificado-'.uniqid();
            $certificado->arquivo = $upload->execute($request, 'modelo', 'png', 3000000);
            $certificado->save();
        }

        $dadosEvento = $request->except(['_token', 'inscricao']);

        if(App::environment('local')){
            $user = User::where('id', 2)->first();
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
        $dados = [
            'gratuito' => NULL,
            'online' => NULL,
            'hibrido' => NULL,
            'ck_documento' => NULL,
            'ck_sexo' => NULL,
            'ck_identidade_genero' => NULL,
            'ck_nascimento' => NULL,
            'ck_instituicao' => NULL,
            'ck_vinculo' => NULL,
            'ck_area' => NULL,
            'ck_funcao' => NULL,
            'ck_pais' => NULL,
            'ck_cidade_estado' => NULL,
            'ck_racial' => NULL,
            'ck_deficiencia' => NULL,
            'ck_arquivo' => NULL,
        ];

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
            "modelo" => isset($request->enviar_modelo) ? 'mimes:png' : '',
        ];
       
        $request->validate($toValidate);

        if( isset($request->modelo) || !$request->modelo == '') {
            $upload = new UploadFile();
            $certificado = ModeloCertificado::find($evento->modelo_certificado_id);
            if($certificado->padrao == 1) {
                unset($certificado);
                $certificado = new ModeloCertificado();
                $certificado->titulo = 'Certificado-'.uniqid();
                $certificado->arquivo = $upload->execute($request, 'modelo', 'png', 3000000);
                $certificado->save();
                $dados['modelo_certificado_id'] = $certificado->id;
            }
            else {
                $certificadoAntigo = $certificado->arquivo;
                Storage::delete($certificadoAntigo);
                $certificado->arquivo = $upload->execute($request, 'modelo', 'png', 3000000);
                $certificado->save();
            }
        }

        $vagasPreenchidas = $evento->inscritos->where('lista_espera', 0)->count();
        $inputs = $request->except('_token', '_method');
        foreach($inputs as $key => $value) {
            if($key == 'vagas' && ( $value < $vagasPreenchidas ) ) {
                session()->flash('status', 'O número de vagas não poder ser menor que o número de inscritos já cadstrados.');
                session()->flash('alert', 'danger');

                return redirect()->back();
            }

            $dados[$key] = $value;
        }
        
        $vagasDif = $request->vagas - $evento->vagas;

        if($evento->update($dados)) {
            $inscritosNaLista = EventoInscrito::where('lista_espera', 1)->limit($vagasDif)->get();
            $inscritosNaListaUpdated = EventoInscrito::where('lista_espera', 1)->limit($vagasDif)->update(['lista_espera' => 1]);
            if($inscritosNaListaUpdated > 0){
                Notification::send($inscritosNaLista, new EventoAberturaVagaInscritoNotificar($evento));
            }

            session()->flash('status', 'Evento Atualizado com sucesso.');
            session()->flash('alert', 'success');
            
            return redirect()->to("eventos/$evento->id");
        }
        else {
            session()->flash('status', 'Desculpe! Houve um erro ao atualizar o evento.');
            session()->flash('alert', 'danger');

            return redirect()->back();
        }
    }

    public function destroy(Request $request, Evento $evento)
    {
        $validated = $request->validate(['motivo' => 'required']);
        $evento->status = 'Cancelado';

        if($evento->save()) {
            Notification::send($evento->inscritos, new EventoCancelamentoNotificar($evento, $request->motivo));
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
