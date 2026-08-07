<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MgvApiController;

Route::post(
    '/importar-mgv',
    [MgvApiController::class, 'importar']
);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});