<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UnidadeController;


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
    //
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

Route::resource('/usuarios', UserController::class)->names('user')->parameters(['usuarios' => 'user']);
Route::resource('/unidades', UnidadeController::class)->names('unidade')->parameters(['unidades' => 'unidade']);
