<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\IndicadorUnidade;
use App\Models\Unidade;

class IndicadoresDashboardController extends Controller
{
    public function index()
    {
        $user = User::where('email', Auth::user()->id)->first();

        if($user->hasAnyRole('indicadores-administrador|admin|super' )) {
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
}
