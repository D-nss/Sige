<?php

namespace App\Services\Avaliacao;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\AvaliacaoInterface;

use App\Models\AcaoExtensao;
use App\Models\AcaoCultural;
use App\Models\Cronograma;
use App\Models\ComissaoUser;
use App\Models\Inscricao;
use App\Models\User;
use App\Models\AvaliadorPorInscricao;
use App\Models\RespostasAvaliacoes;
use App\Models\Parecer;
use App\Models\Questao;
use App\Models\EventoInscrito;

class Parecerista implements AvaliacaoInterface
{
    public function getAvaliacao(Request $request, Inscricao $inscricao, User $user)
    {
        $cronograma = new Cronograma();

        $avaliadorPorInscricao = AvaliadorPorInscricao::where('inscricao_id', $inscricao->id)
                                                        ->where('user_id', $user->id)
                                                        ->first();

        //analisa se esta no periodo de recurso e se tem recurso aberto
        if( strtotime(date('Y-m-d')) >= strtotime($cronograma->getDate('dt_recurso', $inscricao->edital_id)) && strtotime(date('Y-m-d')) <= strtotime($cronograma->getDate('dt_termino_recurso', $inscricao->edital_id)) && $inscricao->recurso ) {
            return ['parecerista' => true];
        }

        //analisa se esta fora do periodo de avaliação
        if( strtotime(date('Y-m-d')) < strtotime($cronograma->getDate('dt_pareceristas', $inscricao->edital_id)) || strtotime(date('Y-m-d')) > strtotime($cronograma->getDate('dt_termino_pareceristas', $inscricao->edital_id)) ) {
            session()->flash('status', 'Perído de avaliação ainda não foi aberto.');
            session()->flash('alert', 'warning');

            return false;
        }

        if($user->hasRole('edital-administrador')) {
            return ['parecerista' => true];
        }
        elseif(!$avaliadorPorInscricao || $inscricao->user_id == $user->id) {
            session()->flash('status', 'Acesso não autorizado para avaliação.');
            session()->flash('alert', 'warning');

            return false;
        }
        else {
            return ['parecerista' => true];
        }

    }

    public function execute(Request $request, Inscricao $inscricao, User $user)
    {
        if($inscricao->user_id == $user->id) {
            session()->flash('status', 'Desculpe! Não é permitido avaliar a própria inscrição');
            session()->flash('alert', 'danger');

            return ['redirect' => "edital/$inscricao->edital_id/inscricoes", 'status' => false];
        }

        $dados = array();

        $validar = array();

        foreach($request->except('_token', 'tipo_avaliacao') as $key => $r){
            if($key == 'parecer'){
                $validar[$key] = 'required|max:1000';
            }
            elseif($key == 'justificativa'){
                $validar[$key] = 'required|max:1000';
            }
            else {
                $validar[$key] = 'required';
            }
        }

        $questoesAvaliativasIds = Questao::where('edital_id', $inscricao->edital_id)->where('tipo', 'Avaliativa')->get('id');
        $mensagens = [];
        foreach($questoesAvaliativasIds as $questaoAvaliativaId) {
            $validar['questao-' . $questaoAvaliativaId['id']] = 'required';
            $mensagens['questao-' . $questaoAvaliativaId['id'] . '.required'] = 'Uma questão avaliativa não foi preenchida';
        }

        $validated = $request->validate($validar, $mensagens);
        // Fim da Validação

        foreach( $request->except('_token', 'tipo_avaliacao', 'justificativa', 'parecer') as $key => $value) {
            $questao_id = substr($key, 8, strlen($key));
            array_push($dados, array(
                'user_id'      => $user->id,
                'inscricao_id' => $inscricao->id,
                'questao_id'   => $questao_id,
                'valor'        => $value,
                'updated_at'   => date('Y-m-d H:i:s')
            ));
        }

        $transacao = DB::transaction(function () use ($dados, $inscricao, $user, $request) {
            DB::table('respostas_avaliacoes')->insert($dados);

            $parecer = Parecer::create([
                'inscricao_id' => $inscricao->id,
                'user_id'         => $user->id,
                'justificativa' => $request->justificativa,
                'parecer'      => $request->parecer
            ]);

            $inscricao->avaliador_user_id = $user->id;
            $inscricao->update();

            $qtdAvaliadorPorInscricao = AvaliadorPorInscricao::where('inscricao_id', $inscricao->id)->count('user_id');
            $qtdAvaliadorEmRespostaAvaliacao = RespostasAvaliacoes::where('inscricao_id', $inscricao->id)->distinct('user_id')->count('user_id');

            if($qtdAvaliadorPorInscricao === $qtdAvaliadorEmRespostaAvaliacao) {
                $inscricao->status = 'Avaliado';
                $inscricao->update();
            }
        });

        if( is_null($transacao) )
        {
            session()->flash('status', 'Avaliação cadastrada com sucesso!');
            session()->flash('alert', 'success');

            return ['redirect' => "edital/$inscricao->edital_id/inscricoes", 'status' => true];
        }
        else
        {
            session()->flash('status', 'Desculpe! Houve um problema ao enviar avaliação');
            session()->flash('alert', 'danger');

            return ['redirect' => "edital/$inscricao->edital_id/inscricoes", 'status' => false];
        }
    }

    public function update(Request $request, Inscricao $inscricao, User $user)
    {
        if($inscricao->user_id == $user->id) {
            session()->flash('status', 'Desculpe! Não é permitido avaliar a própria inscrição');
            session()->flash('alert', 'danger');

            return ['redirect' => 'inscricao', 'status' => false];
        }

        $dados = array();

        foreach($request->except('_token', 'tipo_avaliacao') as $key => $r){
            if($key == 'parecer'){
                $validar[$key] = 'required|max:1000';
            }
            elseif($key == 'justificativa'){
                $validar[$key] = 'required|max:1000';
            }
            else {
                $validar[$key] = 'required';
            }
        }

        $validated = $request->validate($validar);
        // Fim da Validação

        $transacao = DB::transaction(function () use ($dados, $inscricao, $user, $request) {
            foreach( $request->except('_token', 'tipo_avaliacao', 'justificativa', 'parecer') as $key => $value) {
                $questao_id = substr($key, 8, strlen($key));
                DB::table('respostas_avaliacoes')
                    ->where('user_id', $user->id)
                    ->where('inscricao_id', $inscricao->id)
                    ->where('questao_id', $questao_id)
                    ->update(['valor' => $value, 'updated_at' => date('Y-m-d H:i:s')]);
            }

            DB::table('pareceres')
                    ->where('user_id', $user->id)
                    ->where('inscricao_id', $inscricao->id)
                    ->update(['justificativa' => $request->justificativa, 'parecer' => $request->parecer]);

        });

        if( is_null($transacao) )
        {
            session()->flash('status', 'Avaliação atualizada com sucesso!');
            session()->flash('alert', 'success');

            return ['redirect' => 'inscricao', 'status' => true];
        }
        else
        {
            session()->flash('status', 'Desculpe! Houve um problema ao enviar atualizar');
            session()->flash('alert', 'danger');

            return ['redirect' => 'inscricao', 'status' => false];
        }
    }

    public function executeAvaliacaoInscritoEvento(Request $request, EventoInscrito $inscrito, User $user) {}
    public function executeAvaliacaoConext(Request $request, AcaoExtensao $acao_extensao, User $user){}
    public function executeAvaliacaoDcult(Request $request, AcaoCultural $acao_cultural, User $user) {}

}
