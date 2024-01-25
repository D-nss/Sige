<?php

namespace App\Http\Controllers\AcoesExtensao;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\App;

use App\Models\User;
use App\Models\AcaoExtensaoOcorrencia;
use App\Models\AcaoExtensao;
use App\Models\AcaoExtensaoColaborador;
use App\Models\GrauEnvolvimentoEquipe;
use Illuminate\Http\Request;

class ExtensaoOcorrenciasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $ocorrencias = AcaoExtensaoOcorrencia::where('acao_extensao_id', $id)->get();

        $acao_extensao = AcaoExtensao::where('id', $id)->first();

        if( ((is_null($acao_extensao->qtd_horas_curricularizacao)  || $acao_extensao->qtd_horas_curricularizacao == 0 ) && (is_null($acao_extensao->vagas_curricularizacao) || $acao_extensao->vagas_curricularizacao == 0) ) ) {
            session()->flash('status', 'Para poder cadastrar ocorrências essa ação deve ser preenchida como curricularização.');
            session()->flash('alert', 'warning');
            return redirect()->route('acao_extensao.painel');
        }

        if(App::environment('local')){
            $user = User::where('id', 1)->first();
        } else {
            $user = User::where('uid', Auth::user()->id)->first();
        }

        if($acao_extensao->user_id != $user->id){
            session()->flash('status', 'Apenas o Coordenador da Ação pode gerenciar as ocorrências.');
            session()->flash('alert', 'danger');
            return redirect()->route('acao_extensao.show', ['acao_extensao' => $acao_extensao->id]);
        }

        return view('acoes-extensao.ocorrencias.index', [
            'ocorrencias' => $ocorrencias,
            'acao_extensao' => $acao_extensao,
            'user' => $user
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        if(App::environment('local')){
            $user = User::where('id', 2)->first();
        } else {
            $user = User::where('uid', Auth::user()->id)->first();
        }

        $acao_extensao = AcaoExtensao::where('id', $id)->first();

        if( ((is_null($acao_extensao->qtd_horas_curricularizacao)  || $acao_extensao->qtd_horas_curricularizacao == 0 ) && (is_null($acao_extensao->vagas_curricularizacao) || $acao_extensao->vagas_curricularizacao == 0) ) ) {
            session()->flash('status', 'Para poder cadastrar ocorrências essa ação deve ser preenchida como curricularização.');
            session()->flash('alert', 'warning');
            return redirect()->route('acao_extensao.painel');
        }

        if($acao_extensao->user_id != $user->id){
            session()->flash('status', 'Apenas o Coordenador pode incluir uma Ocorrencia.');
            session()->flash('alert', 'danger');
            return redirect()->route('acao_extensao.show', ['acao_extensao' => $acao_extensao->id]);
        }

        if($acao_extensao->status_comissao_graduacao != 'Sim') {
            session()->flash('status', 'Ação deve ter um parecer positivo da comissão de graduaçãoo para inclusão de ocorrências.');
            session()->flash('alert', 'warning');
            return redirect()->route('acao_extensao.show', ['acao_extensao' => $acao_extensao->id]);
        }

        return view('acoes-extensao.ocorrencias.create',[
            'acao_extensao' => $acao_extensao,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AcaoExtensao $acaoExtensao, Request $request)
    {
        $this->validate($request, [
            'data_hora_inicio' => ['required','date'],
            'data_hora_fim' => ['required','date','after:data_hora_inicio'],
            'local' => ['required'],
            'fim_inscricoes' => ['required_unless:inicio_inscricoes,null']
        ]);

        if(App::environment('local')){
            $user = User::where('id', 1)->first();
        } else {
            $user = User::where('uid', Auth::user()->id)->first();
        }

        $dados = $request->all();
        $dados['status'] = 'Aberto';
        $dados['acao_extensao_id'] = $acaoExtensao->id;

        $ocorrenciaCriada = AcaoExtensaoOcorrencia::create($dados);

        if($ocorrenciaCriada){
            Log::channel('acao_extensao')->info('Usuario Nome: ' . $user->name . ' - Usuario ID: ' . $user->id . ' - Operação: Adição de Ocorrencia na Ação de Extensão ('. $request->acao_extensao_id . ') - Local: ' . $request->local . ' - Endereço IP: ' . $request->ip());
            session()->flash('status', 'Ocorrência adicionada com sucesso!');
            session()->flash('alert', 'success');
        } else {
            Log::channel('acao_extensao')->error('Usuario Nome: ' . $user->name . ' - Usuario ID: ' . $user->id . ' - Erro: Adição de Ocorrencia na Ação de Extensão ('. $request->acao_extensao_id . ') - Local: ' . $request->local . ' - Endereço IP: ' . $request->ip());
            session()->flash('status', 'Erro ao adicionar ocorrência ao banco de dados.');
            session()->flash('alert', 'danger');
            return back();
        }

        return redirect()->route('acao_extensao.ocorrencias.index', ['acao_extensao' => $acaoExtensao->id] );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AcaoExtensaoOcorrencia  $acaoExtensaoOcorrencia
     * @return \Illuminate\Http\Response
     */
    public function show(AcaoExtensaoOcorrencia $acaoExtensaoOcorrencia)
    {
        if(App::environment('local')){
            $user = User::where('id', 1)->first();
        } else {
            $user = User::where('uid', Auth::user()->id)->first();
        }

        $graus_envolvimento_equipe = GrauEnvolvimentoEquipe::all();
        $lista_documento = array('CPF', 'Estrangeiro (RNE)');
        $lista_vinculo = array('Aluno Graduação (Unicamp)', 'Aluno Pós-Graduação (Unicamp)', 'Docente (Unicamp)', 'Pesquisador (Unicamp)', 'Técnico-Administrativo (Unicamp)','Externo à universidade');

        //mudar para equipe ocorrencia
        $colaboradores_ocorrencia = AcaoExtensaoColaborador::where('acao_extensao_id', $acaoExtensaoOcorrencia->acao_extensao->id)->orderBy('nome')->get();

        if($acaoExtensaoOcorrencia->acao_extensao->user_id == $user->id){
            $userCoordenadorAcao = $user;
        } else {
            $userCoordenadorAcao = false;
        }

        return view('acoes-extensao.ocorrencias.show', compact('acaoExtensaoOcorrencia', 'graus_envolvimento_equipe', 'userCoordenadorAcao', 'lista_documento', 'lista_vinculo', 'colaboradores_ocorrencia', 'user') );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AcaoExtensaoOcorrencia  $acaoExtensaoOcorrencia
     * @return \Illuminate\Http\Response
     */
    public function edit(AcaoExtensaoOcorrencia $acaoExtensaoOcorrencia)
    {
        if(App::environment('local')){
            $user = User::where('id', 1)->first();
        } else {
            $user = User::where('uid', Auth::user()->id)->first();
        }

        //restringindo usuario - somente coordenador
        if($acaoExtensaoOcorrencia->acao_extensao->user_id != $user->id){
            session()->flash('status', 'Apenas o Coordenador pode editar a Ocorrencia.');
            session()->flash('alert', 'danger');
            return redirect()->route('acao_extensao.show', ['acao_extensao' => $acaoExtensaoOcorrencia->acao_extensao->id]);
        }

        return view('acoes-extensao.ocorrencias.edit', compact('acaoExtensaoOcorrencia'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AcaoExtensaoOcorrencia  $acaoExtensaoOcorrencia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AcaoExtensaoOcorrencia $acaoExtensaoOcorrencia)
    {
        $this->validate($request, [
            'data_hora_inicio' => ['required','date'],
            'data_hora_fim' => ['required','date','after:data_hora_inicio'],
            'local' => ['required'],
            'fim_inscricoes' => ['required_unless:inicio_inscricoes,null']
        ]);

        $dados = $request->all();
        $ocorrenciaAtualizada = $acaoExtensaoOcorrencia->fill($dados)->update();

        if($ocorrenciaAtualizada){
            session()->flash('status', 'Ocorrência Atualizada');
            session()->flash('alert', 'success');
        } else{
            session()->flash('status', 'Erro ao atualizar Ocorrência.');
            session()->flash('alert', 'danger');
        }

        return redirect()->route('acao_extensao.ocorrencias.index', ['acao_extensao' => $acaoExtensaoOcorrencia->acao_extensao->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AcaoExtensaoOcorrencia  $acaoExtensaoOcorrencia
     * @return \Illuminate\Http\Response
     */
    public function destroy(AcaoExtensaoOcorrencia $acaoExtensaoOcorrencia)
    {
        $acao_extensao_id = $acaoExtensaoOcorrencia->acao_extensao->id;
        if($acaoExtensaoOcorrencia->delete()) {
            session()->flash('status', 'Ocorrencia removida com sucesso.');
            session()->flash('alert', 'success');

            return redirect()->route('acao_extensao.ocorrencias.index', ['acao_extensao' => $acao_extensao_id]);
        }
        else {
            session()->flash('status', 'Desculpe! Houve um erro ao remover a ocorrencia da ação.');
            session()->flash('alert', 'danger');

            return redirect()->back();
        }
    }

    public function encerrar(AcaoExtensaoOcorrencia $acaoExtensaoOcorrencia)
    {
        $acao_extensao_id = $acaoExtensaoOcorrencia->acao_extensao->id;
        $acaoExtensaoOcorrencia->status = 'Encerrado';
        if($acaoExtensaoOcorrencia->update()) {
            session()->flash('status', 'Ocorrencia encerrada com sucesso.');
            session()->flash('alert', 'success');

            return redirect()->route('acao_extensao.ocorrencias.index', ['acao_extensao' => $acao_extensao_id]);
        }
        else {
            session()->flash('status', 'Desculpe! Houve um erro ao encerrar a ocorrencia da ação.');
            session()->flash('alert', 'danger');

            return redirect()->back();
        }
    }
}
