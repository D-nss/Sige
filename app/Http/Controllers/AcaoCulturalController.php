<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use App\Models\AcaoCultural;
use App\Models\AcaoCulturalColaborador;
use App\Models\AcaoCulturalDataLocal;
use App\Models\AcaoCulturalParceiro;
use App\Models\Municipio;
use App\Models\TipoParceiro;
use App\Models\Unidade;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;

class AcaoCulturalController extends Controller
{
    public function dashboard(){

        return view('acoes-culturais.dashboard');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Collection $acoes_culturais = null)
    {
        if(is_null($acoes_culturais)){
            $acoes_culturais = AcaoCultural::all();
        }

        $unidades = Unidade::all();
        $estados = Municipio::select('uf')->distinct('uf')->orderBy('uf')->get();

        return view('acoes-culturais.index', [
            'acoes_culturais' => $acoes_culturais,
            'unidades' => $unidades,
            'estados' => $estados
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $unidades = Unidade::all();
        //$user = User::where('email', Auth::user()->id)->first();
        $estados = Municipio::select('uf')->distinct('uf')->orderBy('uf')->get();
        $lista_segmento_cultural = array("Arte, ciência e tecnologia","Artes da cena","Artes plásticas e visuais","Atividades socioculturais","Cinema","Jogos e desportos","Materiais impressos e literatura","Música","Natureza e meio-ambiente","Patrimônio","Rádio e televisão");
        $lista_publico_alvo = array('Alunos', 'Servidores técnico-administrativos', 'Docentes', 'Pesquisadores', 'Público externo à universidade');

        return view('acoes-culturais.create', [
            'estados' => $estados,
            'unidades' => $unidades,
            'lista_segmento_cultural' => $lista_segmento_cultural,
            'lista_publico_alvo' => $lista_publico_alvo
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::where('id', 1)->first();

        $dados = array('user_id' => $user->id);
        $dados['municipio_id'] = $request->cidade;
        $dados_form = $request->all();
        $dados_form['publico_alvo'] = implode(',', $dados_form['publico_alvo']);
        $dados = array_merge($dados_form, $dados);
        $dados['status'] = 'Pendente';
        $acaoCriada = AcaoCultural::create($dados);

        if($acaoCriada){
            session()->flash('status', 'Ação de Cultura adicionada com sucesso!');
            session()->flash('alert', 'success');
        } else {
            session()->flash('status', 'Erro ao adicionar a Ação de Extensão ao banco de dados.');
            session()->flash('alert', 'danger');
            return back();
        }

        return redirect()->route('acao_cultural.datas', ['acao_cultural' => $acaoCriada->id] );
    }

    public function datas(AcaoCultural $acaoCultural)
    {
        $datas_acao_cultural = AcaoCulturalDataLocal::where('acao_cultural_id', $acaoCultural->id)->orderBy('data')->get();
        return view('acoes-culturais.datas', [
            'acao_cultural' => $acaoCultural,
            'datas_acao_cultural'=> $datas_acao_cultural
        ]);
    }

    public function insereData(Request $request)
    {
        $dataCriada = AcaoCulturalDataLocal::create($request->all());

        if($dataCriada){
            session()->flash('status', 'Data adicionada com sucesso!');
            session()->flash('alert', 'success');
        } else {
            session()->flash('status', 'Erro ao adicionar data ao banco de dados.');
            session()->flash('alert', 'danger');
            return back();
        }

        $acaoCultural = AcaoCultural::where('id', $request->acao_cultural_id)->first();

        return $this->datas($acaoCultural);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AcaoCultural  $acaoCultural
     * @return \Illuminate\Http\Response
     */
    public function show(AcaoCultural $acaoCultural)
    {
        //$acaoCultural = AcaoCultural::where('id', 1)->first();
        $segmentos_culturais =  explode(',', $acaoCultural->segmento_cultural);
        $selecao_publico_alvo = explode(',', $acaoCultural->publico_alvo);
        return view('acoes-culturais.show', [
            'acao_cultural' => $acaoCultural,
            'segmentos_culturais' => $segmentos_culturais,
            'selecao_publico_alvo' => $selecao_publico_alvo
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AcaoCultural  $acaoCultural
     * @return \Illuminate\Http\Response
     */
    public function edit(AcaoCultural $acaoCultural)
    {
        $acaoLocal = Municipio::select('uf', 'nome_municipio')->where('id', $acaoCultural->municipio_id)->get();
        $unidades = Unidade::all();
        $estados = Municipio::select('uf')->distinct('uf')->orderBy('uf')->get();
        $lista_segmento_cultural = array("Arte, ciência e tecnologia","Artes da cena","Artes plásticas e visuais","Atividades socioculturais","Cinema","Jogos e desportos","Materiais impressos e literatura","Música","Natureza e meio-ambiente","Patrimônio","Rádio e televisão");
        $lista_publico_alvo = array('Alunos', 'Servidores técnico-administrativos', 'Docentes', 'Pesquisadores', 'Público externo à universidade');

        return view('acoes-culturais.edit', [
            'acao_cultural' => $acaoCultural,
            'acaoLocal' => $acaoLocal,
            'estados' => $estados,
            'unidades' => $unidades,
            'lista_segmento_cultural' => $lista_segmento_cultural,
            'lista_publico_alvo' => $lista_publico_alvo
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AcaoCultural  $acaoCultural
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AcaoCultural $acaoCultural)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AcaoCultural  $acaoCultural
     * @return \Illuminate\Http\Response
     */
    public function destroy(AcaoCultural $acaoCultural)
    {
        //
    }

    public function coordenador(AcaoCultural $acaoCultural)
    {
        $unidades = Unidade::where('id', '!=', $acaoCultural->unidade->id)->orderBy('sigla')->get();
        $unidades_envolvidas_acao_cultural = Unidade::select('unidades.*')
                                                    ->join('acoes_culturais_unidades', 'acoes_culturais_unidades.unidade_id', '=', 'unidades.id')
                                                    ->where('acoes_culturais_unidades.acao_cultural_id', $acaoCultural->id)
                                                    ->get();
        $lista_vinculo_coordenador = array('Aluno Graduação (Unicamp)', 'Aluno Pós-Graduação (Unicamp)', 'Docente (Unicamp)', 'Pesquisador (Unicamp)', 'Técnico-Administrativo (Unicamp)','Externo à universidade');

        return view('acoes-culturais.coordenador', [
            'acao_cultural' => $acaoCultural,
            'unidades_envolvidas_acao_cultural'=> $unidades_envolvidas_acao_cultural,
            'unidades' => $unidades,
            'lista_vinculo_coordenador' => $lista_vinculo_coordenador
        ]);
    }

    public function insereUnidade(Request $request)
    {
        $unidadeRelacionada =  DB::table('acoes_culturais_unidades')->insert([
            'acao_cultural_id' => $request->acao_cultural_id,
            'unidade_id' => $request->unidade_id
        ]);

        if($unidadeRelacionada){
            session()->flash('status', 'Unidade adicionada com sucesso!');
            session()->flash('alert', 'success');
        } else {
            session()->flash('status', 'Erro ao adicionar unidade ao banco de dados.');
            session()->flash('alert', 'danger');
            return back();
        }

        $acaoCultural = AcaoCultural::where('id', $request->acao_cultural_id)->first();

        return $this->coordenador($acaoCultural);
    }

    public function insereCoordenador(Request $request)
    {
        $acao_cultural = AcaoCultural::where('id', $request->acao_cultural_id)->first();
        $acao_cultural->nome_coordenador = $request->nome_coordenador;
        $acao_cultural->email_coordenador = $request->email_coordenador;
        $acao_cultural->vinculo_coordenador = $request->vinculo_coordenador;
        $acaoAtualizada = $acao_cultural->save();

        if($acaoAtualizada){
            session()->flash('status', 'Ação Cultural atualizada com sucesso!');
            session()->flash('alert', 'success');
        } else {
            session()->flash('status', 'Erro ao atualizar Ação Cultural ao banco de dados.');
            session()->flash('alert', 'danger');
            return back();
        }

        return $this->equipe($acao_cultural);
    }

    public function equipe(AcaoCultural $acaoCultural)
    {
        $colaboradores_acao_cultural = AcaoCulturalColaborador::where('acao_cultural_id', $acaoCultural->id)->orderBy('nome')->get();
        $lista_vinculo = array('Aluno Graduação (Unicamp)', 'Aluno Pós-Graduação (Unicamp)', 'Docente (Unicamp)', 'Pesquisador (Unicamp)', 'Técnico-Administrativo (Unicamp)','Externo à universidade');

        return view('acoes-culturais.equipe', [
            'acao_cultural' => $acaoCultural,
            'colaboradores_acao_cultural'=> $colaboradores_acao_cultural,
            'lista_vinculo' => $lista_vinculo
        ]);
    }

    public function insereColaborador(Request $request)
    {
        $colaboradorCriado = AcaoCulturalColaborador::create($request->all());

        if($colaboradorCriado){
            session()->flash('status', 'Colaborador(a) adicionado(a) com sucesso!');
            session()->flash('alert', 'success');
        } else {
            session()->flash('status', 'Erro ao adicionar colaborador(a) ao banco de dados.');
            session()->flash('alert', 'danger');
            return back();
        }

        $acaoCultural = AcaoCultural::where('id', $request->acao_cultural_id)->first();

        return $this->equipe($acaoCultural);
    }

    public function parceiros(AcaoCultural $acaoCultural)
    {
        $parceiros_acao_cultural = AcaoCulturalParceiro::where('acao_cultural_id', $acaoCultural->id)->orderBy('nome')->get();
        $lista_tipos = TipoParceiro::all();

        return view('acoes-culturais.parceiros', [
            'acao_cultural' => $acaoCultural,
            'parceiros_acao_cultural'=> $parceiros_acao_cultural,
            'lista_tipos' => $lista_tipos
        ]);
    }

    public function insereParceiro(Request $request)
    {
        $parceiroCriado = AcaoCulturalParceiro::create($request->all());

        if($parceiroCriado){
            session()->flash('status', 'Parceiro(a) adicionado(a) com sucesso!');
            session()->flash('alert', 'success');
        } else {
            session()->flash('status', 'Erro ao adicionar parceiro(a) ao banco de dados.');
            session()->flash('alert', 'danger');
            return back();
        }

        $acaoCultural = AcaoCultural::where('id', $request->acao_cultural_id)->first();

        return $this->parceiros($acaoCultural);
    }

    public function acoesPorUnidade(Unidade $unidade){
        $acoes_culturais = AcaoCultural::where('unidade_id', $unidade->id)->get();
        return $this->index($acoes_culturais);
    }



}
