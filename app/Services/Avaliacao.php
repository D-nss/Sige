<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Services\AvaliacaoInterface;

use App\Models\AcaoExtensao;
use App\Models\AcaoCultural;
use App\Models\Inscricao;
use App\Models\User;
use App\Models\EventoInscrito;

class Avaliacao
{
    private $avaliacao;

    function __construct (AvaliacaoInterface $avaliacao){
        $this->avaliacao = $avaliacao;
    }

    function setAvaliacao (AvaliacaoInterface $avaliacao){
        $this->avaliacao = $avaliacao;
    }

    function getAvaliacao(Request $request, Inscricao $inscricao, User $user) {
        return $this->avaliacao->getAvaliacao($request, $inscricao, $user);
    }

    function execute(Request $request, Inscricao $inscricao, User $user) {
        return $this->avaliacao->execute($request, $inscricao, $user);
    }

    public function executeAvaliacaoInscritoEvento(Request $request, EventoInscrito $inscrito, User $user){
        return $this->avaliacao->executeAvaliacaoInscritoEvento($request, $inscrito, $user);
    }

    public function executeAvaliacaoConext(Request $request, AcaoExtensao $acao_extensao, User $user){
        return $this->avaliacao->executeAvaliacaoInscritoEvento($request, $inscrito, $user);
    }

    public function executeAvaliacaoDcult(Request $request, AcaoCultural $acao_cultural, User $user){
        return $this->avaliacao->executeAvaliacaoDcult($request, $inscrito, $user);
    }

    function update(Request $request, Inscricao $inscricao, User $user) {
        return $this->avaliacao->update($request, $inscricao, $user);
    }
}