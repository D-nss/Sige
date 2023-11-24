<?php

namespace App\Http\Controllers\AcoesExtensao;

use App\Http\Controllers\Controller;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\AcaoExtensao;
use App\Models\Unidade;
use App\Models\LinhaExtensao;
use App\Models\AreaTematica;
use App\Models\Municipio;
use App\Models\Comissao;

class AcaoExtensaoPendenciasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function porComissaoConext(Collection $acoes_extensao = null)
    {
        if(App::environment('local')){
            $user = User::where('id', 2)->first();
        } else {
            $user = User::where('email', Auth::user()->id)->first();
        }

        //populando formulário (filtro)
        $unidades = Unidade::all();
        $linhas_extensao = LinhaExtensao::all();
        $areas_tematicas = AreaTematica::all();
        $estados = Municipio::select('uf')->distinct('uf')->orderBy('uf')->get();

        $comissao = Comissao::where('atribuicao', 'Conext')->first();
        $userNaComissaoConext = $user->comissoes->where('comissao_id', $comissao->id);

        if($userNaComissaoConext->count() > 0) {
            $acoes_extensao = AcaoExtensao::all();
            $acoes_extensao = $acoes_extensao->where('status', 'Aprovado')->whereNull('avaliacao_conext_user_id')->whereNull('status_avaliacao_conext')->whereNotIn('user_id', $user->id);
        }
        else {
            $acoes_extensao = [];
        }
        
        return view('acoes-extensao.index', [
            'acoes_extensao' => $acoes_extensao,
            'unidades' => $unidades,
            'linhas_extensao' => $linhas_extensao,
            'areas_tematicas' => $areas_tematicas,
            'estados' => $estados,
            'user'    => $user,
            'userNaComissaoConext' => $userNaComissaoConext
        ]);
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function porComissaoUnidades()
    {
        if(App::environment('local')){
            $user = User::where('id', 4)->first();
        } else {
            $user = User::where('email', Auth::user()->id)->first();
        }

        //populando formulário (filtro)
        $unidades = Unidade::all();
        $linhas_extensao = LinhaExtensao::all();
        $areas_tematicas = AreaTematica::all();
        $estados = Municipio::select('uf')->distinct('uf')->orderBy('uf')->get();

        $userNaComissaoUnidades = Comissao::join('comissoes_users', 'comissoes.id','comissoes_users.comissao_id')
        ->whereNull('comissoes.edital_id')
        ->whereNull('comissoes.evento_id')
        ->where('comissoes.atribuicao', '<>', 'Conext' )
        ->where('comissoes_users.user_id', $user->id)
        ->get(['comissoes.unidade_id']);

        $unidadesWhereIn =[];
        foreach($userNaComissaoUnidades as $userNaComissaoUnidade) {
            array_push($unidadesWhereIn, $userNaComissaoUnidade->unidade_id);
        }
        
        if($userNaComissaoUnidades->count() > 0) {
            $acoes_extensao = AcaoExtensao::where('status', 'Pendente')->whereIn('unidade_id', $unidadesWhereIn)->get();
        }
        else {
            $acoes_extensao = [];
        }
       
        return view('acoes-extensao.index', [
            'acoes_extensao' => $acoes_extensao,
            'unidades' => $unidades,
            'linhas_extensao' => $linhas_extensao,
            'areas_tematicas' => $areas_tematicas,
            'estados' => $estados,
            'user'    => $user,
            '$userNaComissaoUnidades' => $userNaComissaoUnidades
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
}
