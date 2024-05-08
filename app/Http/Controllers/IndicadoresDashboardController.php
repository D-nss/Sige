<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

use App\Models\IndicadorUnidade;
use App\Models\Unidade;
use App\Models\User;

class IndicadoresDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:indicadores-admin|admin|super')->except('buscarUnidadesNaoCadastradasPorAno');
    }

    public function index()
    {
        if(App::environment('local')){
            $user = User::where('id', 2)->first();
        } else {
            $user = User::where('uid', Auth::user()->id)->first();
        }

        if($user->hasAnyRole('indicadores-admin|admin|super' )) {
            $indicadoresUnidades = DB::table('indicadores_unidades')
                                    ->selectRaw('DISTINCT ano_base, COUNT(distinct unidade_id) as qtd_unidades')
                                    ->groupBy('ano_base')
                                    ->get();
            $unidades = Unidade::count('id');

            return view('indicadores.dashboard', compact('indicadoresUnidades', 'unidades'));
        }
        else {
            session()->flash('status', 'Desculpe! Acesso não autorizado');
            session()->flash('alert', 'warning');

            return redirect()->back();
        }
    }

    public function buscarUnidadesNaoCadastradasPorAno(Request $request)
    {
        $unidades = Unidade::whereNotIn('id', array_values(IndicadorUnidade::distinct('unidade_id')->where('ano_base', $request->ano)->get('unidade_id')->toArray()))->get();

        echo json_encode($unidades);
    }
}
