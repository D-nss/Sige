<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Models\User;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['middleware' => ['keycloak-web']], function () {
    Route::get('login', function() {
        if(App::environment('local')){
            $user = User::where('id', 1)->first();
        } else {
            $user = User::where('uid', Auth::user()->id)->first();
        }

        return response()->json(['token' => $user->createToken('SIGE')->plainTextToken]);
    });
});

Route::middleware(['auth:sanctum'])->group(function() {
    Route::get('/indicadores', function (Request $request) {
        $indicadores = [];
        foreach(\App\Models\IndicadorUnidade::all() as $i) {
            $i->indicador[0]->setHidden(['created_at', 'updated_at']);
            $i->unidade->setHidden(['codigo', 'created_at', 'updated_at', 'subcomissao_tematica_id']);
            $dados = [
                "indicador" => $i->indicador[0],
                "indicador_unidade_id" => $i->id,
                "valor" => $i->valor,
                "ano_base" => $i->ano_base,
                "unidade" =>  $i->unidade,
                "updated_at" => $i->updated_at,
                "generated_at" => date('Y-m-d H:i:s'),
            ];
            array_push($indicadores, $dados);
        }
    
        return response()->json($indicadores);
        
    });
});



