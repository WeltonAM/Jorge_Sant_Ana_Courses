<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PrincipalController;
use App\Http\Controllers\SobreNosController;
use App\Http\Controllers\ContatoController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\ProdutoController;

Route::fallback(function () {
    return redirect()->route('principal')->with('msg', 'A página que você tentou acessar não existe.');
});

//SITE
Route::get('/', [PrincipalController::class, 'principal'])->name('principal');

Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'autenticar'])->name('login');

Route::get('/sobre', [SobreNosController::class, 'sobre'])->name('sobre');

Route::controller(ContatoController::class)->group(function () {
    Route::get('/contato', 'contato')->name('contato');
    Route::post('/contato', 'store');
});

//APP
Route::middleware('autenticacao')->prefix('/app')->group(function() {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/sair', [LoginController::class, 'logout'])->name('sair');

    Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes');

    Route::post('/fornecedores', [FornecedorController::class, 'store'])->name('fornecedores');
    Route::get('/fornecedores/{create?}', [FornecedorController::class, 'index'])->name('fornecedores');
    Route::get('/fornecedores/edit/{id}', [FornecedorController::class, 'edit'])->name('fornecedores.edit');
    Route::get('/fornecedores/delete/{id}', [FornecedorController::class, 'delete'])->name('fornecedores.delete');

    Route::get('/produtos', [ProdutoController::class, 'index'])->name('produtos');
});
