<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App;

use App\Models\AcaoExtensaoCurricularizacao;
use App\Models\User;

class AcaoExtensaoCurricularizacaoParticipacaoController extends Controller
{
    public function index() 
    {
        if(App::environment('local')){
            $user = User::where('id', 2)->first();
        } else {
            $user = User::where('email', Auth::user()->id)->first();
        }

        $curricularizacoes = AcaoExtensaoCurricularizacao::join('acoes_extensao_ocorrencias', 'acoes_extensao_ocorrencias.id', 'acoes_extensao_curricularizacao.acao_extensao_ocorrencia_id')
                                                        ->join('acoes_extensao', 'acoes_extensao.id', 'acoes_extensao_ocorrencias.acao_extensao_id')                            
                                                        ->where('acoes_extensao_curricularizacao.user_id', $user->id)
                                                        ->get([
                                                            'acoes_extensao.titulo',
                                                            'acoes_extensao_ocorrencias.data_hora_inicio',
                                                            'acoes_extensao_ocorrencias.data_hora_fim',
                                                            'acoes_extensao_curricularizacao.status',
                                                            'acoes_extensao_curricularizacao.horas',
                                                        ]);

        return view('acoes-extensao.curricularizacao.participacoes', compact('curricularizacoes'));
    }
}
