<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

use App\Models\AcaoExtensaoOcorrencia;
use App\Models\AcaoExtensaoCurricularizacao;

class AcaoExtensaoCurricularizacaoController extends Controller
{
    public function index(AcaoExtensaoOcorrencia $acao_extensao_ocorrencia)
    {
        if(count($acao_extensao_ocorrencia->curricularizacao) > 0) {
            $curricularizacoes = $acao_extensao_ocorrencia->curricularizacao;
            foreach($curricularizacoes as $c){
                $conteudo = json_decode(file_get_contents('http://localhost:9000/alunos/' . $c->aluno_ra));
                $c['aluno_ra'] = $conteudo;
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
        $dadosAluno = '';
        $matricula = Auth::user()->matricula;
        $alunos = json_decode(File::get(storage_path('alunos.json')), true);
        foreach($alunos as $aluno){
            if($aluno["NREGALUN"] == $matricula) {
                $dadosAluno = $aluno;
                break;
            }
            
        }

        if(Auth::user()->employeetype === "Aluno UNICAMP" || empty($dadosAluno)) {
            session()->flash('status', 'Desculpe! Somente alunos UNICAMP podem participar da curricularização.');
            session()->flash('alert', 'warning');

            return redirect()->back();
        }
        
        return view('acoes-extensao.curricularizacao.create', compact('acao_extensao_ocorrencia', 'dadosAluno'));
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
        $validado = $request->validate([
            'status' => 'required',
        ]);

        $acaoExtensaoOcorrenciaId = $acaoExtensaoCurricularizacao->acao_extensao_ocorrencia->id;

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
    
        $acaoExtensaoOcorrenciaId = $acaoExtensaoCurricularizacao->acao_extensao_ocorrencia->id;

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
    
        $acaoExtensaoOcorrenciaId = $acaoExtensaoCurricularizacao->acao_extensao_ocorrencia->id;

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
