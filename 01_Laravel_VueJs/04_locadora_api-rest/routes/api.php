<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->middleware('jwt.auth')->group(function () {
    Route::apiResource('/cliente', 'App\Http\Controllers\ClienteController');
    Route::apiResource('/carro', 'App\Http\Controllers\CarroController');
    Route::apiResource('/locacao', 'App\Http\Controllers\LocacaoController');
    Route::apiResource('/marca', 'App\Http\Controllers\MarcaController');
    Route::apiResource('/modelo', 'App\Http\Controllers\ModeloController');
    Route::post('/me', 'App\Http\Controllers\AuthController@me');
    Route::post('/logout', 'App\Http\Controllers\AuthController@logout');
});

Route::post('/login', 'App\Http\Controllers\AuthController@login');
Route::post('/refresh', 'App\Http\Controllers\AuthController@refresh');
