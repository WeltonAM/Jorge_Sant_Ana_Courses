<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrincipalController;
use App\Http\Controllers\SobreNosController;
use App\Http\Controllers\ContatoController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\ProdutoController;

//SITE
Route::get('/', [PrincipalController::class, 'principal'])->name('principal');

Route::get('/login', [LoginController::class, 'login'])->name('login');

Route::get('/sobre', [SobreNosController::class, 'sobre'])->name('sobre');

Route::get('/contato', [ContatoController::class, 'contato'])->name('contato');
Route::post('/contato', [ContatoController::class, 'store']);

//APP
Route::prefix('/app')->group(function() {

    Route::get('/clientes', [ClienteController::class, 'clientes'])->name('clientes');

    Route::get('/fornecedores', [FornecedorController::class, 'index'])->name('fornecedores');

    Route::get('/produtos', [ProdutoController::class, 'produtos'])->name('produtos');
});
