<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Indicador;
use App\Models\Unidade;
use App\Models\ItemsPlanes;
use App\Models\IndicadorUnidade;
use App\Models\IndicadoresParametros;

class IndicadorUnidadeController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:indicadores-user|indicadores-admin|super');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //unidade do usuario logado
        $user = User::where('email', Auth::user()->id)->first();
        $indicadores  = IndicadorUnidade::where('unidade_id', $user->unidade->id)
        ->join('indicadores_parametros', 'indicadores_parametros.ano_base', 'indicadores_unidades.ano_base')
        ->distinct()
        ->orderBy('ano_base', 'desc')
        ->get(['indicadores_unidades.ano_base', 'indicadores_parametros.data_limite']);

        return view('indicadores.index', [
            'indicadores' => $indicadores,
            'unidade' => $user->unidade,
            'user' => $user
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $indicadores = Indicador::all()->toArray();
        $indicadoresSerializado = $this->serializarIndicadores($indicadores);
        $indicadoresParametros = IndicadoresParametros::first();

        //unidade do usuario logado
        $unidade  =  User::where('email', Auth::user()->id)->first()->unidade;

        $anos_base = IndicadoresParametros::distinct()->get(['ano_base']);

        return view('indicadores.create', [
            'indicadoresSerializado' => $indicadoresSerializado,
            'indicadoresParametros' => $indicadoresParametros,
            'unidade' => $unidade,
            'anos_base' => $anos_base,
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

        $dados = array();

        // Validação dos Indicadores
        $validate = array();

        foreach($request->input() as $key => $r){
            if($key == "ano_base") {
                $validate[$key] = 'min:4|max:4';
                continue;
            }

            $validate[$key] = 'max:50000|integer|min:0';

            if($key == '_token') {
                unset($validate[$key]);
            }
        }

        $this->validate($request, $validate);
        // Fim da Validação


        //id da unidade do usuario logado
        $unidade_id  = User::where('email', Auth::user()->id)->first()->unidade->id;

        $buscaAnoExistente = IndicadorUnidade::where('unidade_id', $unidade_id)->where('ano_base', $request->ano_base)->count();

        foreach($request->input() as $key => $r){
            if(substr($key, 9, strlen($key)) != ""){
                array_push($dados, array('indicador_id' => substr($key, 9, strlen($key)), 'valor' => $r, 'unidade_id' => $unidade_id, 'ano_base' => $request->ano_base));
            }
        }

        if(!!$buscaAnoExistente) {
            session()->flash('status', 'Desculpe! Ano base já cadastrado');
            session()->flash('alert', 'danger');
            return redirect()->back();
        }
        else {
            $indicadores_unidade = DB::table('indicadores_unidades')->insert($dados);
        }

        if($indicadores_unidade)
        {
            session()->flash('status', 'Indicadores cadastrados com sucesso!');
            session()->flash('alert', 'success');
            return redirect('/indicadores/' . $request->ano_base);
        }
        else
        {
            session()->flash('status', 'Desculpe! Houve um problema ao cadastrar indicadores');
            session()->flash('alert', 'danger');
            return redirect()->back();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($ano)
    {
        //unidade do usuario logado
        $unidade  =  User::where('email', Auth::user()->id)->first()->unidade;

        $indicardoresPorUnidade = Indicador::join('indicadores_unidades', 'indicadores.id', 'indicadores_unidades.indicador_id')
            ->where('indicadores_unidades.unidade_id', $unidade->id)
            ->where('indicadores_unidades.ano_base', $ano)
            ->get(['indicadores_unidades.indicador_id', 'indicadores.indicador', 'indicadores_unidades.valor', 'indicadores_unidades.ano_base']);

        return view('indicadores.show', [
            'indicardoresPorUnidade' => $indicardoresPorUnidade,
            'ano' => $ano,
            'unidade' => $unidade
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($ano)
    {
        //unidade do usuario logado
        $user  =  User::where('email', Auth::user()->id)->first();

        $indicadoresParametros = IndicadoresParametros::first();

        if( (strtotime(date('Y-m-d')) <= strtotime($indicadoresParametros->data_limite)) || $user->hasRole('indicadores-editar') ) {
            $indicadores = Indicador::join('indicadores_unidades', 'indicadores.id', 'indicadores_unidades.indicador_id')
            ->where('indicadores_unidades.unidade_id', $user->unidade->id)
            ->where('indicadores_unidades.ano_base', $ano)
            ->get();

            $indicadoresSerializado = $this->serializarIndicadores($indicadores);

            $edit = true;
            //echo json_encode($indicadoresSerializado);
            return view('indicadores.edit', [
                'indicadoresSerializado' => $indicadoresSerializado,
                'ano' => $ano,
                'edit' => $edit,
                'unidade' => $user->unidade
            ]);
        }
        else {
            session()->flash('status', 'Desculpe! Edição de indicadores não permitida');
            session()->flash('alert', 'warning');
            return redirect()->back();
        }

        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $ano)
    {
        $linhasAfetadas = array();

        //id da unidade esta fixo pegar a unidade do usuario logado
        foreach($request->input() as $key => $r){
            if(substr($key, 9, strlen($key)) != ""){
                $linha = DB::table('indicadores_unidades')->where('id', substr($key, 9, strlen($key)))->update([ 'valor' => $r ]);
                array_push($linhasAfetadas, $linha);
            }
        }

        if(!in_array(0, $linhasAfetadas))
        {
            session()->flash('status', 'Todos os indicadores foram atualizados com sucesso!');
            session()->flash('alert', 'success');
            return redirect('/indicadores/' . $request->ano_base );
        }
        else
        {
            if(count(array_unique($linhasAfetadas)) == 1)
            {
                session()->flash('status', 'Nenhum indicador foi atualizado.');
                session()->flash('alert', 'warning');
                return redirect('/indicadores/' . $request->ano_base );
            }
            else{
                session()->flash('status', 'Somente os indicadores alterados foram atualizados.');
                session()->flash('alert', 'warning');
                return redirect('/indicadores/' . $request->ano_base );
            }

        }
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

    public function serializarIndicadores($indicadores)
    {
        $indicadoresSerializado = array();

        foreach($indicadores as $indicador)
        {
            $next = next($indicadores);
            $nextItemPlanes = $next['item_planes'] ?? '';

            if($indicador['item_planes'] != $nextItemPlanes)
            {
                $itemPlanes = $indicador['item_planes'];

                $indicadoresSerializado[$itemPlanes] = array();
            }

        }

        foreach($indicadores as $indicador)
        {
            if(array_key_exists($itemPlanes, $indicadoresSerializado))
            {
                array_push($indicadoresSerializado[$indicador['item_planes']], $indicador);
            }
        }

        return $indicadoresSerializado;
    }

}
