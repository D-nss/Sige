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
    private $diasSemana = [
        'Mon' => 'Segunda-feira',
        'Tue' => 'Terça-feira',
        'Wed' => 'Quarta-feira',
        'Thu' => 'Quinta-feira',
        'Fri' => 'Sexta-feira',
        'Sat' => 'Sábado',
        'Sun' => 'Domingo',
    ];

    private $meses = [
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

    public function index()
    {
        $grupo = '';

        if(App::environment('local')){
            $user = User::where('id', 2)->first();
        } else {
            $user = User::where('uid', Auth::user()->id)->first();
        }

        foreach($user->getRoleNames() as $role) {
            if(substr($role, 0, 3) === 'gr_') {
                $grupo = $role;
            }
        }

        $eventosPendentes = Evento::where('grupo_usuario', $grupo)->where('status', 'Aberto')->where('data_fim', '<', now())->get();
        $eventosAbertos = Evento::where('grupo_usuario', $grupo)->where('status', 'Aberto')->where('data_fim', '>', now())->get();
        $eventosEncerrados = Evento::where('grupo_usuario', $grupo)->where('status', 'Encerrado')->get();
        $eventosCancelados = Evento::where('grupo_usuario', $grupo)->where('status', 'Cancelado')->get();

        return view(
            'eventos.index',
            [
                'eventosPendentes' => $eventosPendentes,
                'eventosAbertos' => $eventosAbertos,
                'eventosEncerrados' => $eventosEncerrados,
                'eventosCancelados' => $eventosCancelados,
                'meses' => $this->meses,
                'diasSemana' => $this->diasSemana
            ]
        );
    }

    public function eventosPorComissao()
    {
        $grupo = '';

        if(App::environment('local')){
            $user = User::where('id', 2)->first();
        } else {
            $user = User::where('uid', Auth::user()->id)->first();
        }

        $eventosAbertos = Evento::join('comissoes', 'comissoes.evento_id', 'eventos.id')
                                ->join('comissoes_users', 'comissoes_users.comissao_id', 'comissoes.id')
                                ->where('comissoes_users.user_id', $user->id)
                                ->where('status', 'Aberto')
                                ->get(['eventos.*']);

        return view(
            'eventos.por_comissao',
            [
                'eventosAbertos' => $eventosAbertos,
                'meses' => $this->meses,
                'diasSemana' => $this->diasSemana
            ]
        );
    }

    public function create()
    {
        if(App::environment('local')){
            $user = User::where('id', 2)->first();
        } else {
            $user = User::where('uid', Auth::user()->id)->first();
        }

        foreach($user->getRoleNames() as $role) {
            if(substr($role, 0, 3) === 'gr_') {
                $grupo = $role;
            }
        }
        if(!isset($grupo)) {
            session()->flash('status', 'Desculpe! Você não está em um grupo que permita criar um novo evento. Solicite a inclusão ao suporte.');
            session()->flash('alert', 'warning');

            return redirect()->to('/eventos');
        }
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
            "valor_inscricao" => isset($request->gratuito) ? '' : 'required',
            "prazo_envio_arquivo" => isset($request->ck_arquivo) ? 'required' : '',
            "input_personalizado" => isset($request->input_personalizado) ? 'max:255' : '',
            "modelo" => isset($request->enviar_modelo) ? 'file|max:5120|required|mimes:png' : '',
        ];

        $request->validate($toValidate);

        if( isset($request->modelo) || !$request->modelo == '') {
            $upload = new UploadFile();
            $certificado = new ModeloCertificado();
            $certificado->titulo = 'Certificado-'.uniqid();
            $certificado->arquivo = $upload->execute($request, 'modelo', 'png', 5000000);
            $certificado->save();
        }

        $dadosEvento = $request->except(['_token', 'inscricao']);

        if(App::environment('local')){
            $user = User::where('id', 2)->first();
        } else {
            $user = User::where('uid', Auth::user()->id)->first();
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

        if(isset($request->valor_inscricao)){
            $dadosEvento['valor_inscricao'] = str_replace(',', '.', str_replace('.', '',$request->valor_inscricao));
        }

        //$dadosEvento['valor_inscricao'] = empty($request->valor_inscricao) ? 0.00 : str_replace(',', '.', str_replace('.', '',$request->valor_inscricao));

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
        if(App::environment('local')){
            $user = User::where('id', 2)->first();
        } else {
            $user = User::where('uid', Auth::user()->id)->first();
        }

        foreach($user->getRoleNames() as $role) {
            if(substr($role, 0, 3) === 'gr_') {
                $grupo = $role;
            }
        }

        if(!isset($grupo) && $grupo != $evento->grupo_usuario) {
            session()->flash('status', 'Desculpe! Você não está em um grupo que permita editar este evento. Solicite a inclusão ao suporte.');
            session()->flash('alert', 'warning');

            return redirect()->to('/eventos');
        }
        if($evento->data_fim > now()){
            session()->flash('status', 'Desculpe! Não é permitido a edição de um evento que já terminou.');
            session()->flash('alert', 'danger');
            return redirect()->back();
        }
        if($evento->status == 'Encerrado'){
            if($user->hasRole('super')){
                session()->flash('status', 'Atenção! Você está acessando um evento que já foi encerrado. Por favor, tenha cuidado ao fazer alterações nos campos');
                session()->flash('alert', 'warning');
            } else {
                session()->flash('status', 'Desculpe! Não é permitido a edição de um evento encerrado.');
                session()->flash('alert', 'danger');

                return redirect()->back();
            }
        }
        return view('eventos.edit', compact('evento'));
    }

    public function update(Request $request, Evento $evento)
    {
        $dados = [
            'gratuito' => NULL,
            'valor_inscricao' => NULL,
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
            "valor_inscricao" => isset($request->gratuito) ? '' : 'required',
            "prazo_envio_arquivo" => isset($request->ck_arquivo) ? 'required' : '',
            "input_personalizado" => isset($request->input_personalizado) ? 'max:255' : '',
            "modelo" => isset($request->enviar_modelo) ? 'file|max:5120|mimes:png' : '',
        ];

        $request->validate($toValidate);

        if( isset($request->modelo) || !$request->modelo == '') {
            $upload = new UploadFile();
            $certificado = ModeloCertificado::find($evento->modelo_certificado_id);
            if($certificado->padrao == 1) {
                unset($certificado);
                $certificado = new ModeloCertificado();
                $certificado->titulo = 'Certificado-'.uniqid();
                $certificado->arquivo = $upload->execute($request, 'modelo', 'png', 5000000);
                $certificado->save();
                $dados['modelo_certificado_id'] = $certificado->id;
            }
            else {
                $certificadoAntigo = $certificado->arquivo;
                Storage::delete($certificadoAntigo);
                $certificado->arquivo = $upload->execute($request, 'modelo', 'png', 5000000);
                $certificado->save();
            }
        }

        /*if(!isset($request->gratuito) && isset($request->valor_inscricao)){
            $dados['valor_inscricao'] = str_replace(',', '.', str_replace('.', '',$request->valor_inscricao));
        }
        */

        // $vagasPreenchidas = $evento->inscritos->where('lista_espera', 0)->count();
        $vagasPreenchidas = $evento->inscritos->where('confirmacao', 1)->count();
        $inputs = $request->except('_token', '_method');
        foreach($inputs as $key => $value) {
            if($key == 'vagas' && !is_null($value) && ( $value < $vagasPreenchidas ) ) {
                session()->flash('status', 'O número de vagas não poder ser menor que o número de inscritos já cadastrados.');
                session()->flash('alert', 'danger');

                return redirect()->back();
            }

            $dados[$key] = $value;
        }

        $vagasDif = $request->vagas - $evento->vagas;

        if($evento->update($dados)) {
            $inscritosNaLista = EventoInscrito::where('lista_espera', 1)->where('evento_id', $evento->id)->limit($vagasDif)->get();
            $inscritosNaListaUpdated = EventoInscrito::where('lista_espera', 1)->where('evento_id', $evento->id)->limit($vagasDif)->update(['lista_espera' => 0]);
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

    public function updateCertificado(Request $request, Evento $evento){

        $dados = [];

        $toValidate = [
            "modelo" => 'file|max:5120|mimes:png'
        ];

        $request->validate($toValidate);

        if( isset($request->modelo) || !$request->modelo == '') {
            $upload = new UploadFile();
            $certificado = ModeloCertificado::find($evento->modelo_certificado_id);
            if($certificado->padrao == 1) {
                unset($certificado);
                $certificado = new ModeloCertificado();
                $certificado->titulo = 'Certificado-'.uniqid();
                $certificado->arquivo = $upload->execute($request, 'modelo', 'png', 5000000);
                $certificado->save();
                $dados['modelo_certificado_id'] = $certificado->id;
            }
            else {
                $certificadoAntigo = $certificado->arquivo;
                Storage::delete($certificadoAntigo);
                $certificado->arquivo = $upload->execute($request, 'modelo', 'png', 5000000);
                $certificado->save();
            }
        }


        if($evento->update($dados)) {
            session()->flash('status', 'Certificado Atualizado com sucesso.');
            session()->flash('alert', 'success');

            return redirect()->back()->withHeaders([
                'Content-Type' => 'text/javascript'
            ])->setContent("
                <script>
                    // Using JavaScript to navigate back in the browser history
                    window.history.back();
                </script>
            ");
        }
        else {
            session()->flash('status', 'Desculpe! Houve um erro ao atualizar o evento.');
            session()->flash('alert', 'danger');

            return redirect()->back();
        }

    }

    public function encerrar(Evento $evento)
    {
        if(App::environment('local')){
            $user = User::where('id', 2)->first();
        } else {
            $user = User::where('uid', Auth::user()->id)->first();
        }

        foreach($user->getRoleNames() as $role) {
            if(substr($role, 0, 3) === 'gr_') {
                $grupo = $role;
            }
        }
        if(!isset($grupo) && $grupo != $evento->grupo_usuario) {
            session()->flash('status', 'Desculpe! Você não está em um grupo que permita encerrar este evento. Solicite suporte caso discorde.');
            session()->flash('alert', 'warning');

            return redirect()->to('/eventos');
        }

        $evento->status = 'Encerrado';

        if($evento->save()) {
            session()->flash('status', 'Evento Encerrado com sucesso.');
            session()->flash('alert', 'success');

            return redirect()->to('/eventos');
        }
        else {
            session()->flash('status', 'Desculpe! Houve um erro ao Encerrar o evento.');
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
