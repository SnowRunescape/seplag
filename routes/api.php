<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EnderecoFuncionalController;
use App\Http\Controllers\ServidorEfetivoController;
use App\Http\Controllers\ServidorTemporarioController;
use App\Http\Controllers\UnidadeController;
use App\Http\Controllers\LotacaoController;
use App\Http\Controllers\FotoController;
use App\Http\Controllers\UnidadeServidorEfetivoController;

Route::post('/auth/login', [AuthController::class, 'login']);

Route::middleware(['auth:api'])->group(function () {
    Route::post('/auth/refresh', [AuthController::class, 'refresh']);

    Route::apiResource('servidores/efetivos', ServidorEfetivoController::class);
    Route::apiResource('servidores/temporarios', ServidorTemporarioController::class);
    Route::apiResource('unidades', UnidadeController::class);
    Route::apiResource('lotacoes', LotacaoController::class);

    Route::get('/unidades/{unidade}/servidores/efetivos', [UnidadeServidorEfetivoController::class, 'index']);

    Route::get('endereco-funcional', [EnderecoFuncionalController::class, 'index']);

    Route::post('fotos', [FotoController::class, 'upload']);
});
