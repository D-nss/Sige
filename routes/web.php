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
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProcessoEditalController;
use App\Http\Controllers\AcaoExtensaoController;

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

// Ações de Extensão - Nao utilizado via resource por problemas envio dos parametros
//Route::resource('/acoes-extensao', AcaoExtensaoController::class)->names('acao_extensao')->parameters(['acoes_extensao' => 'acao_extensao'])->only(['create']);
Route::get('/acoes-extensao', [AcaoExtensaoController::class, 'index'])->name('acao_extensao.index');
Route::get('/acoes-extensao/novo', [AcaoExtensaoController::class, 'create'])->name('acao_extensao.create');
Route::post('/acoes-extensao', [AcaoExtensaoController::class, 'store'])->name('acao_extensao.store');
Route::get('/acoes-extensao/{acao_extensao}', [AcaoExtensaoController::class, 'show'])->name('acao_extensao.show');
Route::get('/acoes-extensao/{acao_extensao}/editar', [AcaoExtensaoController::class, 'edit'])->name('acao_extensao.edit');
Route::put('/acoes-extensao/{acao_extensao}', [AcaoExtensaoController::class, 'update'])->name('acao_extensao.update');
Route::delete('/acoes-extensao/{acao_extensao}', [AcaoExtensaoController::class, 'destroy'])->name('acao_extensao.destroy');
Route::put('/acoes-extensao/{acao_extensao}/aprovar', [AcaoExtensaoController::class, 'aprovar'])->name('acao_extensao.aprovar');

Route::get('/acoes-extensao/unidades/{unidade}', [AcaoExtensaoController::class, 'acoesPorUnidade'])->name('acao_extensao.unidades.index');
Route::get('/acoes-extensao/areas/{area_tematica}', [AcaoExtensaoController::class, 'acoesPorArea'])->name('acao_extensao.area_tematica.index');
Route::get('/acoes-extensao/linhas/{linha_extensao}', [AcaoExtensaoController::class, 'acoesPorLinha'])->name('acao_extensao.linha.index');
Route::get('/acoes-extensao/cidades/{municipio}', [AcaoExtensaoController::class, 'acoesPorCidade'])->name('acao_extensao.cidade.index');
Route::get('/acoes-extensao/tipos/{id}', [AcaoExtensaoController::class, 'acoesPorTipo'])->name('acao_extensao.tipo.index');
Route::get('/acoes-extensao/situacao/{id}', [AcaoExtensaoController::class, 'acoesPorSituacao'])->name('acao_extensao.situacao.index');
Route::get('/acoes-extensao/parceiro/{tipo_parceiro}', [AcaoExtensaoController::class, 'acoesPorTipoParceiro'])->name('acao_extensao.tipo_parceiro.index');
Route::get('/acoes-extensao/grau-equipe/{grau_envolvimento_equipe}', [AcaoExtensaoController::class, 'acoesPorGrauEnvolvimentoEquipe'])->name('acao_extensao.grau_envolvimento_equipe.index');
Route::get('/acoes-extensao/palavra-chave/{palavra_chave}', [AcaoExtensaoController::class, 'acoesPorPalavraChave'])->name('acao_extensao.palavra_chave.index');
Route::get('/acoes-extensao/mapa/extensao', [AcaoExtensaoController::class, 'mapaExtensao'])->name('acao_extensao.mapa');
Route::post('/acoes-extensao/filtrar', [AcaoExtensaoController::class, 'filtrar'])->name('acao_extensao.filtrar');
Route::post('/acoes-extensao/filtrarMapa', [AcaoExtensaoController::class, 'filtrarMapa'])->name('acao_extensao.filtrar.mapa');
Route::get('/painel', [AcaoExtensaoController::class, 'dashboard'])->name('acao_extensao.painel');

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
    Route::resource('/indicadores-parametros', IndicadoresParametrosController::class)->parameters(['indicadoresParametros' => 'indicadorParametro']);

    /* -------------- rotas editais ---------------- */
    Route::resource('/editais', EditalController::class)->parameters(['editais' => 'edital']);
    Route::get('editais', [EditalController::class, 'index']);
    Route::post('edital/{edital}/divulgar', [EditalController::class, 'divulgar']);

    Route::get('/editais/{edital}/criterios', [EditalController::class, 'editarCriterios']);
    Route::resource('/criterios', CriterioController::class)->parameters(['criterios' => 'criterio']);

    Route::resource('/cronogramas', CronogramaController::class);
    Route::get('/editais/{edital}/cronograma', [EditalController::class, 'editarCronograma']);
    Route::post('/cronograma/prorrogar', [CronogramaController::class, 'prorrogar']);

    Route::resource('/questoes', QuestaoController::class)->parameters(['questoes' => 'questao']);
    Route::get('/editais/{edital}/questoes', [EditalController::class, 'editarQuestoes']);

    Route::resource('/avaliadores', AvaliadorController::class)->parameters(['avaliadores' => 'avaliador']);
    Route::get('/editais/{edital}/avaliadores', [EditalController::class, 'editarAvaliadores']);
    Route::get('get-avaliador-by-subcomissao', [AvaliadorController::class, 'getAvaliadorBySubcomissao']);

    Route::resource('/inscricao', InscricaoController::class)->parameters(['inscricoes' => 'inscricao']);
    Route::get('/inscricao/{id}/novo', [InscricaoController::class, 'create']);
    //Route::post('/inscricao/{inscricao}/analise', [InscricaoController::class, 'analise']);
    Route::post('/inscricao/{inscricao}/avaliacao', [InscricaoController::class, 'avaliacao']);
    Route::get('/inscricao/{inscricao}/avaliadores', [InscricaoController::class, 'indicarAvaliador']);
    Route::get('/inscricao/{inscricao}/indicar-analista', [InscricaoController::class, 'indicarAnalista']);
    Route::post('/inscricao/{inscricao}/indicar-analista/store', [InscricaoController::class, 'indicarAnalistaStore']);
    Route::post('/inscricao/{inscricao}/indicar-analista/delete', [InscricaoController::class, 'indicarAnalistaDelete']);
    Route::post('/inscricao/{inscricao}/submeter', [InscricaoController::class, 'submeter']);
    Route::get('inscricoes-enviadas', [InscricaoController::class, 'inscricoesPorUsuario']);

    Route::get('/inscricao/{inscricao}/orcamento', [OrcamentoController::class, 'create']);
    Route::resource('/orcamento', OrcamentoController::class);
    Route::get('get-item-by-id', [ItemController::class, 'getItemById']);

    Route::resource('areas-tematicas', AreaTematicaController::class);

    Route::post('avaliador-por-inscricao/store', [AvaliadorPorInscricaoController::class, 'store']);
    Route::post('avaliador-por-inscricao/delete', [AvaliadorPorInscricaoController::class, 'delete']);

    Route::resource('subcomissao-tematica', SubcomissaoTematicaController::class);

    Route::get('/processo-editais', [ProcessoEditalController::class, 'index'])->name('processo.editais');
    Route::get('/processo-editais/{id}/editar', [ProcessoEditalController::class, 'edit'])->name('processo.editais.editar');

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

