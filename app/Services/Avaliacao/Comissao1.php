<?php

namespace App\Services\Avaliacao;

use Illuminate\Http\Request;
use App\Services\AvaliacaoInterface;

use App\Models\Cronograma;
use App\Models\ComissaoUser;
use App\Models\Inscricao;
use App\Models\User;

class Comissao1 implements AvaliacaoInterface
{
    public function getAvaliacao(Request $request, Inscricao $inscricao, User $user) 
    {
        $cronograma = new Cronograma();

        $userNaComissao = ComissaoUser::join('comissoes', 'comissoes.id', 'comissoes_users.comissao_id')
                                ->where('comissoes.edital_id', $inscricao->edital_id)
                                ->where('comissoes_users.user_id', $user->id)
                                ->first();
        
        if( !$userNaComissao || $user->hasAnyRole('admin','super') || $inscricao->user_id == $user->id ) {
            session()->flash('status', 'Acesso não autorizado para avaliação.');
            session()->flash('alert', 'warning');

            return false;
        }
        //analisa se esta fora do periodo de avaliação
        if( strtotime(date('Y-m-d')) < strtotime($cronograma->getDate('dt_comissao_1', $inscricao->edital_id)) || strtotime(date('Y-m-d')) > strtotime($cronograma->getDate('dt_comissao_1_termino', $inscricao->edital_id)) ) {
            session()->flash('status', 'Perído de avaliação ainda não foi aberto.');
            session()->flash('alert', 'warning');

            return false;
        }

        return ['comissao1' => true];
    }

    public function execute(Request $request, Inscricao $inscricao, User $user) 
    {

        if($inscricao->user_id == $user->id) {
            session()->flash('status', 'Desculpe! Não é permitido avaliar a própria inscrição');
            session()->flash('alert', 'danger');

            return ['redirect' => 'inscricao', 'status' => false];
        }

        //Aplica as especificidades da avaliação da comissão 1
        return ['message' => 'Avaliação da comissão 1'];
    }

    public function update(Request $request, Inscricao $inscricao, User $user) {}
}