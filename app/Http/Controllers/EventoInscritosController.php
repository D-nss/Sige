<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Mail;
use Illuminate\Support\Facades\Notification;

use App\Mail\EnviarEmail;
use App\Notifications\RecursoArquivoNotificar;

use App\Models\Evento;
use App\Models\EventoInscrito;
use App\Models\ComissaoUser;
use App\Models\User;
use App\Models\UploadFile;
use Illuminate\Support\Facades\App;

use App\Services\Avaliacao\Subcomissao;

use App\Services\Avaliacao;

class EventoInscritosController extends Controller
{
    public function index(Evento $evento)
    {
        $confirmados = EventoInscrito::where('confirmacao', 1)->where('lista_espera', 0)->where('evento_id', $evento->id)->get();
        $listaEspera = EventoInscrito::where('lista_espera', 1)->where('evento_id', $evento->id)->get();
        $naoConfirmados = EventoInscrito::where('confirmacao', 0)->where('evento_id', $evento->id)->get();
        $cancelados = EventoInscrito::where('confirmacao', 2)->where('evento_id', $evento->id)->get();

        return view('eventos.inscritos.index', compact('evento', 'confirmados', 'listaEspera', 'naoConfirmados', 'cancelados'));
    }

    public function create(Evento $evento)
    {
        if(Auth::check()) {
            $user = User::where('email', Auth::user()->id)->first();
        }

        if(
            (
                !is_null($evento->inscricao_inicio)
                &&
                strtotime(date('Y-m-d H:i:s')) >= strtotime($evento->inscricao_inicio)
                &&
                strtotime(date('Y-m-d H:i:s')) <= strtotime($evento->inscricao_fim)
            )
            ||
            (
                isset($user)
                &&
                $user->hasRole($evento->grupo_usuario)
            )

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

        //falta validar os inputs
        $toValidate = [
            "nome" => 'required',
            "email" => 'required|email',
            "tipo_documento" => ($evento->ck_documento) ? 'required' : '',
            "documento" => ($evento->ck_documento) ? 'required|integer' : '',
            "sexo" => ($evento->ck_sexo) ? 'required' : '',
            "genero" => ($evento->ck_identidade_genero) ? 'required' : '',
            'instituicao' => ($evento->ck_instituicao) ? 'required' : '',
            'pais' => ($evento->ck_pais) ? 'required' : '',
            'area' => ($evento->ck_area) ? 'required' : '',
            'vinculo' => ($evento->ck_vinculo) ? 'required' : '',
            'nascimento' => ($evento->ck_nascimento) ? 'required|date|before:' . today() : '',
            'funcao' => ($evento->ck_funcao) ? 'required' : '',
            'municipio' => ($evento->ck_cidade_estado) ? 'required' : '',
            'input_personalizado' => isset($evento->input_personalizado) ? 'required' : '',
        ];

        $request->validate($toValidate);

        $checkInscrito = EventoInscrito::where('email', $request->email)->where('evento_id', $evento->id)->first();
        //Checa se o e-mail já está cadastrado
        if($checkInscrito) {
            session()->flash('status', 'Desculpe! Este e-mail já está cadastrado.');
            session()->flash('alert', 'warning');

            return redirect()->back();
        }
        //Adiciona a lista de espera se exceder as vagas
        if(!is_null($evento->vagas) && $evento->inscritos->count() >= $evento->vagas) {
            $inputs['lista_espera'] = 1;
            $inputs['posicao_espera'] = $evento->inscritos->last()->posicao_espera + 1;
        }

        $inscrito = EventoInscrito::create($inputs);

        if($inscrito) {
            $inscrito->notify( new \App\Notifications\EventoInscritoNotificar([
                'titulo_evento' => $evento->titulo,
                'nome' => $inscrito->nome,
                'id' => $inscrito->id
            ]));

            if($inscrito->lista_espera == 1) {
                session()->flash('status', 'Inscrição realizada, mas devido exceder as vagas para o evento sua inscrição entrou em nossa fila de espera.');
                session()->flash('alert', 'warning');
            }
            else {
                session()->flash('status', 'Inscrição realizada com sucesso.');
                session()->flash('alert', 'success');
            }
            //trocar o redirecionamento para a pagina de listagem de eventos para usuarios não autenticados
            //return redirect()->back();
            return view('eventos.inscritos.aviso', compact('inscrito'));
        }
        else {
            session()->flash('status', 'Desculpe! Houve um erro ao realizar inscrição.');
            session()->flash('alert', 'danger');

            return redirect()->back();
        }
    }

    public function show($id)
    {
        $inscrito = EventoInscrito::find($id);

        // if(Auth::check()) {
            $user = User::where('id', 1)->first();
            $user_id = $user->id;
        // }
        // else {
        //     $user_id = '';
        // }
        // o acesso a view do painel do inscrito será limitado a quem?
        $userNaComissao = ComissaoUser::join('comissoes', 'comissoes.id', 'comissoes_users.comissao_id')
                                ->where('comissoes.evento_id', $inscrito->evento->id)
                                ->where('comissoes_users.user_id', $user_id)
                                ->first();

        return view('eventos.inscritos.show', compact('inscrito', 'userNaComissao'));
    }

    public function uploadArquivo(Request $request, $id)
    {
        if( isset($request->arquivo) || !$request->arquivo == '') {

            $upload = new UploadFile();
            $arquivo = $upload->execute($request, 'arquivo', 'pdf', 30000);

            $inscrito = EventoInscrito::find($id);
            $inscrito->arquivo = $arquivo;
            if($inscrito->update()) {
                session()->flash('status', 'Arquivo enviado com sucesso.');
                session()->flash('alert', 'success');

                return redirect()->back();
            }
            else {
                session()->flash('status', 'Erro ao enviar arquivo.');
                session()->flash('alert', 'danger');

                return redirect()->back();
            }

        }
    }

    public function recursoArquivo(Request $request, $id)
    {
        $validated = $request->validate([
            'argumentacao' => 'required|max:500',
        ]);
        
        $inscrito = EventoInscrito::find($id);
        echo json_encode($inscrito->analista);
        // $inscrito->recurso_arquivo = $request->argumentacao;
        // if($inscrito->save()) {
        //     Notification::send($inscrito->analista, new RecursoArquivoNotificar($inscrito));
        //     session()->flash('status', 'Recurso enviado com sucesso.');
        //     session()->flash('alert', 'success');

        //     return redirect()->back();
        // }
        // else {
        //     session()->flash('status', 'Erro ao enviar recurso.');
        //     session()->flash('alert', 'danger');

        //     return redirect()->back();
        // }

    }

    public function avaliaRecurso(Request $request, $id)
    {
        $validated = $request->validate([
            'resposta_recurso' => 'required',
        ]);

        $inscrito = EventoInscrito::find($id);
        $inscrito->resposta_recurso = $request->resposta_recurso;
        if($request->resposta_recurso == 'Aceito') {
            $inscrito->status_arquivo == 'Aceito';
        }

        if($inscrito->save()) {
            Notification::send($inscrito->analista, new RecursoAnaliseNotificar($inscrito));
            session()->flash('status', 'Recurso enviado com sucesso.');
            session()->flash('alert', 'success');

            return redirect()->back();
        }
        else {
            session()->flash('status', 'Erro ao enviar recurso.');
            session()->flash('alert', 'danger');

            return redirect()->back();
        }
    }

    public function analiseArquivo(Request $request, $id)
    {
        if(App::environment('local')){
            $user = User::where('id', 1)->first();
        } else {
            $user = User::where('email', Auth::user()->id)->first();
        }
        $inscrito = EventoInscrito::find($id);
        $subcomissao = new Subcomissao();
        $avaliacao = new Avaliacao($subcomissao);
        $resposta = $avaliacao->executeAvaliacaoInscritoEvento($request, $inscrito, $user);

        if($resposta) {
            $inscrito->notify( new \App\Notifications\EventoInscritoAnaliseArquivoNotificar($inscrito));

            session()->flash('status', 'Análise enviado com sucesso.');
            session()->flash('alert', 'success');

            return redirect()->to($resposta['redirect']);
        }
        else {
            session()->flash('status', 'Erro ao enviar análise.');
            session()->flash('alert', 'danger');

            return redirect()->to($resposta['redirect']);
        }
    }

    public function adm_confirmar($id)
    {
        $inscrito = EventoInscrito::find($id);

        $inscrito->confirmacao = 1;
        $inscrito->data_confirmacao = date('Y-m-d H:i:s');
        if($inscrito->update()) {
            $crypt = \Illuminate\Support\Facades\Crypt::encryptString('sim/' . $inscrito->id);
            $url = url("inscritos/presenca/$crypt");
            //Gerando QRCode
            $qrcode = QrCode::size(200)->generate( url($url));
            return view('eventos.inscritos.confirmacao', compact('inscrito', 'qrcode', 'crypt'));
        }
        else {
            session()->flash('status', 'Desculpe! Houve um erro ao realizar a confirmação inscrição.');
            session()->flash('alert', 'danger');

            return redirect()->back();
        }
    }

    public function confirmar($codigo)
    {
        $decrypt = \Illuminate\Support\Facades\Crypt::decryptString(str_replace('90', '09', $codigo));
        $data = explode('/', $decrypt);

        $inscrito = EventoInscrito::find($data[1]);
        if($inscrito && $data[0] == 'sim' && $inscrito->confirmacao == 0)
        {
            $inscrito->confirmacao = 1;
            $inscrito->data_confirmacao = date('Y-m-d H:i:s');
            if($inscrito->update()) {
                $crypt = \Illuminate\Support\Facades\Crypt::encryptString('sim/' . $inscrito->id);
                $idCrypted = \Illuminate\Support\Facades\Crypt::encryptString($inscrito->id);
                // em ajuste...
               /* $inscrito->notify( new \App\Notifications\EventoInscritoLinkPainelNotificacao([
                    'titulo_evento' => $inscrito->evento->titulo,
                    'nome' => $inscrito->nome,
                    'id' => $idCrypted
                ]));*/
                $url = url("inscritos/presenca/$crypt");
                //Gerando QRCode
                $qrcode = QrCode::size(200)->generate( url($url));
                return view('eventos.inscritos.confirmacao', compact('inscrito', 'qrcode', 'crypt'));
            }
            else {
                session()->flash('status', 'Desculpe! Houve um erro ao realizar a confirmação inscrição.');
                session()->flash('alert', 'danger');

                return redirect()->back();
            }
        }
        elseif($inscrito && $data[0] == 'nao')
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

    public function marcarPresenca($codigo)
    {
        $decrypt = \Illuminate\Support\Facades\Crypt::decryptString(str_replace('90', '09', $codigo));
        $data = explode('/', $decrypt);

        $inscrito = EventoInscrito::find($data[1]);

        if($inscrito->lista_espera == 1) {
            session()->flash('status', 'Desculpe! O usuário está na fila de espera.');
            session()->flash('alert', 'danger');

            return redirect()->back();
        }

        if($inscrito && $inscrito->presenca == 0 && $data[0] == 'sim') {
            $inscrito->presenca = 1;
            if($inscrito->update()) {
                session()->flash('status', 'Presença cadastrada com sucesso.');
                session()->flash('alert', 'success');

                return redirect()->back();
            }
            else {
                session()->flash('status', 'Desculpe! Houve um erro ao realizar a confirmação inscrição.');
                session()->flash('alert', 'danger');

                return redirect()->back();
            }
        }
        else {
            session()->flash('status', 'Desculpe! Não foi possível cadsatrar a presença.');
            session()->flash('alert', 'danger');

            return redirect()->back();
        }

    }

    public function baixarQrcode($codigo)
    {
        $decrypt = \Illuminate\Support\Facades\Crypt::decryptString(str_replace('90', '09', $codigo));
        $data = explode('/', $decrypt);

        $inscrito = EventoInscrito::find($data[1]);

        //Gerando QRCode
        $url = url("inscritos/presenca/$codigo");
        $qrcode = QrCode::size(200)->generate( url($url));

        $html = "
            <div style='display:flex; flex-direction: column; border: 2px solid #000; border-radius: 8px; max-width:350px; padding: 24px;'>
                <div>
                    <p style='font-weight: bold; font-size:32px;'>
                    Evento: ". $inscrito->evento->titulo ."
                    </p>
                </div>
                <div>
                    <p style='font-weight: bold; font-size:16px;'>
                    De ". date('d/m/Y H:i:s', strtotime($inscrito->evento->data_inicio)) ." à ". date('d/m/Y H:i:s', strtotime($inscrito->evento->data_fim)) ."
                    </p>
                </div>
                <div>
                    <p style='font-weight: bold; font-size:28px;'>
                    Nome: ". $inscrito->nome ."
                    </p>
                </div>
                <div>
                    <img src='data:image/png;base64, " . base64_encode($qrcode) ."'>
                </div>
                <div style='margin-top: 8px;'>
                    Pro-reitoria de Extensão e Cultura - UNICAMP
                </div>
            </div>";

        $pdf = Pdf::loadHtml($html);
        $pdf->setPaper('a4');
        return $pdf->download();
    }

    public function enviarEmailCreate($id)
    {
        return view('eventos.inscritos.enviar_email', compact('id'));
    }

    public function enviarEmail(Request $request, $id)
    {
        $inscrito = EventoInscrito::find($id);

        if($request->tipo_mensagem == 'confirmar'){

            $inscrito->notify( new \App\Notifications\EventoInscritoNotificar([
                'titulo_evento' => $inscrito->evento->titulo,
                'nome' => $inscrito->nome,
                'id' => $inscrito->id
            ]));

            session()->flash('status', 'E-mail de confirmação reenviado.');
            session()->flash('alert', 'success');

            return redirect()->back();
        }

        if($request->tipo_mensagem == 'mensagem') {
            $detalhes = [
                'nome' => $inscrito->nome,
                'titulo_evento' => $inscrito->evento->titulo,
                'mensagem' => $request->mensagem
            ];

            Mail::to($inscrito->email)->send(new EnviarEmail($detalhes));

            session()->flash('status', 'Mensagem de E-mail enviada com sucesso.');
            session()->flash('alert', 'success');

            return redirect()->back();
        }

    }
}
