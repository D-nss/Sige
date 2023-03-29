<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;

use App\Mail\EnviarEmail;
use App\Notifications\RecursoArquivoNotificar;
use App\Notifications\RecursoAnaliseNotificar;
use App\Notifications\EventoCancelamentoArquivoNotificar;

use App\Models\Evento;
use App\Models\EventoInscrito;
use App\Models\Comissao;
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
            "documento" => ($evento->ck_documento) ? 'required|numeric' : '',
            "sexo" => ($evento->ck_sexo) ? 'required' : '',
            "genero" => ($evento->ck_identidade_genero) ? 'required' : '',
            'instituicao' => ($evento->ck_instituicao) ? 'required' : '',
            'pais' => ($evento->ck_pais) ? 'required' : '',
            'area' => ($evento->ck_area) ? 'required' : '',
            'vinculo' => ($evento->ck_vinculo) ? 'required' : '',
            'deficiencia' => ($evento->ck_deficiencia) ? 'required' : '',
            'desc_deficiencia' => (isset($request->deficiencia) && $request->deficiencia == 'Sim') ? 'required' : '',
            'etnico_racial' => ($evento->ck_racial) ? 'required' : '',
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

        $inscrito = EventoInscrito::create($inputs);

        if($inscrito) {

            if($inscrito->nome_social != NULL) {
                $nome = $inscrito->nome_social;
            } else {
                $nome = $inscrito->nome;
            }

            $inscrito->notify( new \App\Notifications\EventoInscritoNotificar([
                'titulo_evento' => $evento->titulo,
                'nome' => $nome,
                'id' => $inscrito->id
            ]));

            /*if($inscrito->lista_espera == 1) {
                session()->flash('status', 'Inscrição realizada, mas devido exceder as vagas para o evento sua inscrição entrou em nossa fila de espera.');
                session()->flash('alert', 'warning');
            }
            else {

            }*/

            session()->flash('status', 'Conclua inscrição através do email informado.');
                session()->flash('alert', 'warning');
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

    public function show($codigo)
    {
        $id = \Illuminate\Support\Facades\Crypt::decryptString($codigo);
        $inscrito = EventoInscrito::find($id);

        if(Auth::check()) {
            if(App::environment('local')){
                $user = User::where('id', 1)->first();
            } else {
                $user = User::where('email', Auth::user()->id)->first();
            }
            $user_id = $user->id;
        }
        else {
            $user_id = '';
        }
        // o acesso a view do painel do inscrito será limitado a quem?
        $userNaComissao = ComissaoUser::join('comissoes', 'comissoes.id', 'comissoes_users.comissao_id')
                                ->where('comissoes.evento_id', $inscrito->evento->id)
                                ->where('comissoes_users.user_id', $user_id)
                                ->first();

        $crypt = \Illuminate\Support\Facades\Crypt::encryptString('sim/' . $inscrito->id);
        $url = url("inscritos/presenca/$crypt");
        //Gerando QRCode
        $qrcode = QrCode::size(200)->generate( url($url));

        return view('eventos.inscritos.show', compact('inscrito', 'userNaComissao', 'qrcode', 'crypt'));
    }

    public function uploadArquivo(Request $request, $id)
    {
        $validated = $request->validate([
            'arquivo' => 'required|mimes:pdf',
            'titulo_trabalho' => 'required'
        ]);

        if( isset($request->arquivo) || !$request->arquivo == '') {

            $inscrito = EventoInscrito::find($id);
            if(!is_null($inscrito->arquivo) && Storage::disk('public')->exists($inscrito->arquivo)) {
                $arquivo_antigo = $inscrito->arquivo;
                Storage::disk('public')->delete($arquivo_antigo);
            }

            $upload = new UploadFile();
            $arquivo = $upload->execute($request, 'arquivo', 'pdf', 30000);
            $inscrito->arquivo = $arquivo;
            $inscrito->status_arquivo = 'Em Análise';
            $inscrito->titulo_trabalho = $request->titulo_trabalho;
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
        $inscrito->recurso_arquivo = $request->argumentacao;
        if($inscrito->save()) {
            Notification::send($inscrito->analista, new RecursoArquivoNotificar($inscrito));
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

    public function avaliaRecurso(Request $request, $id)
    {
        $validated = $request->validate([
            'resposta_recurso' => 'required',
        ]);

        $inscrito = EventoInscrito::find($id);
        $inscrito->resposta_recurso = $request->resposta_recurso;
        if($request->resposta_recurso == 'Aceito') {
            $inscrito->status_arquivo = 'Aceito';
        }

        if($inscrito->save()) {
            $inscrito->notify( new \App\Notifications\RecursoAnaliseNotificar($inscrito));
            session()->flash('status', 'Avaliação de recurso enviada com sucesso.');
            session()->flash('alert', 'success');

            return redirect()->back();
        }
        else {
            session()->flash('status', 'Erro ao enviar avaliação de recurso.');
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

    public function adm_presenca($id)
    {
        $inscrito = EventoInscrito::find($id);

        if($inscrito && $inscrito->presenca == 0) {
            $inscrito->presenca = 1;
            $options = [
                'cost' => 10,
                ];
            $inscrito->certificado = str_replace('$2y$10$', '', password_hash("certificado-inscrito-".$inscrito->id, PASSWORD_BCRYPT, $options));
            if($inscrito->update()) {
                session()->flash('status', 'Presença efetuada com sucesso.');
                session()->flash('alert', 'success');

                return redirect()->back();
            }
            else {
                session()->flash('status', 'Desculpe! Houve um erro ao realizar a presença do inscrito.');
                session()->flash('alert', 'danger');

                return redirect()->back();
            }
        }
    }

    public function confirmar($codigo)
    {
        $decrypt = \Illuminate\Support\Facades\Crypt::decryptString(str_replace('90', '09', $codigo));
        $data = explode('/', $decrypt);

        $inscrito = EventoInscrito::find($data[1]);
        if($inscrito && $data[0] == 'sim' && $inscrito->lista_espera == 0)
        {
            $evento = Evento::find($inscrito->evento_id);

            //se inscrito já confirmou vai na area do inscrito
            if($inscrito->confirmacao == 1){
                session()->flash('status', 'Imprima ou tenha em mãos o QR Code para o credenciamento no evento!');
                session()->flash('alert', 'warning');

                return $this->show(\Illuminate\Support\Facades\Crypt::encryptString($inscrito->id));
            }

            if(strtotime(date('Y-m-d H:i:s')) >= strtotime($evento->inscricao_fim)){
                session()->flash('status', 'Confirmação não concluída pois já se encerrou o prazo de inscrição para este evento');
                session()->flash('alert', 'danger');

                return view('eventos.inscritos.confirmacao', compact('inscrito'));
            }

            //Adiciona a lista de espera se exceder as vagas
            if(!is_null($evento->vagas) && $evento->inscritos->where('lista_espera', 0)->where('confirmacao', 1)->count() >= $evento->vagas) {
                //Caso tenha já confirmado já uma vez e clicou novamente onde está na lista de espera
                /*if($inscrito->lista_espera == 1){
                    session()->flash('status', 'Desculpe, as vagas esgotaram, e você persiste na lista de espera. Caso tenha aberto mais vagas, você será notificado por email .');
                    session()->flash('alert', 'danger');

                    return redirect()->back();
                } else {*/
                    $inscrito->lista_espera = 1;
                    $inscrito->posicao_espera = $evento->inscritos->last()->posicao_espera + 1;
                    session()->flash('status', 'Desculpe, as vagas esgotaram, e você está lista de espera. Caso houver vaga, você será notificado por email .');
                    session()->flash('alert', 'danger');
                //}
            }

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
        elseif($inscrito && $data[0] == 'nao' && $inscrito->confirmacao == 1 && $inscrito->lista_espera == 0)
        {
            $inscrito->confirmacao = 2;
            if($inscrito->update()) {
                //Caso tenha inscrito na fila de espera, remove o primeiro que foi incluso e atualiza e é notificado por email que está confirmado
                $inscritoFila = EventoInscrito::where('evento_id', $inscrito->evento->id)->where('lista_espera', 1)->first();
                if($inscritoFila){
                    $inscritoFila->lista_espera = 0;
                    if($inscritoFila->update()){

                        if($inscritoFila->nome_social != NULL) {
                            $nome = $inscritoFila->nome_social;
                        } else {
                            $nome = $inscritoFila->nome;
                        }

                        $inscritoFila->notify( new \App\Notifications\EventoInscritoConfirmado([
                            'titulo_evento' => $inscritoFila->evento->titulo,
                            'nome' => $nome,
                            'id' => $inscritoFila->id
                        ]));
                    }
                }

                return view('eventos.inscritos.confirmacao', compact('inscrito'));
            }
            else {
                session()->flash('status', 'Desculpe! Houve um erro ao realizar a cancelar inscrição.');
                session()->flash('alert', 'danger');

                return redirect()->back();
            }
        }
        else {
            if ($inscrito && $data[0] == 'sim' && $inscrito->lista_espera == 1){
                session()->flash('status', 'Desculpe, as vagas esgotaram, e você está lista de espera. Caso tenha aberto mais vagas, você será notificado por email .');
                session()->flash('alert', 'danger');

                return view('eventos.inscritos.confirmacao', compact('inscrito'));
            }
            else {
                session()->flash('status', 'Desculpe! Não foi possível confirmação inscrição. Caso persista, entre em contato com a equipe do evento');
                session()->flash('alert', 'danger');
            }

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
            $options = [
                'cost' => 10,
                ];
            $inscrito->certificado = str_replace('$2y$10$', '', password_hash("certificado-inscrito-".$inscrito->id, PASSWORD_BCRYPT, $options));
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

        if($inscrito->nome_social != NULL) {
            $nome = $inscrito->nome_social;
        } else {
            $nome = $inscrito->nome;
        }

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
                    Nome: ". $nome ."
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

        if($inscrito->nome_social != NULL) {
            $nome = $inscrito->nome_social;
        } else {
            $nome = $inscrito->nome;
        }

        if($request->tipo_mensagem == 'confirmar'){

            $inscrito->notify( new \App\Notifications\EventoInscritoNotificar([
                'titulo_evento' => $inscrito->evento->titulo,
                'nome' => $nome,
                'id' => $inscrito->id
            ]));

            session()->flash('status', 'E-mail de confirmação reenviado.');
            session()->flash('alert', 'success');

            return redirect()->back();
        }

        if($request->tipo_mensagem == 'mensagem') {
            $detalhes = [
                'nome' => $nome,
                'titulo_evento' => $inscrito->evento->titulo,
                'mensagem' => $request->mensagem
            ];

            Mail::to($inscrito->email)->send(new EnviarEmail($detalhes));

            session()->flash('status', 'Mensagem de E-mail enviada com sucesso.');
            session()->flash('alert', 'success');

            return redirect()->back();
        }

    }

    public function cancelarApresentacaoArquivo($id)
    {
        $inscrito = EventoInscrito::find($id);
        $inscrito->status_arquivo = 'Cancelado';

        if($inscrito->update()) {
            Notification::send($inscrito->evento->comissao->users, new EventoCancelamentoArquivoNotificar($inscrito));
            session()->flash('status', 'Apresentação cancelada com sucesso.');
            session()->flash('alert', 'success');

            return redirect()->back();
        }
        else {
            session()->flash('status', 'Desculpe! Houve um erro ao cancelar a apresentação.');
            session()->flash('alert', 'danger');

            return redirect()->back();
        }
    }
}
