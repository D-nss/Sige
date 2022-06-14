<?php

use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UnidadeController;
use App\Http\Controllers\IndicadorUnidadeController;
use App\Http\Controllers\AvaliadorController;
use App\Http\Controllers\CriterioController;
use App\Http\Controllers\CronogramaController;
use App\Http\Controllers\EditalController;
use App\Http\Controllers\QuestaoController;
use App\Http\Controllers\InscricaoController;
use App\Http\Controllers\OrcamentoController;
use App\Http\Controllers\SubcomissaoTematicaController;
use App\Http\Controllers\AreaTematicaController;
use App\Http\Controllers\MunicipioController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\AvaliadorPorInscricaoController;
use App\Http\Controllers\IndicadoresParametrosController;

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
    $editais = \App\Models\Edital::where('status', 'Divulgação')->get(['id', 'titulo', 'anexo_edital']);
    return view('welcome', compact('editais'));
});

Route::group(['middleware' => ['keycloak-web', 'check_is_user']], function () {
    Route::get('/teste', [UserController::class, 'teste']);
});

Route::get('get-municipios-by-uf', [MunicipioController::class, 'getMunicipiosByUf']);

// Adicionar as rotas que necessitam de Autenticação
Route::group(['middleware' => ['keycloak-web','check_is_user']], function () {
    //Route::get('/teste', [UserController::class, 'teste']);
    Route::get('home', function () {
        return view('home');
    });

    //Usuarios
    Route::resource('/usuarios', UserController::class)->names('user')->parameters(['usuarios' => 'user']);
    Route::put('/usuarios/{user}/ativar', [UserController::class, 'ativar'])->name('user.ativar');
    Route::put('/usuarios/{user}/desativar', [UserController::class, 'desativar'])->name('user.desativar');

    //Papeis e Permissões
    Route::resource('/roles', RoleController::class);
    Route::post('/roles/{role}/permissions', [RoleController::class, 'givePermission'])->name('roles.permissions');
    Route::delete('/roles/{role}/permissions/{permission}', [RoleController::class, 'revokePermission'])->name('roles.permissions.revoke');

    Route::resource('/permissions', PermissionController::class);
    Route::post('/permissions/{permission}/roles', [PermissionController::class, 'assignRole'])->name('permissions.roles');
    Route::delete('/permissions/{permission}/roles/{role}', [PermissionController::class, 'removeRole'])->name('permissions.roles.remove');

    //Usuarios - Papeis/Permissões
    Route::post('/usuarios/{user}/roles', [UserController::class, 'assignRole'])->name('user.roles');
    Route::delete('/usuarios/{user}/roles/{role}', [UserController::class, 'removeRole'])->name('user.roles.remove');
    Route::post('/usuarios/{user}/permissions', [UserController::class, 'givePermission'])->name('user.permissions');
    Route::delete('/usuarios/{user}/permissions/{permission}', [UserController::class, 'revokePermission'])->name('user.permissions.revoke');

    //Unidades
    Route::resource('/unidades', UnidadeController::class)->names('unidade')->parameters(['unidades' => 'unidade']);

    /* -------------- rotas idicadores ---------------- */
    Route::resource('/indicadores', IndicadorUnidadeController::class);
    Route::resource('/indicadores-parametros', IndicadoresParametrosController::class);

    /* -------------- rotas editais ---------------- */
    Route::resource('/editais', EditalController::class);
    Route::get('editais', [EditalController::class, 'index']);
    Route::post('edital/{id}/divulgar', [EditalController::class, 'divulgar']);

    Route::get('/editais/{edital}/criterios', [EditalController::class, 'editarCriterios']);
    Route::resource('/criterios', CriterioController::class);

    Route::resource('/cronogramas', CronogramaController::class);
    Route::get('/editais/{edital}/cronograma', [EditalController::class, 'editarCronograma']);
    Route::post('/cronograma/prorrogar', [CronogramaController::class, 'prorrogar']);

    Route::resource('/questoes', QuestaoController::class);
    Route::get('/editais/{edital}/questoes', [EditalController::class, 'editarQuestoes']);

    Route::resource('/avaliadores', AvaliadorController::class);
    Route::get('/editais/{edital}/avaliadores', [EditalController::class, 'editarAvaliadores']);
    Route::get('get-avaliador-by-subcomissao', [AvaliadorController::class, 'getAvaliadorBySubcomissao']);

    Route::resource('/inscricao', InscricaoController::class);
    Route::get('/inscricao/{id}/novo', [InscricaoController::class, 'create']);
    Route::post('/inscricao/{id}/analise', [InscricaoController::class, 'analise']);
    Route::post('/inscricao/{id}/avaliacao', [InscricaoController::class, 'avaliacao']);
    Route::get('/inscricao/{id}/avaliadores', [InscricaoController::class, 'indicarAvaliador']);
    Route::post('/inscricao/{id}/submeter', [InscricaoController::class, 'submeter']);
    Route::get('inscricoes-enviadas', [InscricaoController::class, 'inscricoesPorUsuario']);

    Route::get('/inscricao/{id}/orcamento', [OrcamentoController::class, 'create']);
    Route::resource('/orcamento', OrcamentoController::class);
    Route::get('get-item-by-id', [ItemController::class, 'getItemById']);

    Route::resource('areas-tematicas', AreaTematicaController::class);

    Route::post('avaliador-por-inscricao/store', [AvaliadorPorInscricaoController::class, 'store']);
    Route::post('avaliador-por-inscricao/delete', [AvaliadorPorInscricaoController::class, 'delete']);

    Route::resource('subcomissao-tematica', SubcomissaoTematicaController::class);

    Route::get('/processo-editais', function(){
        $editais = App\Models\Edital::all();

        return view('processo-edital.index', compact('editais'));
    });

    Route::get('/processo-editais/{id}/editar', function($id){
        $edital = App\Models\Edital::find($id);
        $cronograma = App\Models\Cronograma::where('edital_id', $id)->get()->toArray();
        $avaliadores = App\Models\Avaliador::join('users', 'users.id', 'avaliadores.user_id')
                                ->where('avaliadores.edital_id', $id)
                                ->get(['avaliadores.id as avaliador_id', 'users.name', 'users.id', 'users.unidade_id']);

        return view('processo-edital.edit', compact('edital', 'cronograma', 'avaliadores'));
    });

    Route::get('notificacoes', [NotificationController::class, 'index'])->name('notificacoes.index');
    Route::get('notificacao/{id}', [NotificationController::class, 'show'])->name('notificacao.show');
    Route::post('notificacoes/marcar-como-lida', [NotificationController::class, 'markAsRead'])->name('marcar.como.lida');

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

