<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrincipalController;
use App\Http\Controllers\SobreNosController;
use App\Http\Controllers\ContatoController;

Route::get('/', [PrincipalController::class, 'principal'])->name('home');

Route::get('/sobre', [SobreNosController::class, 'sobre'])->name('sobre');

Route::get('/contato', [ContatoController::class, 'contato'])->name('contato');
