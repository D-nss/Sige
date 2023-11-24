<?php

namespace App\Http\Controllers\Editais;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Avaliador;
use App\Models\Edital;
use App\Models\Cronograma;

class ProcessoEditalController extends Controller
{
    public function __construct()
    {
        //$this->middleware('role:edital-administrador|super|admin');
    }

    public function index() {
        $editais = Edital::all();

        $cronograma = new Cronograma();

        return view('processo-edital.index', compact('editais', 'cronograma'));
    }

    public function edit($id){
        $edital = Edital::find($id);
        if($edital->valor_max_programa > 0) {
            $inscricoesProgramaTotal = $edital->inscricoes->where('tipo', 'Programa')->count();
            $val_prog_solic = $inscricoesProgramaTotal * $edital->valor_max_programa;
        }
        else {
            $val_prog_solic = 0;
        }

        $inscricoesProjetoTotal = $edital->inscricoes->where('tipo', 'Projeto')->count();
        $val_proj_solic = $inscricoesProjetoTotal * $edital->valor_max_inscricao;

        $cronogramas = Cronograma::join('modelo_cronograma', 'modelo_cronograma.dt_input', 'cronogramas.dt_input')
                                            ->distinct()
                                            ->where('edital_id', $id)
                                            ->get(['modelo_cronograma.dt_label', 'cronogramas.data'])
                                            ->toArray();

        $avaliadores = Avaliador::join('users', 'users.id', 'avaliadores.user_id')
                                ->where('avaliadores.edital_id', $id)
                                ->get(['avaliadores.id as avaliador_id', 'users.name', 'users.id', 'users.unidade_id']);

        $bg_array = ['success', 'danger', 'info', 'primary', 'warning'];

        return view('processo-edital.edit', compact('edital', 'cronogramas', 'avaliadores' ,'bg_array', 'val_proj_solic', 'val_prog_solic'));
    }
}
