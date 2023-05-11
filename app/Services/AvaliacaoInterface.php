<?php
namespace App\Services;

use Illuminate\Http\Request;

use App\Models\AcaoExtensao;
use App\Models\AcaoCultural;
use App\Models\Inscricao;
use App\Models\User;
use App\Models\EventoInscrito;

interface AvaliacaoInterface {
    public function getAvaliacao(Request $request, Inscricao $inscricao, User $user);
    public function execute(Request $request, Inscricao $inscricao, User $user);
    public function executeAvaliacaoInscritoEvento(Request $request, EventoInscrito $inscrito, User $user);
    public function executeAvaliacaoConext(Request $request, AcaoExtensao $acao_extensao, User $user);
    public function executeAvaliacaoDcult(Request $request, AcaoCultural $acao_cultural, User $user);
    public function update(Request $request, Inscricao $inscricao, User $user);
}