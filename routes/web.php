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

