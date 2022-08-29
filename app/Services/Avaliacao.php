<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Services\AvaliacaoInterface;

use App\Models\Inscricao;
use App\Models\User;

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

    function update(Request $request, Inscricao $inscricao, User $user) {
        return $this->avaliacao->update($request, $inscricao, $user);
    }
}