<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\AvaliadorPorInscricao;
use App\Models\User;
use App\Models\Inscricao;
use App\Models\RespostasAvaliacoes;
use App\Models\Parecer;

use App\Services\Avaliacao\Comissao1;
use App\Services\Avaliacao\Parecerista;
use App\Services\Avaliacao\Subcomissao;

use App\Services\Avaliacao;

class AvaliacaoController extends Controller
{
         /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Inscricao $inscricao)
    {
        $user = User::where('email', Auth::user()->id)->first();

        $avaliadorSeExiste = AvaliadorPorInscricao::where('user_id', $user->id,)
                                                  ->where('inscricao_id', $inscricao->id)
                                                  ->first();

        // $questoesAvaliacao = $inscricao->edital->questoes->filter(function($value, $key) {
        //     return data_get($value, 'tipo') == 'Avaliativa';
        // });

        // $notasAvaliacao = RespostasAvaliacoes::select('questoes.enunciado', 'respostas_avaliacoes.valor', 'respostas_avaliacoes.questao_id')
        //                                         ->join('questoes', 'questoes.id', 'respostas_avaliacoes.questao_id')
        //                                         ->where('respostas_avaliacoes.inscricao_id', $inscricao->id)
        //                                         ->where('respostas_avaliacoes.user_id', $user->id)
        //                                         ->get();

        // $parecerAvaliacao = Parecer::select('users.name', 'pareceres.justificativa', 'pareceres.parecer', 'pareceres.user_id')
        //                            ->join('inscricoes', 'inscricoes.id', 'pareceres.inscricao_id')
        //                            ->join('users', 'users.id', 'pareceres.user_id')
        //                            ->where('inscricoes.id', $inscricao->id)
        //                            ->where('pareceres.user_id', $user->id)
        //                            ->get();

        echo json_encode($avaliadorSeExiste);
        // return view('inscricao.avaliacao', compact('inscricao', 'questoesAvaliacao', 'notasAvaliacao', 'parecerAvaliacao'));
    }

    /**
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Inscricao $inscricao
    * @return \Illuminate\Http\Response
    *
    */
    public function store(Request $request, Inscricao $inscricao)
    {
        $user = User::where('email', Auth::user()->id)->first();

        if(isset($request->tipo_avaliacao)) {
            $tipo_avaliacao = [
                'subcomissao' => new Subcomissao(),
                'parecerista' => new Parecerista(),
                'comissao1' => new Comissao1(),
            ];

            $avaliacao = new Avaliacao($tipo_avaliacao[$request->tipo_avaliacao]);

            $resposta = $avaliacao->execute($request, $inscricao, $user);

            unset($tipo_avaliacao);

            return redirect()->to($resposta['redirect']);
        }
    }

    /**
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Inscricao $inscricao
    * @return \Illuminate\Http\Response
    *
    */
    public function update(Request $request, Inscricao $inscricao)
    {
        $user = User::where('email', Auth::user()->id)->first();

        $parecerista = new Parecerista();

        $avaliacao = new Avaliacao($parecerista);

        $resposta = $avaliacao->update($request, $inscricao, $user);

        return redirect()->to($resposta['redirect']);

    }
}
