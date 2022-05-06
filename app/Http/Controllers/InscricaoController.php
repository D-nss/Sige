<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Edital;
use App\Models\Inscricao;
use App\Models\InscricaoAreaTematica;
use App\Models\UploadFile;
use App\Models\Orcamento;
use App\Models\QuestaoRespondida;
use App\Models\LinhaExtensao;
use App\Models\User;
use App\Models\Municipio;
use App\Models\Cronograma;

class InscricaoController extends Controller
{
    public function __construct()
    {
        //$this->middleware('role:coordenador,super,admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::where('email', Auth::user()->id)->first();

        if( $user->hasRole('analista|avaliador|super|admin') ) {
            $inscricoes = Inscricao::all();

            $cronograma = new Cronograma();
            return view('inscricao.index', compact('inscricoes', 'user', 'cronograma'));
        }
        
        $inscricoes = Inscricao::where('user_id', $user->id)->get();

        return view('inscricao.enviadas', compact('inscricoes', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $user = User::where('email', Auth::user()->id)->first();

        $checaInscricaoExistente = Inscricao::where('edital_id', $id)->where('user_id', $user->id)->first();
        $checaInscricaoEmAberto = Inscricao::where('user_id', $user->id)->where('status', '<>', 'Concluido')->first();
        
        if(!!$checaInscricaoExistente && !!$checaInscricaoEmAberto){
            session()->flash('status', 'Desculpe! Você possui uma inscrição em aberto, ou ja possui uma inscrição para o edital!');
            session()->flash('alert', 'warning');

            return redirect()->back();
        }

        $edital = Edital::find($id);

        foreach($edital->cronogramas as $cronograma) {
            if($cronograma->dt_input == 'dt_inscricao' && strtotime(date('Y-m-d')) < strtotime($cronograma->data) ) {
                session()->flash('status', 'Desculpe! As inscrições ainda não estão abertas!');
                session()->flash('alert', 'warning');

                return redirect()->back();
            }
            
            if($cronograma->dt_input == 'dt_termino_inscricao' && strtotime(date('Y-m-d')) > strtotime($cronograma->data) ) {
                session()->flash('status', 'Desculpe! As inscrições já se encerraram!');
                session()->flash('alert', 'warning');

                return redirect()->back();
            }
        }

        $estados = Municipio::select('uf')->distinct('uf')->orderBy('uf')->get();
        
        $linhas_extensao = LinhaExtensao::all(); 

        return view('inscricao.create', compact('edital', 'linhas_extensao', 'estados'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputsParaValidar = $request->except(['estado', 'comprovante_parceria', 'link_lattes', 'link_projeto', 'palavras_chaves']);
        $validar = array();

        foreach($inputsParaValidar as $key => $inputs) {
            if($key == 'resumo') {
                $validar[$key] = 'required|max:1000';
            }
            elseif(substr($key, 0, 8) == 'questao-'){
                $validar[$key] = 'required|max:450';
            }
            else {
                $validar[$key] = 'required|max:190';
            }
        }

        $validated = $request->validate($validar);

        $user = User::where('email', Auth::user()->id)->first();

        $checaInscricaoExistente = Inscricao::where('edital_id', $request->edital_id)->where('user_id', $user->id)->first();
        $checaInscricaoEmAberto = Inscricao::where('user_id', $user->id)->where('status', '<>', 'Concluido')->first();
        
        if(!!$checaInscricaoExistente && !!$checaInscricaoEmAberto){
            session()->flash('status', 'Desculpe! Você possui uma inscrição em aberto, ou ja possui uma inscrição para o edital!');
            session()->flash('alert', 'warning');

            return redirect()->back();
        }
        
        $areasTematicasInsert = array();
        $respostasQuestoesInsert = array();
        $upload = new UploadFile();

        $inscricao = DB::transaction(function() use( $request, $areasTematicasInsert, $respostasQuestoesInsert, $upload, $user) {
            
            $inscricaoCriada = Inscricao::create([
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
                'status' => 'Submetido',
                'linha_extensao_id' => $request->linha_extensao,
                'user_id' => $user->id,
                'unidade_id' => $user->unidade->id,
                'edital_id' => $request->edital_id
            ]);

            foreach($request->areas_tematicas as $areas) {
                array_push($areasTematicasInsert,[
                    'area_tematica_id' => $areas, 
                    'inscricao_id' => $inscricaoCriada->id
                ]);
            }

            DB::table('inscricoes_areas_tematicas')->insert($areasTematicasInsert);

            foreach($request->all() as $key => $resposta) {
                if(substr($key, 0, 8) == 'questao-') {
                    array_push($respostasQuestoesInsert, [
                        'questao_id' => substr($key, 8, strlen($key)), 
                        'inscricao_id' => $inscricaoCriada->id, 
                        'resposta' => $resposta
                    ]);
                }
            }

            DB::table('questoes_respondidas')->insert($respostasQuestoesInsert);
            
            return $inscricaoCriada;
        });

        if(is_null($inscricao) || empty($inscricao)) {
            session()->flash('status', 'Desculpe! Houve erro ao enviar a inscrição');
            session()->flash('alert', 'danger');

            return redirect()->back();
        }
        else {
            session()->flash('status', 'Finalize sua inscrição incluindo os itens do orçamento.');
            session()->flash('alert', 'success');

            return redirect()->to("inscricao/$inscricao->id/orcamento");
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
        $edital = Edital::findOrFail($inscricao->edital_id);
        $cronograma = new Cronograma();

        if(isset($request->analise)) {
            //analisa se esta fora do periodo de analise
            if( strtotime(date('Y-m-d')) < strtotime($cronograma->getDate('dt_org_tematica', $inscricao->edital_id)) || strtotime(date('Y-m-d')) > strtotime($cronograma->getDate('dt_termino_org_tematica', $inscricao->edital_id)) ) {
                session()->flash('status', 'Perído de analise ainda não foi aberto.');
                session()->flash('alert', 'warning');

                return redirect()->back();
            }

            $analise = $request->analise;
            $criterios = $edital->criterios;
        }
        else {
            $analise = '';
        }

        if(isset($request->avaliacao)) { 
            //analisa se esta fora do periodo de avaliação
            if( strtotime(date('Y-m-d')) < strtotime($cronograma->getDate('dt_pareceristas', $inscricao->edital_id)) || strtotime(date('Y-m-d')) > strtotime($cronograma->getDate('dt_termino_pareceristas', $inscricao->edital_id)) ) {
                session()->flash('status', 'Perído de avaliação ainda não foi aberto.');
                session()->flash('alert', 'warning');

                return redirect()->back();
            }


            $avaliacao = $request->avaliacao;
            $questoesAvaliacao = $edital->questoes->filter(function($value, $key) {
                return data_get($value, 'tipo') == 'Avaliativa';
            }); 
        }
        else {
            $avaliacao = '';
            $questoesAvaliacao = '';
        }

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

        
        $criterios = $edital->criterios;

        $valorMaxPorInscricao = $edital->valor_max_inscricao;
        $totalItens = Orcamento::where('inscricao_id', $id)->sum('valor');
        $itensOrcamento = Orcamento::where('inscricao_id', $id)->get();

        // return view('inscricao.show', compact(
        //         'inscricao', 
        //         'inscricoesAreaTematica',
        //         'linhaextensao',
        //         'respostasQuestoes', 
        //         'itensOrcamento', 
        //         'totalItens', 
        //         'valorMaxPorInscricao', 
        //         'analise',
        //         'avaliacao',
        //         'questoesAvaliacao',
        //         'criterios'
        //     )
        // );
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
        $user = User::where('email', Auth::user()->id)->first();
        $dados = array();

        foreach( $request->except('_token') as $key => $value) {
            $questao_id = substr($key, 8, strlen($key));
            array_push($dados, array(
                'user_id'      => $user->id,
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
            return redirect()->to('inscricao');
        }
        else
        {
            session()->flash('status', 'Desculpe! Houve um problema ao enviar avaliação');
            session()->flash('alert', 'danger');
            return redirect()->back();
        }
    }


}
