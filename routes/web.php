<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ConfiguracaoController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\Admin\MgvImportController;
use App\Http\Controllers\Admin\ImportacaoMgvController;

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/', function () {
        return redirect('/tv/acougue');
    });

    Route::get('/tv/acougue', [ProdutoController::class, 'tv']);

    /*
    |--------------------------------------------------------------------------
    | PRODUTOS
    |--------------------------------------------------------------------------
    */

    Route::get('/admin/produtos', [ProdutoController::class, 'index']);
    Route::post('/admin/produtos', [ProdutoController::class, 'store']);
    Route::put('/admin/produtos/{produto}', [ProdutoController::class, 'update']);
    Route::delete('/admin/produtos/{produto}', [ProdutoController::class, 'destroy']);

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | CONFIGURAÇÕES
    |--------------------------------------------------------------------------
    */

    Route::get('/admin/configuracoes', [ConfiguracaoController::class, 'index'])
        ->name('configuracoes.index');

    Route::post('/admin/configuracoes', [ConfiguracaoController::class, 'update'])
        ->name('configuracoes.update');

    Route::post(
        '/admin/configuracoes/gerar-token',
        [ConfiguracaoController::class, 'gerarToken']
    )->name('configuracoes.gerar-token');

    Route::delete(
        '/admin/configuracoes/remover-logo',
        [ConfiguracaoController::class, 'removerLogo']
    )->name('configuracoes.removerLogo');

    Route::delete(
        '/admin/configuracoes/remover-fundo',
        [ConfiguracaoController::class, 'removerFundo']
    )->name('configuracoes.removerFundo');

    /*
    |--------------------------------------------------------------------------
    | BANNERS
    |--------------------------------------------------------------------------
    */

    Route::get('/admin/banners', [BannerController::class, 'index'])
        ->name('banners.index');

    Route::get('/admin/banners/criar', [BannerController::class, 'create'])
        ->name('banners.create');

    Route::post('/admin/banners', [BannerController::class, 'store'])
        ->name('banners.store');

    Route::get('/admin/banners/{banner}/editar', [BannerController::class, 'edit'])
        ->name('banners.edit');

    Route::put('/admin/banners/{banner}', [BannerController::class, 'update'])
        ->name('banners.update');

    Route::delete('/admin/banners/{banner}', [BannerController::class, 'destroy'])
        ->name('banners.destroy');

    Route::patch('/admin/banners/{banner}/status', [BannerController::class, 'updateStatus'])
        ->name('banners.status');

    /*
    |--------------------------------------------------------------------------
    | IMPORTAÇÃO MGV
    |--------------------------------------------------------------------------
    */

    Route::get('/admin/importar-mgv', [MgvImportController::class, 'index'])
        ->name('mgv.index');

    Route::post('/admin/importar-mgv', [MgvImportController::class, 'importar'])
        ->name('mgv.importar');

    Route::delete('/admin/importar-mgv', [MgvImportController::class, 'limpar'])
        ->name('mgv.limpar');

    /*
    |--------------------------------------------------------------------------
    | HISTÓRICO
    |--------------------------------------------------------------------------
    */

    Route::get('/admin/importacoes-mgv', [ImportacaoMgvController::class, 'index'])
        ->name('mgv.historico');

    Route::delete(
        '/admin/importacoes-mgv/{importacao}',
        [ImportacaoMgvController::class, 'destroy']
    )->name('mgv.destroy');

    /*
    |--------------------------------------------------------------------------
    | USUÁRIOS (ADMIN)
    |--------------------------------------------------------------------------
    */

    Route::middleware(['admin'])->group(function () {

        Route::resource('usuarios', UsuarioController::class)
            ->except(['show']);

    });

});