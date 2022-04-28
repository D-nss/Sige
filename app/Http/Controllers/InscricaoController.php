<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Edital;
use App\Models\Inscricao;
use App\Models\InscricaoAreaTematica;
use App\Models\UploadFile;
use App\Models\Orcamento;
use App\Models\QuestaoRespondida;
use App\Models\LinhaExtensao;

class InscricaoController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:coordenador');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inscricoes = Inscricao::where('user_id', 2)->get();
        
        return view('inscricao.enviadas', compact('inscricoes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $edital = Edital::find($id);
        return view('inscricao.create', compact('edital'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    //     $inputsParaValidar = $request->except(['_token', 'estado', 'comprovante_parceria', 'link_lattes', 'link_projeto', 'palavras_chaves']);
    //     $validar = array();

    //     foreach($inputsParaValidar as $key => $inputs) {
    //         $validar[$key] = 'required';
    //     }

    //    $validated = $request->validate($validar);

        $checaInscricaoExistente = Inscricao::where('edital_id', $request->edital_id)->where('user_id', 2)->first();
        $checaInscricaoEmAberto = Inscricao::where('user_id', 2)->where('status', '<>', 'Concluido')->first();
        
        if(!!$checaInscricaoExistente && !!$checaInscricaoEmAberto){
            session()->flash('status', 'Desculpe! Você possui uma inscrição em aberto, ou ja possui uma inscrição para o edital!');
            session()->flash('alert', 'warning');

            return redirect()->back();
        }
        else {
            $areasTematicasInsert = array();
            $respostasQuestoesInsert = array();
            $upload = new UploadFile();
            $inscricao = '';

            $exception = DB::transaction(function() use( $request, $areasTematicasInsert, $respostasQuestoesInsert, $upload, $inscricao) {
                
                $inscricao = Inscricao::create([
                    'titulo' => $request->titulo,
                    'tipo' => $request->tipo_extensao,
                    'municipio_id' => $request->cidade,
                    'resumo' => $request->resumo,
                    'palavras_chaves' => $request->palavras_chaves,
                    'parceria' => $request->parceria,
                    'anexo_parceria' => !!$request->comprovante_parceria ? $upload->execute($request, 'comprovante_parceria', 'pdf', 3000000) : '',
                    'anexo_projeto' => $upload->execute($request, 'pdf_projeto', 'pdf', 3000000),
                    'url_projeto' => $request->link_projeto,
                    'url_lattes' => $request->link_lattes,
                    'status' => 'Pendente',
                    'linha_extensao_id' => $request->linha_extensao,
                    'user_id' => 2,
                    'unidade_id' => 42,
                    'edital_id' => $request->edital_id
                ]);

                foreach($request->areas_tematicas as $areas) {
                    array_push($areasTematicasInsert,[
                        'area_tematica_id' => $areas, 
                        'inscricao_id' => $inscricao->id
                    ]);
                }

                DB::table('inscricoes_areas_tematicas')->insert($areasTematicasInsert);

                foreach($request->all() as $key => $resposta) {
                    if(substr($key, 0, 8) == 'questao-') {
                        array_push($respostasQuestoesInsert, [
                            'questao_id' => substr($key, 8, strlen($key)), 
                            'inscricao_id' => $inscricao->id, 
                            'resposta' => $resposta
                        ]);
                    }
                }

                DB::table('questoes_respondidas')->insert($respostasQuestoesInsert);
                
            });

            if(is_null($exception)) {
                session()->flash('status', 'Finalize sua inscrição incluindo os itens do orçamento.');
                session()->flash('alert', 'success');

                return redirect()->to("inscricao/$inscricao->id/orcamento");
            }
            else {
                session()->flash('status', 'Desculpe! Houve erro ao enviar a inscrição');
                session()->flash('alert', 'danger');

                return redirect()->back();
            }
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $inscricao = Inscricao::findOrFail($id);

        $linhaextensao = LinhaExtensao::findOrFail($inscricao->linha_extensao_id);
        
        $inscricoesAreaTematica = InscricaoAreaTematica::join(
            'areas_tematicas', 'areas_tematicas.id',
            'inscricoes_areas_tematicas.area_tematica_id'
            )->where('inscricao_id',$id)
            ->get();

        $respostasQuestoes = QuestaoRespondida::join(
            'questoes', 'questoes_respondidas.questao_id', 
            'questoes.id'
            )->where('questoes_respondidas.inscricao_id', $id)
            ->get();

        $edital = Edital::findOrFail($inscricao->edital_id);

        if(isset($request->analise)) {
            $analise = $request->analise;
            $criterios = $edital->criterios;
        }
        else {
            $analise = '';
            $criterios = '';
        }

        if(isset($request->avaliacao)) {
            $avaliacao = $request->avaliacao;
            $questoesAvaliacao = $edital->questoes->filter(function($value, $key) {
                return data_get($value, 'tipo') == 'Avaliativa';
            });

            $criterios = $edital->criterios;
        }
        else {
            $avaliacao = '';
            $criterios = '';
            $questoesAvaliacao = '';
        }

        $valorMaxPorInscricao = $edital->valor_max_inscricao;
        $totalItens = Orcamento::where('inscricao_id', $id)->sum('valor');
        $itensOrcamento = Orcamento::where('inscricao_id', $id)->get();
        
        return view('inscricao.show', compact(
                'inscricao', 
                'inscricoesAreaTematica',
                'linhaextensao',
                'respostasQuestoes', 
                'itensOrcamento', 
                'totalItens', 
                'valorMaxPorInscricao', 
                'analise',
                'avaliacao',
                'questoesAvaliacao',
                'criterios'
            )
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function analise(Request $request, $id)
    {
        $inscricao = Inscricao::findOrFail($id);
        $inscricao->status = $request->status;
       
        if( !is_null($request->criterios) ) {
            $justificativa = "Critérios não atendidos: \n";

            foreach($request->criterios as $criterio) {
                $justificativa .= $criterio . "\n";
            }
    
            $justificativa .= "\nJustificativa: \n" . !is_null($request->justificativa) ? $request->justificativa  : '';
    
            $inscricao->justificativa = $justificativa;
        }
        
        if($inscricao->update()) {
            session()->flash('status', 'Analise enviada com sucesso.');
            session()->flash('alert', 'success');

            return redirect()->to("inscricao/$inscricao->id");
        }
        else {
            session()->flash('status', 'Desculpe! Houve erro ao enviar a analise');
            session()->flash('alert', 'danger');

            return redirect()->back();
        }

    }

    public function avaliacao(Request $request, $id) 
    {
        $dados = array();

        foreach( $request->except('_token') as $key => $value) {
            $questao_id = substr($key, 8, strlen($key));
            array_push($dados, array(
                'user_id'      => 2,
                'inscricao_id' => $id,
                'questao_id'   => $questao_id,
                'valor'        => $value
            ));
        }

        $transacao = DB::transaction(function () use ($dados, $id) {
            DB::table('respostas_avaliacoes')->insert($dados);

            $inscricao = Inscricao::findOrFail($id);
            $inscricao->status = 'Avaliado';
            $inscricao->update();
        });

        if( is_null($transacao) )
        {
            session()->flash('status', 'Avaliação cadastrada com sucesso!');
            session()->flash('alert', 'success');
            return redirect()->to('/inscricoes-para-analise');
        }
        else
        {
            session()->flash('status', 'Desculpe! Houve um problema ao enviar avaliação');
            session()->flash('alert', 'danger');
            return redirect()->back();
        }
    }

    public function listagemParaAnalise()
    {
        return view('inscricao.index');
    }

}
