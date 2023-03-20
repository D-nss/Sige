<?php

use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UnidadeController;
use App\Http\Controllers\IndicadorUnidadeController;
use App\Http\Controllers\AvaliadorController;
use App\Http\Controllers\AvaliacaoController;
use App\Http\Controllers\AnalistaController;
use App\Http\Controllers\CertificadoController;
use App\Http\Controllers\CriterioController;
use App\Http\Controllers\CronogramaController;
use App\Http\Controllers\ComentarioController;
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
use App\Http\Controllers\ComissaoController;
use App\Http\Controllers\ComissaoUserController;
use App\Http\Controllers\IndicadoresDashboardController;
use App\Http\Controllers\RecursoInscricaoController;
use App\Http\Controllers\AcaoCulturalController;
use App\Http\Controllers\EventoInscritosController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\UploadArquivoController;
use App\Http\Controllers\EventoEquipeController;
use App\Http\Controllers\PalestranteController;

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

Route::get('/buscar-unidades-nao-cadastradas', [IndicadoresDashboardController::class, 'buscarUnidadesNaoCadastradasPorAno']);

// Ações de Extensão - Nao utilizado via resource por problemas envio dos parametros
//Route::resource('/acoes-extensao', AcaoExtensaoController::class)->names('acao_extensao')->parameters(['acoes_extensao' => 'acao_extensao'])->only(['create']);
Route::get('/acoes-extensao', [AcaoExtensaoController::class, 'index'])->name('acao_extensao.index');
Route::get('/acoes-extensao/novo', [AcaoExtensaoController::class, 'create'])->name('acao_extensao.create');
Route::post('/acoes-extensao', [AcaoExtensaoController::class, 'store'])->name('acao_extensao.store');
Route::post('/acoes-extensao/{acao_extensao}/comentar', [AcaoExtensaoController::class, 'enviarComentario'])->name('acao_extensao.comentar');
Route::get('/acoes-extensao/{acao_extensao}', [AcaoExtensaoController::class, 'show'])->name('acao_extensao.show');
Route::get('/acoes-extensao/{acao_extensao}/editar', [AcaoExtensaoController::class, 'edit'])->name('acao_extensao.edit');
Route::put('/acoes-extensao/{acao_extensao}', [AcaoExtensaoController::class, 'update'])->name('acao_extensao.update');
Route::delete('/acoes-extensao/{acao_extensao}', [AcaoExtensaoController::class, 'destroy'])->name('acao_extensao.destroy');
Route::put('/acoes-extensao/{acao_extensao}/aprovar', [AcaoExtensaoController::class, 'aprovar'])->name('acao_extensao.aprovar');
Route::put('/acoes-extensao/{acao_extensao}/submeter', [AcaoExtensaoController::class, 'submeter'])->name('acao_extensao.submeter');

Route::get('/acoes-extensao/unidades/{unidade}', [AcaoExtensaoController::class, 'acoesPorUnidade'])->name('acao_extensao.unidades.index');
Route::get('/acoes-extensao/areas/{area_tematica}', [AcaoExtensaoController::class, 'acoesPorArea'])->name('acao_extensao.area_tematica.index');
Route::get('/acoes-extensao/linhas/{linha_extensao}', [AcaoExtensaoController::class, 'acoesPorLinha'])->name('acao_extensao.linha.index');
Route::get('/acoes-extensao/ods/{ods}', [AcaoExtensaoController::class, 'acoesPorODS'])->name('acao_extensao.ods.index');
Route::get('/acoes-extensao/cidades/{municipio}', [AcaoExtensaoController::class, 'acoesPorCidade'])->name('acao_extensao.cidade.index');
Route::get('/acoes-extensao/modalidades/{id}', [AcaoExtensaoController::class, 'acoesPorModalidade'])->name('acao_extensao.modalidade.index');
Route::get('/acoes-extensao/situacao/{id}', [AcaoExtensaoController::class, 'acoesPorSituacao'])->name('acao_extensao.situacao.index');
Route::get('/acoes-extensao/grau-equipe/{grau_envolvimento_equipe}', [AcaoExtensaoController::class, 'acoesPorGrauEnvolvimentoEquipe'])->name('acao_extensao.grau_envolvimento_equipe.index');
Route::get('/acoes-extensao/palavra-chave/{palavra_chave}', [AcaoExtensaoController::class, 'acoesPorPalavraChave'])->name('acao_extensao.palavra_chave.index');
Route::get('/acoes-extensao/usuario/{usuario}', [AcaoExtensaoController::class, 'acoesPorUsuario'])->name('acao_extensao.usuario.index');
Route::get('/acoes-extensao/mapa/extensao', [AcaoExtensaoController::class, 'mapaExtensao'])->name('acao_extensao.mapa');
Route::post('/acoes-extensao/filtrar', [AcaoExtensaoController::class, 'filtrar'])->name('acao_extensao.filtrar');
Route::post('/acoes-extensao/filtrarMapa', [AcaoExtensaoController::class, 'filtrarMapa'])->name('acao_extensao.filtrar.mapa');
Route::get('/acoes-extensao/painel/extensao', [AcaoExtensaoController::class, 'dashboard'])->name('acao_extensao.painel');
Route::get('/acoes-extensao/{acao_extensao}/equipe', [AcaoExtensaoController::class, 'equipe'])->name('acao_extensao.equipe');
Route::post('/acoes-extensao/colaborador', [AcaoExtensaoController::class, 'insereColaborador'])->name('acao_extensao.colaborador.inserir');
Route::post('/acoes-extensao/colaborador/{acao_extensao_colaborador}', [AcaoExtensaoController::class, 'removeColaborador'])->name('acao_extensao.colaborador.destroy');
Route::post('/acoes-extensao/grau_equipe', [AcaoExtensaoController::class, 'grau_equipe'])->name('acao_extensao.grau_equipe');
Route::get('/acoes-extensao/{acao_extensao}/parceiros', [AcaoExtensaoController::class, 'parceiros'])->name('acao_extensao.parceiros');
Route::get('/acoes-extensao/{acao_extensao}/locais', [AcaoExtensaoController::class, 'locais'])->name('acao_extensao.locais');
Route::post('/acoes-extensao/data_local', [AcaoExtensaoController::class, 'insereDataLocal'])->name('acao_extensao.data_local.inserir');
//Route::delete('/acoes-extensao/{acao_extensao}/locais', [AcaoExtensaoController::class, 'removeLocal'])->name('acao_extensao.local.destroy');
Route::post('/acoes-extensao/local/{acao_extensao_local}', [AcaoExtensaoController::class, 'removeLocal'])->name('acao_extensao.local.destroy');
Route::post('/acoes-extensao/parceiro', [AcaoExtensaoController::class, 'insereParceiro'])->name('acao_extensao.parceiro.inserir');
Route::post('/acoes-extensao/parceiro/{acao_extensao_parceiro}', [AcaoExtensaoController::class, 'removeParceiro'])->name('acao_extensao.parceiro.destroy');
Route::post('/acoes-extensao/unidades', [AcaoExtensaoController::class, 'insereUnidade'])->name('acao_extensao.unidades.inserir');

//Ações Culturais
Route::get('/acoes-culturais', [AcaoCulturalController::class, 'index'])->name('acao_cultural.index');
Route::get('/acoes-culturais/novo', [AcaoCulturalController::class, 'create'])->name('acao_cultural.create');
Route::post('/acoes-culturais', [AcaoCulturalController::class, 'store'])->name('acao_cultural.store');
Route::post('/acoes-culturais/{acao_cultural}/comentar', [AcaoCulturalController::class, 'enviarComentario'])->name('acao_cultural.comentar');
Route::get('/acoes-culturais/{acao_cultural}', [AcaoCulturalController::class, 'show'])->name('acao_cultural.show');
Route::get('/acoes-culturais/{acao_cultural}/editar', [AcaoCulturalController::class, 'edit'])->name('acao_cultural.edit');
Route::put('/acoes-culturais/{acao_cultural}', [AcaoCulturalController::class, 'update'])->name('acao_cultural.update');
Route::delete('/acoes-culturais/{acao_cultural}', [AcaoCulturalController::class, 'destroy'])->name('acao_cultural.destroy');
Route::put('/acoes-culturais/{acao_cultural}/aprovar', [AcaoCulturalController::class, 'aprovar'])->name('acao_cultural.aprovar');
Route::get('/painel-cultura', [AcaoCulturalController::class, 'dashboard'])->name('acao_cultural.painel');
Route::get('/acoes-culturais/{acao_cultural}/datas', [AcaoCulturalController::class, 'datas'])->name('acao_cultural.datas');
Route::post('/acoes-culturais/datas', [AcaoCulturalController::class, 'insereData'])->name('acao_cultural.datas.inserir');
Route::get('/acoes-culturais/{acao_cultural}/coordenador', [AcaoCulturalController::class, 'coordenador']);
Route::post('/acoes-culturais/unidades', [AcaoCulturalController::class, 'insereUnidade'])->name('acao_cultural.unidades.inserir');
Route::post('/acoes-culturais/coordenador', [AcaoCulturalController::class, 'insereCoordenador'])->name('acao_cultural.coordenador.inserir');
Route::post('/acoes-culturais/filtrar', [AcaoCulturalController::class, 'filtrar'])->name('acao_cultural.filtrar');
Route::get('/acoes-culturais/{acao_cultural}/equipe', [AcaoCulturalController::class, 'equipe']);
Route::post('/acoes-culturais/colaborador', [AcaoCulturalController::class, 'insereColaborador'])->name('acao_cultural.colaborador.inserir');
Route::get('/acoes-culturais/{acao_cultural}/parceiros', [AcaoCulturalController::class, 'parceiros']);
Route::post('/acoes-culturais/parceiro', [AcaoCulturalController::class, 'insereParceiro'])->name('acao_cultural.parceiro.inserir');
Route::get('/acoes-culturais/unidades/{unidade}', [AcaoCulturalController::class, 'acoesPorUnidade'])->name('acao_cultural.unidades.index');

//Eventos inscrito
Route::get('evento/{evento}/inscrito/novo', [EventoInscritosController::class, 'create']);
Route::post('evento/{evento}/inscrito', [EventoInscritosController::class, 'store']);
Route::get('inscritos/confirmacao/{codigo}', [EventoInscritosController::class, 'confirmar']);
Route::get('inscritos/baixar_qrcode/{codigo}', [EventoInscritosController::class, 'baixarQrcode']);
Route::get('evento/inscrito/{id}', [EventoInscritosController::class, 'show']);
Route::post('inscrito/upload-arquivo/{id}', [EventoInscritosController::class, 'uploadArquivo']);
Route::post('inscrito/recurso-arquivo/{id}', [EventoInscritosController::class, 'recursoArquivo']);
Route::get('evento/{evento}/equipe/{id}', [EventoEquipeController::class, 'show']);
Route::get('evento/{evento}/equipe/{id}/certificado', [CertificadoController::class, 'make']);
Route::get('evento/{evento}/inscrito/{id}/certificado', [CertificadoController::class, 'make']);

// Adicionar as rotas que necessitam de Autenticação
Route::group(['middleware' => ['keycloak-web','check_is_user']], function () {
    //Route::get('/teste', [UserController::class, 'teste']);
    Route::get('home', function () {
        return view('home');
    });

    //Eventos
    Route::resource('eventos', EventoController::class);
    Route::get('evento/{evento}/inscritos', [EventoInscritosController::class, 'index']);
    Route::get('inscritos/presenca/{codigo}', [EventoInscritosController::class, 'marcarPresenca']);
    Route::get('inscritos/adm/confirmacao/{id}', [EventoInscritosController::class, 'adm_confirmar']);
    Route::get('inscritos/adm/presenca/{id}', [EventoInscritosController::class, 'adm_presenca']);
    Route::post('inscrito/enviar-email/{id}', [EventoInscritosController::class, 'enviarEmail']);
    Route::get('inscrito/enviar-email/{id}/novo', [EventoInscritosController::class, 'enviarEmailCreate']);
    Route::put('inscrito/arquivo-analise/{id}', [EventoInscritosController::class, 'analiseArquivo']);
    Route::get('evento/{evento}/equipe/novo', [EventoEquipeController::class, 'create']);
    Route::get('evento/{evento}/equipe/', [EventoEquipeController::class, 'index']);
    Route::post('evento/{evento}/equipe/', [EventoEquipeController::class, 'store']);
    Route::delete('evento/{evento}/equipe/{membro}', [EventoEquipeController::class, 'destroy']);
    Route::get('evento/{evento}/equipe/{membro}/editar', [EventoEquipeController::class, 'edit']);
    Route::put('evento/{evento}/equipe/{membro}', [EventoEquipeController::class, 'update']);
    Route::post('inscrito/avaliar-recurso/{id}', [EventoInscritosController::class, 'avaliaRecurso']);

    //Usuarios
    Route::resource('/usuarios', UserController::class)->names('user')->parameters(['usuarios' => 'user']);
    Route::put('/usuarios/{user}/ativar', [UserController::class, 'ativar'])->name('user.ativar');
    Route::put('/usuarios/{user}/desativar', [UserController::class, 'desativar'])->name('user.desativar');
    Route::get('/usuarios/get-data/{user}', [UserController::class, 'getUserData']);

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
    Route::get('/indicadores-dashboard', [IndicadoresDashboardController::class, 'index']);


    /* -------------- rotas editais ---------------- */
    Route::resource('/editais', EditalController::class)->parameters(['editais' => 'edital']);
    Route::get('editais', [EditalController::class, 'index']);
    Route::post('edital/{edital}/divulgar', [EditalController::class, 'divulgar']);

    Route::get('/editais/{edital}/criterios', [CriterioController::class, 'edit']);
    Route::resource('/criterios', CriterioController::class)->parameters(['criterios' => 'criterio']);

    Route::resource('/cronogramas', CronogramaController::class);
    Route::get('/editais/{edital}/cronograma', [CronogramaController::class, 'edit']);
    Route::post('/cronograma/prorrogar', [CronogramaController::class, 'prorrogar']);

    Route::resource('/questoes', QuestaoController::class)->parameters(['questoes' => 'questao']);
    Route::get('/editais/{edital}/questoes', [QuestaoController::class, 'edit']);

    Route::resource('/avaliadores', AvaliadorController::class)->parameters(['avaliadores' => 'avaliador']);
    Route::get('/editais/{edital}/avaliadores', [EditalController::class, 'editarAvaliadores']);
    Route::get('get-avaliador-by-subcomissao', [AvaliadorController::class, 'getAvaliadorBySubcomissao']);

    Route::get('/comissoes', [ComissaoController::class, 'index']);
    Route::delete('comissoes/{comissao}', [ComissaoController::class, 'destroy']);
    Route::delete('comissoes/participante/delete', [ComissaoUserController::class, 'destroy'])->name('participantes.delete');
   // Route::get('comissoes/novo/edital/{id}', [ComissaoController::class, 'create']);
    Route::get('comissoes/novo/', [ComissaoController::class, 'create']);
    Route::get('comissoes/{id}/novo/participante', [ComissaoUserController::class, 'create']);
    Route::post('comissoes', [ComissaoController::class, 'store'])->name('comissoes.store');
    Route::post('comissoes/participante/store', [ComissaoUserController::class, 'store'])->name('participantes.store');

    Route::resource('/inscricao', InscricaoController::class)->parameters(['inscricoes' => 'inscricao']);
    Route::get('inscricao/show-completo/{id}', [InscricaoController::class, 'showCompleto']);
    Route::get('/inscricao/{id}/novo', [InscricaoController::class, 'create']);
    Route::get('/inscricao/{inscricao}/recurso', [RecursoInscricaoController::class, 'create']);
    Route::post('/inscricao/{inscricao}/recurso', [RecursoInscricaoController::class, 'store']);
    Route::post('/recurso/avaliar', [RecursoInscricaoController::class, 'avaliar']);
    //Route::post('/inscricao/{inscricao}/analise', [InscricaoController::class, 'analise']);
    Route::get('/inscricao/{inscricao}/avaliacao/', [AvaliacaoController::class, 'create']);
    Route::put('/inscricao/{inscricao}/avaliacaoUpdate', [AvaliacaoController::class, 'update']);
    Route::post('/inscricao/{inscricao}/avaliacao', [AvaliacaoController::class, 'store']);
    Route::get('/inscricao/{inscricao}/avaliadores', [AvaliadorPorInscricaoController::class, 'create']);
    Route::get('/inscricao/{inscricao}/indicar-analista', [AnalistaController::class, 'create']);
    Route::post('/inscricao/{inscricao}/indicar-analista/store', [AnalistaController::class, 'store']);
    Route::post('/inscricao/{inscricao}/indicar-analista/delete', [AnalistaController::class, 'destroy']);
    Route::post('/inscricao/{inscricao}/submeter', [InscricaoController::class, 'submeter']);
    Route::post('/inscricao/{inscricao}/contemplar', [InscricaoController::class, 'contemplar']);
    Route::get('edital/{edital}/suas-inscricoes', [InscricaoController::class, 'inscricoesPorUsuario']);

    Route::post('/upload-arquivo', [UploadArquivoController::class, 'store']);

    Route::post('/edital/{edital}/classificar', [EditalController::class, 'classificar']);
    Route::get('/edital/{edital}/listar-classificados', [EditalController::class, 'listarClassificados']);
    Route::get('/edital/{edital}/inscricoes', [InscricaoController::class, 'inscricoesPorEdital']);

    Route::get('/inscricao/{inscricao}/orcamento', [OrcamentoController::class, 'create']);
    Route::resource('/orcamento', OrcamentoController::class);
    Route::get('get-item-by-id', [ItemController::class, 'getItemById']);

    Route::resource('areas-tematicas', AreaTematicaController::class);

    Route::post('avaliador-por-inscricao/store', [AvaliadorPorInscricaoController::class, 'store']);
    Route::post('avaliador-por-inscricao/delete', [AvaliadorPorInscricaoController::class, 'delete']);
    Route::post('avaliador-por-inscricao/{inscricao}/notificar', [AvaliadorPorInscricaoController::class, 'notificar']);

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

