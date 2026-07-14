<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ConfiguracaoController;

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/', function () {
        return redirect('/tv/acougue');
    });

    Route::get('/tv/acougue', [ProdutoController::class, 'tv']);

    Route::get('/admin/produtos', [ProdutoController::class, 'index']);

    Route::post('/admin/produtos', [ProdutoController::class, 'store']);

    Route::put('/admin/produtos/{produto}', [ProdutoController::class, 'update']);

    Route::delete('/admin/produtos/{produto}', [ProdutoController::class, 'destroy']);

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

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

});