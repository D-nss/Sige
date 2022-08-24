<?php

namespace App\Services\Avaliacao;

use Illuminate\Http\Request;
use App\Services\AvaliacaoInterface;

use App\Models\Cronograma;
use App\Models\ComissaoUser;
use App\Models\Inscricao;
use App\Models\User;

class Subcomissao implements AvaliacaoInterface
{
    public function getAvaliacao(Request $request, Inscricao $inscricao, User $user) 
    {
        $cronograma = new Cronograma();

        $userNaComissao = ComissaoUser::join('comissoes', 'comissoes.id', 'comissoes_users.comissao_id')
                                ->where('comissoes.edital_id', $inscricao->edital_id)
                                ->where('comissoes_users.user_id', $user->id)
                                ->first();
        
        if(!$userNaComissao || $user->hasAnyRole('admin','super') || $inscricao->user_id == $user->id) {
            session()->flash('status', 'Acesso não autorizado para análise.');
            session()->flash('alert', 'warning');

            return ['analise' => false];
        }

        //analisa se esta fora do periodo de analise
        if( strtotime(date('Y-m-d')) < strtotime($cronograma->getDate('dt_org_tematica', $inscricao->edital_id)) || strtotime(date('Y-m-d')) > strtotime($cronograma->getDate('dt_termino_org_tematica', $inscricao->edital_id)) ) {
            session()->flash('status', 'Período de analise ainda não foi aberto.');
            session()->flash('alert', 'warning');

            return ['analise' => false];
        }

        return ['analise' => true];
    }

    public function execute(Request $request, Inscricao $inscricao, User $user) 
    {
        if($inscricao->user_id == $user->id) {
            session()->flash('status', 'Desculpe! Não é permitido a análise da própria inscrição');
            session()->flash('alert', 'danger');

            return ['redirect' => 'inscricao', 'status' => false];
        }

        $inscricao->status = $request->status;
        $inscricao->analista_user_id = $user->id;

        if( !is_null($request->criterios) ) {
            $justificativa = "Critérios não atendidos: \n";

            foreach($request->criterios as $criterio) {
                $justificativa .= $criterio . "; \n";
            }

            $justificativa .= " Justificativa: \n";
            $justificativa .= !is_null($request->justificativa) ? $request->justificativa  : '';

            $inscricao->justificativa = $justificativa;
        }
        else {
            $inscricao->justificativa = $request->justificativa ;
        }

        if($inscricao->update()) {
            session()->flash('status', 'Analise enviada com sucesso.');
            session()->flash('alert', 'success');

            return ["redirect" => "inscricao", 'status' => true];
        }
        else {
            session()->flash('status', 'Desculpe! Houve erro ao enviar a analise');
            session()->flash('alert', 'danger');

            return ["redirect" => "inscricao", 'status' => false];
        }
    }
}