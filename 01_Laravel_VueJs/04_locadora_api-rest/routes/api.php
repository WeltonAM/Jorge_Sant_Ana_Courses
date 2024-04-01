<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('/cliente', 'App\Http\Controllers\ClienteController')->middleware('jwt.auth');

Route::apiResource('/carro', 'App\Http\Controllers\CarroController')->middleware('jwt.auth');

Route::apiResource('/locacao', 'App\Http\Controllers\LocacaoController')->middleware('jwt.auth');

Route::apiResource('/marca', 'App\Http\Controllers\MarcaController')->middleware('jwt.auth');

Route::apiResource('/modelo', 'App\Http\Controllers\ModeloController')->middleware('jwt.auth');

Route::post('/login', 'App\Http\Controllers\AuthController@login');
Route::post('/logout', 'App\Http\Controllers\AuthController@logout');
Route::post('/refresh', 'App\Http\Controllers\AuthController@refresh');
Route::post('/me', 'App\Http\Controllers\AuthController@me');
