<?php

namespace App\Http\Controllers\AcoesExtensao;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

use App\Models\AcaoExtensao;
use App\Models\User;

use App\Services\Comissao\ChecaComissao;

class AcaoExtensaoComissaoGraduacaoController extends Controller
{
    public function index() {
        if(App::environment('local')){
            $user = User::where('id', 1)->first();
        } else {
            $user = User::where('email', Auth::user()->id)->first();
        }
        //Validar comissão de graduação
        if( !ChecaComissao::execute('unidade', $user->unidade_id, 'Graduação', $user->id) ) {
            return redirect()->back();
        }

        $acoes_extensao = AcaoExtensao::where('status', 'Aprovado')
                                    ->whereNotNull('vagas_curricularizacao')
                                    ->whereNull('comissao_graduacao_user_id')
                                    ->whereNull('parecer_comissao_graduacao')
                                    ->whereNull('status_comissao_graduacao')
                                    ->get();
        
        return view('acoes-extensao.graduacao.index', compact('acoes_extensao'));
    }

    public function store(Request $request, AcaoExtensao $acao_extensao)
    {
        if(App::environment('local')){
            $user = User::where('id', 1)->first();
        } else {
            $user = User::where('email', Auth::user()->id)->first();
        }
        //Validar comissão de graduação
        if( !ChecaComissao::execute('unidade', $user->unidade_id, 'Graduação', $user->id) ) {
            return redirect()->back();
        }

        $comite_graduacao = BuscaUsuariosComissaoGraduacao::execute($acao_extensao->unidade_id);

        $acao_extensao->comissao_graduacao_user_id = $user->id;
        $acao_extensao->status_comissao_graduacao = $request->status_comissao_graduacao;
        $acao_extensao->parecer_comissao_graduacao = $request->parecer_comissao_graduacao;
        if($acao_extensao->update()) {
            if( $request->status_comissao_graduacao == 'Sim') {
                Notification::send($acao_extensao->user, new \App\Notifications\AcaoExtensaoNotificacaoAceiteGraduacao($acao_extensao));
                Notification::send($comite_graduacao, new \App\Notifications\AcaoExtensaoNotificarComissaoUnidadeAceiteGraduacao($acao_extensao));
            }
            else {
                Notification::send($acao_extensao->user, new \App\Notifications\AcaoExtensaoNotificacaoNaoAceiteGraduacao($acao_extensao));
                Notification::send($comite_graduacao, new \App\Notifications\AcaoExtensaoNotificarComissaoUnidadeNaoAceiteGraduacao($acao_extensao));
            }

            session()->flash('status', 'Parecer de comissão de graduação cadastrado com sucesso');
            session()->flash('alert', 'success');

            return redirect()->back();
        }
        else {
            session()->flash('status', 'Desculpe! Houve um erro ao cadastrar parecer de comissão de graduação.');
            session()->flash('alert', 'danger');

            return redirect()->back();
        }
    }
}
