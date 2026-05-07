<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdutoController;

Route::get('/', function () {
    return redirect('/tv/acougue');
});

Route::get('/tv/acougue', [ProdutoController::class, 'tv']);

Route::get('/admin/produtos', [ProdutoController::class, 'index']);

Route::post('/admin/produtos', [ProdutoController::class, 'store']);

Route::put('/admin/produtos/{produto}', [ProdutoController::class, 'update']);

Route::delete('/admin/produtos/{produto}', [ProdutoController::class, 'destroy']);