<?php

namespace App\Http\Controllers\AcoesExtensao;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Comissao;
use App\Models\ComissaoUser;
use App\Models\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ComissaoGraduacaoAcaoController extends Controller
{
     /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(App::environment('local')){
            $user = User::where('id', 2)->first();
        } else {
            $user = User::where('uid', Auth::user()->id)->first();
        }
        
        $transacao = DB::transaction(function() use ($request, $user){
            $comissao = Comissao::create(
                [
                    'nome' => $request->nome_comissao,
                    'atribuicao'    => "Graduação",
                    'edital_id'     => null,
                    'unidade_id'    => $user->unidade->id,
                    'evento_id'     => null,
                ]
            );

            if($comissao) {
                Log::channel('comissoes')->info('Usuario Nome: ' . Auth::user()->name . ' - Usuario ID: ' . Auth::user()->id . ' - Info: Comissao Graduação ID: '. $comissao->id .' criada com sucesso - Endereço IP: ' . $request->ip());
            }
            else{
                Log::channel('comissoes')->error('Usuario Nome: ' . Auth::user()->name . ' - Usuario ID: ' . Auth::user()->id . ' - Erro: Comissao Graduação NÃO criada - Endereço IP: ' . $request->ip());
            }

            foreach($request->membros as $membro) {

                $comissao_user = ComissaoUser::create([
                    'user_id' => $membro['id'],
                    'comissao_id' => $comissao->id,
                ]);

                if($comissao_user) {
                    Log::channel('comissoes')->info('Usuario Nome: ' . Auth::user()->name . ' - Usuario ID: ' . Auth::user()->id . ' - Info: Usuário ID: '. $membro['nome'] .' adicionado a comissao ID '.$membro['id'].' - Endereço IP: ' . $request->ip());
                    $comissao_user->user->notify(new \App\Notifications\ComissaoUserAdicionado($comissao_user));

                }
                else {
                    Log::channel('comissoes')->error('Usuario Nome: ' . Auth::user()->name . ' - Usuario ID: ' . Auth::user()->id . ' - Info: Usuário ID: '. $membro['nome'] .' não adicionado a comissao ID '.$membro['id'].' - Endereço IP: ' . $request->ip());
                 
                }
            }

        });

        if(is_null($transacao) || empty($transacao)) {
            $session = [
                'status' => 'Inscrição atualizada com sucesso.',
                'alert' => 'success'
            ];           
        }
        else {
            $session = [
                'status' => 'Desculpe! Houve erro ao criar a comissão',
                'alert' =>  'danger'
            ];
        }
        
        echo json_encode($session);
    }
}
