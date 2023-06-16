<?php

namespace App\Http\Controllers;

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
    public function index(Collection $acoes_extensao = null)
    {
        if(App::environment('local')){
            $user = User::where('id', 4)->first();
        } else {
            $user = User::where('email', Auth::user()->id)->first();
        }

        if(is_null($acoes_extensao)){
            $acoes_extensao = AcaoExtensao::all();
        }

        //populando formulário (filtro)
        $unidades = Unidade::all();
        $linhas_extensao = LinhaExtensao::all();
        $areas_tematicas = AreaTematica::all();
        $estados = Municipio::select('uf')->distinct('uf')->orderBy('uf')->get();

        $comissao = Comissao::where('atribuicao', 'Conext')->first();
        $userNaComissao = $user->comissoes->where('comissao_id', $comissao->id);

        if($userNaComissao) {
            $acoes_extensao = $acoes_extensao->where('status', 'Aprovado')->whereNull('avaliacao_conext_user_id')->whereNull('status_avaliacao_conext')->whereNotIn('user_id', $user->id);
        }
        else {
            $acoes_extensao = $acoes_extensao->where('unidade_id', $user->unidade->id)->whereNull('aprovado_user_id')->where('status', 'Pendente');
        }
        
        return view('acoes-extensao.index', [
            'acoes_extensao' => $acoes_extensao,
            'unidades' => $unidades,
            'linhas_extensao' => $linhas_extensao,
            'areas_tematicas' => $areas_tematicas,
            'estados' => $estados,
            'user'    => $user
        ]);
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
