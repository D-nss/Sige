<?php

namespace App\Services\Avaliacao;

use Illuminate\Http\Request;
use App\Services\AvaliacaoInterface;

use App\Models\AcaoExtensao;
use App\Models\AcaoCultural;
use App\Models\Cronograma;
use App\Models\ComissaoUser;
use App\Models\Inscricao;
use App\Models\EventoInscrito;
use App\Models\User;

class AvaliacaoDcult implements AvaliacaoInterface
{
    public function getAvaliacao(Request $request, Inscricao $inscricao, User $user) {}
    public function execute(Request $request, Inscricao $inscricao, User $user) {}
    public function update(Request $request, Inscricao $inscricao, User $user) {}
    public function executeAvaliacaoInscritoEvento(Request $request, EventoInscrito $inscrito, User $user) {}
    public function executeAvaliacaoConext(Request $request, AcaoExtensao $acao_extensao, User $user){}
    
    public function executeAvaliacaoDcult(Request $request, AcaoCultural $acao_cultural, User $user){
        $acao_cultural->aprovado_user_id = $user->id;
        $acao_cultural->status = 'Aprovado';
        if($acao_cultural->save()) {
            session()->flash('status', 'Ação de Cultura aprovada!');
            session()->flash('alert', 'success');

            return ["redirect" => "painel-cultura", 'status' => true];
        }
        else {
            session()->flash('status', 'Ação de Cultura aprovada!');
            session()->flash('alert', 'success');

            return ["redirect" => "painel-cultura", 'status' => false];
        }
    }
}