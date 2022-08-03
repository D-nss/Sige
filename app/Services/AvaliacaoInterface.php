<?php
namespace App\Services;

use Illuminate\Http\Request;

use App\Models\Inscricao;
use App\Models\User;

interface AvaliacaoInterface {
    public function getAvaliacao(Request $request, Inscricao $inscricao, User $user);
    public function execute(Request $request, Inscricao $inscricao, User $user);
}