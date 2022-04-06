<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UnidadeController;
use App\Http\Controllers\IndicadorUnidadeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Adicionar as rotas que necessitam de Autenticação
Route::group(['middleware' => 'keycloak-web'], function () {
    //Route::get('/teste', [UserController::class, 'teste']);
    Route::resource('/usuarios', UserController::class)->names('user')->parameters(['usuarios' => 'user']);
    Route::resource('/unidades', UnidadeController::class)->names('unidade')->parameters(['unidades' => 'unidade']);
    Route::put('/usuarios/{user}/ativar', [UserController::class, 'ativar'])->name('user.ativar');
    Route::put('/usuarios/{user}/desativar', [UserController::class, 'desativar'])->name('user.desativar');
    /* -------------- rotas idicadores ---------------- */
    Route::resource('/indicadores', IndicadorUnidadeController::class);

    /* -------------- rotas para views do sistema de editais ------*/
    Route::get('lista-editais', function(){
        return view('edital.index2');
    });
    
    Route::get('editais/novo', function(){
        return view('edital.create');
    });
    
    Route::get('editais/{id}/editar', function(){
        return view('edital.edit');
    });
    
    Route::get('/processo-editais', function(){
        return view('processo-edital.index');
    });
    
    Route::get('/processo-editais/{id}/editar', function(){
    $processo = 1;
    return view('processo-edital.edit', compact('processo'));
    });
    
    Route::get('/processo-editais/novo', function(){
        return view('processo-edital.create');
    });
    
    Route::get('/cronograma/novo', function(){
        return view('cronograma.create');
    });
    
    Route::get('/cronograma/{id}/editar', function(){
        return view('cronograma.edit');
    });
    
    Route::get('/conselheiros/novo', function(){
        return view('conselheiro.create');
    });
    
    Route::get('/questoes/novo', function(){
        return view('questoes.create');
    });
    
    Route::get('/proposta/novo', function(){
        return view('proposta.create');
    });
    
    Route::get('/proposta', function(){
        return view('proposta.index');
    });
    
    Route::get('/proposta/analise', function(){
        return view('proposta.analise');
    });
    
    Route::get('/proposta/parecer-final', function(){
        return view('proposta.parecer-final');
    });
    
    Route::get('/proposta/avaliacao', function(){
        return view('proposta.avaliacao');
    });
    
    Route::get('/proposta/classificacao', function(){
        return view('proposta.classificacao');
    });
    
    Route::get('/proposta/enviadas', function(){
        return view('proposta.enviadas');
    });
    
    Route::get('/orcamento/novo', function(){
        return view('orcamento.create');
    });
    
    Route::get('/campos/novo', function(){
        return view('campos.create');
    });
    
    Route::get('/areas-tematicas', function(){
        return view('areas-tematicas.index');
    });
    
});

/*
Route::get('/login',['as'=>'login','uses'=>'LoginController@index']);
Route::get('/login/sair',['as'=>'login.sair','uses'=>'LoginController@sair']);
Route::post('/login/entrar',['as'=>'login.entrar','uses'=>'LoginController@entrar']);
/*
Route::group(['middleware'=>'auth'], function(){
    Route::resource('editais', 'EditaisController');
    Route::resource('calendario', 'CalendarioController');
    Route::resource('acoes', 'AcoesController');
});*/

