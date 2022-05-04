<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Municipio;

class MunicipioController extends Controller
{
    public function getMunicipiosByUf(Request $request)
    {
        if($request->ajax()) {
            $cidades = Municipio::select('id', 'nome_municipio')->where('uf', $request->get('uf'))->get()->toArray();

            echo json_encode($cidades);
        }
    }
}
