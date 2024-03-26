<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('/cliente', 'App\Http\Controllers\ClienteController');

Route::apiResource('/carro', 'App\Http\Controllers\CarroController');
