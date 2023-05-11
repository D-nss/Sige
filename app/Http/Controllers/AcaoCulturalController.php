<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use App\Models\AcaoCultural;
use App\Models\AcaoCulturalColaborador;
use App\Models\AcaoCulturalDataLocal;
use App\Models\AcaoCulturalParceiro;
use App\Models\Arquivo;
use App\Models\ComissaoUser;
use App\Models\Municipio;
use App\Models\TipoParceiro;
use App\Models\Unidade;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\App;

use App\Services\Avaliacao\AvaliacaoDcult;


class AcaoCulturalController extends Controller
{
    public function dashboard()
    {
        if(App::environment('local')){
            $user = User::where('id', 1)->first();
        } else {
            $user = User::where('email', Auth::user()->id)->first();
        }

        $userNaComissao = ComissaoUser::join('comissoes', 'comissoes.id', 'comissoes_users.comissao_id')
                                        ->where('comissoes.unidade_id', 44) //checa se esta na comissao da unidade DCULT
                                        ->where('comissoes_users.user_id', $user->id)
                                        ->first();

        if($userNaComissao == null) {
            return $this->dashboardUsuario();
        }

        $unidade = Unidade::where('id', $user->unidade_id)->first();
        $acoes_cultural = AcaoCultural::where('status', 'Aprovado')->limit(3)->get();
        $pendentes = AcaoCultural::where('status', 'Pendente')->get();
        // $rascunhos = AcaoCultural::where('status', 'Rascunho')->get();
        
        $total = AcaoCultural::where('status', 'Aprovado')->count();
        // // $total_unidade = AcaoCultural::where('unidade_id', $unidade->id)->where('status', 'Aprovado')->count();
        // if(!$total == 0){
        //     $porcentagem_unidade = (int) ($total_unidade*100/$total);
        // } else{
        //     $porcentagem_unidade = 0;
        // }
        
        $total_cadastrados = AcaoCultural::count();
        $total_aprovados = AcaoCultural::where('status', 'Aprovado')->count();
        $total_pendentes = AcaoCultural::where('status', 'Pendente')->count();
        $total_desativados = AcaoCultural::where('status', 'Desativado')->count();
        
         return view('acoes-culturais.dashboard', [
             'unidade' => $unidade,
        //     'acoes_cultural_usuario' => $acoes_cultural_usuario,
             'acoes_cultural' => $acoes_cultural,
             'pendentes' => $pendentes,
        //     'rascunhos' => $rascunhos,
             'total' => $total,
        //     // 'total_unidade' => $total_unidade,
        //     'porcentagem_unidade' => $porcentagem_unidade,
             'total_cadastrados' => $total_cadastrados,
             'total_aprovados' => $total_aprovados,
             'total_pendentes' => $total_pendentes,
             'total_desativados' => $total_desativados,
             'userNaComissao' => $userNaComissao
         ]);
    }

    public function dashboardUsuario(){
        if(App::environment('local')){
            $user = User::where('id', 2)->first();
        } else {
            $user = User::where('email', Auth::user()->id)->first();
        }

        $acoes_cultural_usuario =  AcaoCultural::where('user_id', $user->id)->get();
        $unidade = Unidade::where('id', $user->unidade_id)->first();
        // $acoes_cultural = AcaoCultural::where('status', 'Aprovado')->limit(3)->get();
        $pendentes = AcaoCultural::where('user_id', $user->id)->where('status', 'Pendente')->get();
        // $rascunhos = AcaoCultural::where('status', 'Rascunho')->get();
        
        $total = AcaoCultural::where('status', 'Aprovado')->count();
        // $total_unidade = AcaoCultural::where('unidade_id', $unidade->id)->where('status', 'Aprovado')->count();
        // if(!$total == 0){
        //     $porcentagem_unidade = (int) ($total_unidade*100/$total);
        // } else{
        //     $porcentagem_unidade = 0;
        // }
        
        $total_cadastrados = AcaoCultural::where('user_id', $user->id)->count();
        $total_aprovados = AcaoCultural::where('user_id', $user->id)->where('status', 'Aprovado')->count();
        $total_pendentes = AcaoCultural::where('user_id', $user->id)->where('status', 'Pendente')->count();
        $total_desativados = AcaoCultural::where('user_id', $user->id)->where('status', 'Desativado')->count();
        //echo json_encode($total_desativados);
         return view('acoes-culturais.dashboard-usuario', [
             'unidade' => $unidade,
             'acoes_cultural_usuario' => $acoes_cultural_usuario,
        //   'acoes_cultural' => $acoes_cultural,
             'pendentes' => $pendentes,
        //     'rascunhos' => $rascunhos,
             'total' => $total,
        //     'total_unidade' => $total_unidade,
        //     'porcentagem_unidade' => $porcentagem_unidade,
             'total_cadastrados' => $total_cadastrados,
             'total_aprovados' => $total_aprovados,
             'total_pendentes' => $total_pendentes,
             'total_desativados' => $total_desativados
         ]);
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
        $lista_segmento_cultural = array("Arte, ciência e tecnologia","Artes da cena","Artes plásticas e visuais","Atividades socioculturais","Cinema","Jogos e desportos","Materiais impressos e literatura","Música","Natureza e meio-ambiente","Patrimônio","Rádio e televisão");

        return view('acoes-culturais.index', [
            'acoes_culturais' => $acoes_culturais,
            'unidades' => $unidades,
            'estados' => $estados,
            'lista_segmento_cultural' => $lista_segmento_cultural
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
        if(App::environment('local')){
            $user = User::where('id', 1)->first();
            $vinculo_coordenador = 'Teste Vinculo Coordenador';
        } else {
            $user = User::where('email', Auth::user()->id)->first();
            $vinculo_coordenador = Auth::user()->employeetype;
        }

        $validated = $request->validate([
            'titulo' => 'required',
            'gratuito' => 'required',
            'tipo_evento' => 'required',
            'resumo' => 'required|max:2500',
            'segmento_cultural' => 'required',
            'palavras_chaves' => 'required|max:250',
            'publico_alvo' => 'required',
            'unidade_id' => 'required',
            'cidade' => 'required',
        ]);

        $dados = array('user_id' => $user->id);
        $dados['nome_coordenador'] = $user->name;
        $dados['email_coordenador'] = $user->email;
        $dados['vinculo_coordenador'] = $vinculo_coordenador;

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
        $validated = $request->validate([
            'data' => 'required',
            'local' => 'required|max:190',
        ]);

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

    public function removeData($id){
        $acaoCulturalDataLocal = AcaoCulturalDataLocal::where('id', $id)->first();
        $acaoCultural = AcaoCultural::where('id', $acaoCulturalDataLocal->acao_cultural_id)->first();
        if($acaoCulturalDataLocal->delete()) {
            session()->flash('status', 'Data/local removido!');
            session()->flash('alert', 'success');

            return $this->datas($acaoCultural);
        }
        else {
            session()->flash('status', 'Data/local  não removido!');
            session()->flash('alert', 'danger');

            return $this->datas($acaoCultural);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AcaoCultural  $acaoCultural
     * @return \Illuminate\Http\Response
     */
    public function show(AcaoCultural $acaoCultural)
    {
        if(App::environment('local')){
            $user = User::where('id', 1)->first();
        } else {
            $user = User::where('email', Auth::user()->id)->first();
        }

        $userNaComissao = ComissaoUser::join('comissoes', 'comissoes.id', 'comissoes_users.comissao_id')
                                        ->where('comissoes.unidade_id', 44) //checa se esta na comissao da unidade DCULT
                                        ->where('comissoes_users.user_id', $user->id)
                                        ->first();
        //$acaoCultural = AcaoCultural::where('id', 1)->first();
        $segmentos_culturais =  explode(',', $acaoCultural->segmento_cultural);
        $selecao_publico_alvo = explode(',', $acaoCultural->publico_alvo);
        $datas_acao_cultural = AcaoCulturalDataLocal::where('acao_cultural_id', $acaoCultural->id)->orderBy('data')->get();
        $unidades_envolvidas_acao_cultural = Unidade::select('unidades.*')
                                                    ->join('acoes_culturais_unidades', 'acoes_culturais_unidades.unidade_id', '=', 'unidades.id')
                                                    ->where('acoes_culturais_unidades.acao_cultural_id', $acaoCultural->id)
                                                    ->get();
        $colaboradores_acao_cultural = AcaoCulturalColaborador::where('acao_cultural_id', $acaoCultural->id)->orderBy('nome')->get();
        $parceiros_acao_cultural = AcaoCulturalParceiro::where('acao_cultural_id', $acaoCultural->id)->orderBy('nome')->get();
        $arquivos = Arquivo::where('referencia_id', $acaoCultural->id)->where('modulo', 'acoes-culturais')->get(['id', 'nome_arquivo', 'url_arquivo']);

        if($acaoCultural->user_id == $user->id){
            $userCoordenadorAcao = $user;
        } else {
            $userCoordenadorAcao = false;
        }
        
        return view('acoes-culturais.show', [
            'acao_cultural' => $acaoCultural,
            'segmentos_culturais' => $segmentos_culturais,
            'selecao_publico_alvo' => $selecao_publico_alvo,
            'datas_acao_cultural' => $datas_acao_cultural,
            'unidades_envolvidas_acao_cultural' => $unidades_envolvidas_acao_cultural,
            'colaboradores_acao_cultural' => $colaboradores_acao_cultural,
            'parceiros_acao_cultural' => $parceiros_acao_cultural,
            'arquivos' => $arquivos,
            'userCoordenadorAcao' => $userCoordenadorAcao,
            'userNaComissao' => $userNaComissao
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

    public function removeUnidade($id)
    {
        $unidadeRelacionada = DB::table('acoes_culturais_unidades')->where('id', $id)->first();
        $acaoCultural = AcaoCultural::where('id', $unidadeRelacionada->acao_cultural_id)->first();

        if($unidadeRelacionada->delete()) {
            session()->flash('status', 'Unidade relacionada removida!');
            session()->flash('alert', 'success');

            return $this->datas($acaoCultural);
        }
        else {
            session()->flash('status', 'Unidade relacionada não removida!');
            session()->flash('alert', 'danger');

            return $this->datas($acaoCultural);
        }
    }

    public function insereCoordenador(Request $request)
    {
        $validated = $request->validate([
            'nome_coordenador' => 'required|max:250',
            'email_coordenador' => 'required|max:250',
            'vinculo_coordenador' => 'required|max:250',
        ]);

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
        $validated = $request->validate([
            'nome' => 'required|max:250',
            'email' => 'required|max:250',
            'cpf' => 'required|max:20',
            'vinculo' => 'required|max:250',
        ]);

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
        $validated = $request->validate([
            'nome' => 'required|max:250',
            'tipo_parceiro_id' => 'required',
        ]);
        
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

    public function filtrar(Request $request){
        $filtro = array();
        if($request->nome_coordenador){
            array_push($filtro, ['nome_coordenador', 'like', "%{$request->nome_coordenador}%"]);
        }
        if($request->unidade_id){
            array_push($filtro, ['unidade_id', $request->unidade_id]);
        }
        if($request->segmento_cultural){
            array_push($filtro, ['segmento_cultural', 'like', "%{$request->segmento_cultural}%"]);
        }
        if($request->tipo_evento){
            array_push($filtro, ['tipo_evento', $request->tipo_evento]);
        }
        if($request->palavra_chave){
            array_push($filtro, ['palavras_chaves', $request->palavra_chave]);
        }
        if($request->cidade){
            array_push($filtro, ['municipio_id', $request->cidade]);
        }
        array_push($filtro, ['status', 'Aprovado']);
        $acoes_culturais = AcaoCultural::where($filtro)->get(['acoes_culturais.*']);

        return $this->index($acoes_culturais);
    }

    public function filtrarMapa(Request $request){
        $filtro = array();
        if($request->nome_coordenador){
            array_push($filtro, ['nome_coordenador', 'like', "%{$request->nome_coordenador}%"]);
        }
        if($request->unidade_id){
            array_push($filtro, ['unidade_id', $request->unidade_id]);
        }
        if($request->segmento_cultural){
            array_push($filtro, ['segmento_cultural', 'like', "%{$request->segmento_cultural}%"]);
        }
        if($request->tipo_evento){
            array_push($filtro, ['tipo_evento', $request->tipo_evento]);
        }
        if($request->palavra_chave){
            array_push($filtro, ['palavras_chaves', $request->palavra_chave]);
        }
        if($request->cidade){
            array_push($filtro, ['municipio_id', $request->cidade]);
        }
        //array_push($filtro, ['georreferenciacao', '<>', '']);
        array_push($filtro, ['status', 'Aprovado']);
        $acoes_culturais = AcaoCultural::where($filtro)->get(['acoes_culturais.*']);

        return $this->mapaCultura($acoes_culturais);
    }

    public function mapaCultura(Collection $acoes_cultural = null){
        $marcadores = array();

        if(is_null($acoes_cultural)){
            $acoes_cultural = AcaoCultural::all();
        }

        /*foreach ($acoes_extensao as $acao){
            $campos = explode(',', $acao->georreferenciacao);
            if (count($campos) == 3){
                $marcador = array();
                $marcador['lat'] = $campos[1];
                $marcador['long'] = $campos[2];
                $link_acao = '/acoes-extensao/'.$acao->id;
                $marcador['info'] = '<a href=' . $link_acao . '>' . $acao->titulo . '<br>' . 'Local: '. $campos[0] . '</a>';
                array_push($marcadores, $marcador);
            }
        }*/

        //Adicionando marcadores pela cidade - teste
        foreach ($acoes_cultural as $acao){
                $marcador = array();
                $marcador['lat'] = $acao->municipio->latitude;
                $marcador['long'] = $acao->municipio->longitude;
                $link_acao = '/acoes-culturais/'.$acao->id;
                $marcador['info'] = '<a href=' . $link_acao . '>' . $acao->titulo . '<br>' . 'Local: '. $acao->municipio->nome_municipio . '</a>';
                array_push($marcadores, $marcador);
        }
        $unidades = Unidade::all();
        $estados = Municipio::select('uf')->distinct('uf')->orderBy('uf')->get();
        $lista_segmento_cultural = array("Arte, ciência e tecnologia","Artes da cena","Artes plásticas e visuais","Atividades socioculturais","Cinema","Jogos e desportos","Materiais impressos e literatura","Música","Natureza e meio-ambiente","Patrimônio","Rádio e televisão");

        return view('acoes-culturais.mapa', [
            'acoes_cultural' => $acoes_cultural,
            'unidades' => $unidades,
            'estados' => $estados,
            'marcadores' => $marcadores,
            'lista_segmento_cultural' => $lista_segmento_cultural
        ]);
    }

    public function aprovar(Request $request, AcaoCultural $acaoCultural){

        if(App::environment('local')){
            $user = User::where('id', 1)->first();
        } else {
            $user = User::where('email', Auth::user()->id)->first();
        }

        $avaliacaoDcult = new AvaliacaoDcult();
        $resposta = $avaliacaoDcult->executeAvaliacaoDcult($request, $acaoCultural, $user);
        Log::channel('acao_extensao')->info('Usuario Nome: ' . $user->name . ' - Usuario ID: ' . $user->id . ' - Operação: Aprovação da Ação de Cultura ('. $acaoCultural->id . ')' );
        
        if($resposta['status']) {
            $acaoCultural->user->notify(new \App\Notifications\AcaoCulturalAprovada($acaoCultural));
        }

        return redirect()->to($resposta['redirect']);
    }

}
