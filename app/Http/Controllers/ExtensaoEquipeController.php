<?php

namespace App\Http\Controllers;

use App\Models\AcaoExtensao;
use App\Models\User;
use App\Models\AcaoExtensaoOcorrencia;
use App\Models\AcaoExtensaoOcorrenciaMembro;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\App;

class ExtensaoEquipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AcaoExtensaoOcorrencia $acaoExtensaoOcorrencia)
    {
        if(App::environment('local')){
            $user = User::where('id', 1)->first();
        } else {
            $user = User::where('email', Auth::user()->id)->first();
        }

        //restringindo usuario gerencia dos membros
        if($acaoExtensaoOcorrencia->acao_extensao->user_id != $user->id){
            session()->flash('status', 'Apenas o Coordenador da Ação pode gerenciar os membros.');
            session()->flash('alert', 'danger');
            return back();
        }

        $equipe = AcaoExtensaoOcorrenciaMembro::where('acao_extensao_ocorrencia_id', $acaoExtensaoOcorrencia->id)->get();
        return view('acoes-extensao.equipe.index', compact('acaoExtensaoOcorrencia', 'equipe'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(AcaoExtensaoOcorrencia $acaoExtensaoOcorrencia)
    {
        if(App::environment('local')){
            $user = User::where('id', 1)->first();
        } else {
            $user = User::where('email', Auth::user()->id)->first();
        }

        //restringindo usuario adicionar membros
        if($acaoExtensaoOcorrencia->acao_extensao->user_id != $user->id){
            session()->flash('status', 'Apenas o Coordenador da Ação pode adicionar membros.');
            session()->flash('alert', 'danger');
            return back();
        }

        $users = \App\Models\User::all();
        $lista_vinculo = array('Aluno Graduação (Unicamp)', 'Aluno Pós-Graduação (Unicamp)', 'Docente (Unicamp)', 'Pesquisador (Unicamp)', 'Técnico-Administrativo (Unicamp)','Externo à universidade');
        return view('acoes-extensao.equipe.create', compact('users', 'acaoExtensaoOcorrencia', 'lista_vinculo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, AcaoExtensaoOcorrencia $acaoExtensaoOcorrencia)
    {
        $this->validate($request, [
            'nome' => ['required'],
            'cpf' => ['required'],
            'email' => ['required'],
            'funcao' => ['required']
        ]);

        if(App::environment('local')){
            $user = User::where('id', 1)->first();
        } else {
            $user = User::where('email', Auth::user()->id)->first();
        }

        $dados = $request->all();
        $dados['acao_extensao_ocorrencia_id'] = $acaoExtensaoOcorrencia->id;

        $membroEquipeJaCadastrado = AcaoExtensaoOcorrenciaMembro::where('email', $dados['email'])->where('acao_extensao_ocorrencia_id', $acaoExtensaoOcorrencia->id)->first();

        if($membroEquipeJaCadastrado) {
            session()->flash('status', 'Membro de equipe de evento já cadastrado.');
            session()->flash('alert', 'warning');

            return redirect()->to('acoes-extensao-ocorrencia/' . $acaoExtensaoOcorrencia->id . '/equipe');
        }

        $ocorrenciaMembroCriado = AcaoExtensaoOcorrenciaMembro::create($dados);

        if($ocorrenciaMembroCriado){
            Log::channel('acao_extensao')->info('Usuario Nome: ' . $user->name . ' - Usuario ID: ' . $user->id . ' - Operação: Adição de Membro na Ocorrencia (Extensão) Ocorrencia ID: '. $acaoExtensaoOcorrencia->id . ') - Nome Membro: ' . $request->local . ' - Endereço IP: ' . $request->ip());
            session()->flash('status', 'Ocorrência adicionada com sucesso!');
            session()->flash('alert', 'success');
        } else {
            Log::channel('acao_extensao')->error('Usuario Nome: ' . $user->name . ' - Usuario ID: ' . $user->id . ' - Erro: Adição de Membro na Ocorrencia (Extensão) Ocorrencia ID: '. $acaoExtensaoOcorrencia->id . ') - Nome Membro: ' . $request->local . ' - Endereço IP: ' . $request->ip());
            session()->flash('status', 'Erro ao adicionar ocorrência ao banco de dados.');
            session()->flash('alert', 'danger');
            return back();
        }

        return redirect()->to('acoes-extensao-ocorrencia/' . $acaoExtensaoOcorrencia->id . '/equipe');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AcaoExtensaoOcorrenciaMembro  $acaoExtensaoOcorrenciaMembro
     * @return \Illuminate\Http\Response
     */
    public function show(AcaoExtensaoOcorrencia $acaoExtensaoOcorrencia, AcaoExtensaoOcorrenciaMembro $acaoExtensaoOcorrenciaMembro)
    {
        if(App::environment('local')){
            $user = User::where('id', 1)->first();
        } else {
            $user = User::where('email', Auth::user()->id)->first();
        }

        //restringindo usuario gerencia dos membros
        if($acaoExtensaoOcorrencia->acao_extensao->user_id != $user->id){
            session()->flash('status', 'Apenas o Coordenador da Ação pode visualizar detalhes dos membros.');
            session()->flash('alert', 'danger');
            return back();
        }

        return view('acoes-extensao.equipe.show', compact('acaoExtensaoOcorrencia','acaoExtensaoOcorrenciaMembro'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AcaoExtensaoOcorrenciaMembro  $acaoExtensaoOcorrenciaMembro
     * @return \Illuminate\Http\Response
     */
    public function edit(AcaoExtensaoOcorrencia $acaoExtensaoOcorrencia, AcaoExtensaoOcorrenciaMembro $acaoExtensaoOcorrenciaMembro)
    {
        if(App::environment('local')){
            $user = User::where('id', 1)->first();
        } else {
            $user = User::where('email', Auth::user()->id)->first();
        }

        //restringindo usuario gerencia dos membros
        if($acaoExtensaoOcorrencia->acao_extensao->user_id != $user->id){
            session()->flash('status', 'Apenas o Coordenador da Ação pode editar os membros.');
            session()->flash('alert', 'danger');
            return back();
        }

        $users = \App\Models\User::all();
        $lista_vinculo = array('Aluno Graduação (Unicamp)', 'Aluno Pós-Graduação (Unicamp)', 'Docente (Unicamp)', 'Pesquisador (Unicamp)', 'Técnico-Administrativo (Unicamp)','Externo à universidade');
        return view('acoes-extensao.equipe.edit', compact('users', 'lista_vinculo', 'acaoExtensaoOcorrencia', 'acaoExtensaoOcorrenciaMembro'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AcaoExtensaoOcorrenciaMembro  $acaoExtensaoOcorrenciaMembro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AcaoExtensaoOcorrencia $acaoExtensaoOcorrencia, AcaoExtensaoOcorrenciaMembro $acaoExtensaoOcorrenciaMembro)
    {
        $this->validate($request, [
            'nome' => ['required'],
            'cpf' => ['required'],
            'email' => ['required'],
            'funcao' => ['required']
        ]);

        $dados = $request->all();

        $membroOcorrenciaAtualizado = $acaoExtensaoOcorrenciaMembro->fill($dados)->update();

        if($membroOcorrenciaAtualizado){
            session()->flash('status', 'Membro Ocorrencia Atualizado');
            session()->flash('alert', 'success');
        } else{
            session()->flash('status', 'Erro ao atualizar Membro da Ocorrência.');
            session()->flash('alert', 'danger');
        }

        return redirect()->to('acoes-extensao-ocorrencia/' . $acaoExtensaoOcorrencia->id . '/equipe');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AcaoExtensaoOcorrenciaMembro  $acaoExtensaoOcorrenciaMembro
     * @return \Illuminate\Http\Response
     */
    public function destroy(AcaoExtensaoOcorrencia $acaoExtensaoOcorrencia, AcaoExtensaoOcorrenciaMembro $acaoExtensaoOcorrenciaMembro)
    {
        if($acaoExtensaoOcorrenciaMembro->delete()) {
            session()->flash('status', 'Membro da equipe do evento removido com sucesso.');
            session()->flash('alert', 'success');

            return redirect()->back();
        }
        else {
            session()->flash('status', 'Desculpe! Houve um erro ao remover o membro da equipe do evento.');
            session()->flash('alert', 'danger');

            return redirect()->back();
        }
    }
}
