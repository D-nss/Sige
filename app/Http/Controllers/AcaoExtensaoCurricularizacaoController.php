<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\App;

use App\Models\AcaoExtensaoOcorrencia;
use App\Models\AcaoExtensaoCurricularizacao;

use App\Models\User;

class AcaoExtensaoCurricularizacaoController extends Controller
{
    public function index(AcaoExtensaoOcorrencia $acao_extensao_ocorrencia)
    {
        if(App::environment('local')){
            $user = User::where('id', 2)->first();
        } else {
            $user = User::where('email', Auth::user()->id)->first();
        }

        if($acao_extensao_ocorrencia->acao_extensao->user_id != $user->id) {
            session()->flash('status', 'Desculpe! Somente o coordenador da Ação de Extensão pode gerenciar.');
            session()->flash('alert', 'warning');

            return redirect()->back();
        }

        if(count($acao_extensao_ocorrencia->curricularizacao) > 0) {
            $curricularizacoes = $acao_extensao_ocorrencia->curricularizacao;

            //pegando dados do aluno de um arquivo json com dados dos aluno (Temporário)
            $alunos = json_decode(File::get(storage_path('alunos.json')), true);
            foreach($curricularizacoes as $c){
                
                foreach($alunos as $aluno){
                    if($aluno["NREGALUN"] == $c->aluno_ra) {
                        $c['aluno_ra'] = $aluno;
                        break;
                    }
                }
            }

            return view('acoes-extensao.curricularizacao.index', compact('curricularizacoes', 'acao_extensao_ocorrencia'));
        }
        else {
            session()->flash('status', 'Desculpe! Não há ocorrências para esta ação e extensão, por tanto não possui alunos de curricularização');
            session()->flash('alert', 'warning');

            return redirect()->back();
        }
    }

    public function create(AcaoExtensaoOcorrencia $acao_extensao_ocorrencia)
    {
        if(Auth::user()->employeetype != "Aluno UNICAMP") {
            session()->flash('status', 'Desculpe! Somente alunos UNICAMP podem participar da curricularização.');
            session()->flash('alert', 'warning');

            return redirect()->back();
        }

        //pegando dados do aluno de um arquivo json com dados dos aluno (Temporário)
        $dadosAluno = '';
        echo $matricula = Auth::user()->matricula;
        // $alunos = json_decode(File::get(storage_path('alunos.json')), true);
        // foreach($alunos as $aluno){
        //     if($aluno["NREGALUN"] == $matricula) {
        //         $dadosAluno = $aluno;
        //         break;
        //     }
        // }

        // if(empty($dadosAluno)) {
        //     session()->flash('status', 'Desculpe! Somente alunos regulares e ativos podem participar da curricularização.');
        //     session()->flash('alert', 'warning');

        //     return redirect()->back();
        // }

        // return view('acoes-extensao.curricularizacao.create', compact('acao_extensao_ocorrencia', 'dadosAluno'));
    }

    public function store(Request $request, AcaoExtensaoOcorrencia $acao_extensao_ocorrencia)
    {
        $checkCurricularizacao = AcaoExtensaoCurricularizacao::where('acao_extensao_ocorrencia_id', $acao_extensao_ocorrencia->id)
                                                            ->where('aluno_ra', $request->ra)->get();
        
        if(count($checkCurricularizacao) > 0) {
            session()->flash('status', 'Desculpe! Você já se inscreveu para esta Ação de Extensão.');
            session()->flash('alert', 'warning');

            return redirect()->back();
        }

        $acaoExtensaoCurricularizacao = [
            'acao_extensao_ocorrencia_id' => $acao_extensao_ocorrencia->id,
            'aluno_ra' => $request->ra,
            'status' => NULL,
            'horas' => NULL,
            'apto' => NULL
        ];
        
        $acaoExtensaoCurricularizacaoCriada = AcaoExtensaoCurricularizacao::create($acaoExtensaoCurricularizacao);

        if($acaoExtensaoCurricularizacaoCriada) {
            session()->flash('status', 'Inscrição relizada com sucesso, a próxima etapa é a análise do coordenador, fique atento ao seu e-mail você será avisado por lá.');
            session()->flash('alert', 'success');

            return redirect()->back();
        }
        else {
            session()->flash('status', 'Desculpe! Houve um erro ao se inscrever.');
            session()->flash('alert', 'danger');

            return redirect()->back();
        }
    }

    public function aceitar(Request $request, AcaoExtensaoCurricularizacao $acaoExtensaoCurricularizacao)
    {
        if(App::environment('local')){
            $user = User::where('id', 2)->first();
        } else {
            $user = User::where('email', Auth::user()->id)->first();
        }

        $acaoExtensaoOcorrenciaId = $acaoExtensaoCurricularizacao->acao_extensao_ocorrencia->id;

        $acao_extensao_ocorrencia = AcaoExtensaoOcorrencia::find($acaoExtensaoOcorrenciaId);

        if($acao_extensao_ocorrencia->acao_extensao->user_id != $user->id) {
            session()->flash('status', 'Desculpe! Somente o coordenador da Ação de Extensão pode gerenciar.');
            session()->flash('alert', 'warning');

            return redirect()->back();
        }

        $validado = $request->validate([
            'status' => 'required',
        ]);

        $acaoExtensaoCurricularizacao->status = $request->status;
        if($acaoExtensaoCurricularizacao->update()) {
            session()->flash('status', 'Inscrição atualizada com sucesso.');
            session()->flash('alert', 'success');

            return redirect()->to("acoes-extensao-ocorrencia/$acaoExtensaoOcorrenciaId/curricularizacao/");
        }
        else {
            session()->flash('status', 'Desculpe! Houve um erro ao atualizar inscrição.');
            session()->flash('alert', 'danger');

            return redirect()->to("acoes-extensao-ocorrencia/$acaoExtensaoOcorrenciaId/curricularizacao");
        }
    }

    public function apontar(Request $request, AcaoExtensaoCurricularizacao $acaoExtensaoCurricularizacao)
    {
        if(App::environment('local')){
            $user = User::where('id', 2)->first();
        } else {
            $user = User::where('email', Auth::user()->id)->first();
        }

        $acaoExtensaoOcorrenciaId = $acaoExtensaoCurricularizacao->acao_extensao_ocorrencia->id;

        $acao_extensao_ocorrencia = AcaoExtensaoOcorrencia::find($acaoExtensaoOcorrenciaId);

        if($acao_extensao_ocorrencia->acao_extensao->user_id != $user->id) {
            session()->flash('status', 'Desculpe! Somente o coordenador da Ação de Extensão pode gerenciar.');
            session()->flash('alert', 'warning');

            return redirect()->back();
        }

        $acaoExtensaoCurricularizacao->apto = $request->apto;
        $acaoExtensaoCurricularizacao->horas = $request->horas;

        if($acaoExtensaoCurricularizacao->update()) {
            session()->flash('status', 'Inscrição atualizada com sucesso.');
            session()->flash('alert', 'success');

            return redirect()->to("acoes-extensao-ocorrencia/$acaoExtensaoOcorrenciaId/curricularizacao/");
        }
        else {
            session()->flash('status', 'Desculpe! Houve um erro ao atualizar inscrição.');
            session()->flash('alert', 'danger');

            return redirect()->to("acoes-extensao-ocorrencia/$acaoExtensaoOcorrenciaId/curricularizacao");
        }
    }

    public function tornarApto(AcaoExtensaoCurricularizacao $acaoExtensaoCurricularizacao)
    {
        if(App::environment('local')){
            $user = User::where('id', 2)->first();
        } else {
            $user = User::where('email', Auth::user()->id)->first();
        }

        $acaoExtensaoOcorrenciaId = $acaoExtensaoCurricularizacao->acao_extensao_ocorrencia->id;

        $acao_extensao_ocorrencia = AcaoExtensaoOcorrencia::find($acaoExtensaoOcorrenciaId);

        if($acao_extensao_ocorrencia->acao_extensao->user_id != $user->id) {
            session()->flash('status', 'Desculpe! Somente o coordenador da Ação de Extensão pode gerenciar.');
            session()->flash('alert', 'warning');

            return redirect()->back();
        }

        if($acaoExtensaoCurricularizacao->apto == 1) {
            $acaoExtensaoCurricularizacao->apto = 0;
        }
        elseif($acaoExtensaoCurricularizacao->apto == 0) {
            $acaoExtensaoCurricularizacao->apto = 1;
        }

        if($acaoExtensaoCurricularizacao->update()) {
            session()->flash('status', 'Inscrição atualizada com sucesso.');
            session()->flash('alert', 'success');

            return redirect()->to("acoes-extensao-ocorrencia/$acaoExtensaoOcorrenciaId/curricularizacao/");
        }
        else {
            session()->flash('status', 'Desculpe! Houve um erro ao atualizar inscrição.');
            session()->flash('alert', 'danger');

            return redirect()->to("acoes-extensao-ocorrencia/$acaoExtensaoOcorrenciaId/curricularizacao");
        }
    }
}
