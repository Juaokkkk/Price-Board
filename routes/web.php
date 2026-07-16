<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ConfiguracaoController;
use App\Http\Controllers\BannerController;

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/', function () {
        return redirect('/tv/acougue');
    });

    Route::get('/tv/acougue', [ProdutoController::class, 'tv']);


    // PRODUTOS
    Route::get('/admin/produtos', [ProdutoController::class, 'index']);

    Route::post('/admin/produtos', [ProdutoController::class, 'store']);

    Route::put('/admin/produtos/{produto}', [ProdutoController::class, 'update']);

    Route::delete('/admin/produtos/{produto}', [ProdutoController::class, 'destroy']);


    // DASHBOARD
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');


    // CONFIGURAÇÕES
    Route::get(
        '/admin/configuracoes',
        [ConfiguracaoController::class, 'index']
    )->name('configuracoes.index');


    Route::post(
        '/admin/configuracoes',
        [ConfiguracaoController::class, 'update']
    )->name('configuracoes.update');


    Route::delete(
        '/admin/configuracoes/remover-logo',
        [ConfiguracaoController::class, 'removerLogo']
    )->name('configuracoes.removerLogo');


    Route::delete(
        '/admin/configuracoes/remover-fundo',
        [ConfiguracaoController::class, 'removerFundo']
    )->name('configuracoes.removerFundo');


    // BANNERS
Route::get('/admin/banners', [BannerController::class, 'index'])
    ->name('banners.index');

Route::get('/admin/banners/criar', [BannerController::class, 'create'])
    ->name('banners.create');

Route::post('/admin/banners', [BannerController::class, 'store'])
    ->name('banners.store');


// EDITAR BANNER
Route::get('/admin/banners/{banner}/editar', [BannerController::class, 'edit'])
    ->name('banners.edit');

Route::put('/admin/banners/{banner}', [BannerController::class, 'update'])
    ->name('banners.update');


// EXCLUIR
Route::delete('/admin/banners/{banner}', [BannerController::class, 'destroy'])
    ->name('banners.destroy');


// ATIVAR/DESATIVAR
Route::patch('/admin/banners/{banner}/status', [BannerController::class, 'updateStatus'])
    ->name('banners.status');

});