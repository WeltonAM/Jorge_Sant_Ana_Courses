<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PrincipalController;
use App\Http\Controllers\SobreNosController;
use App\Http\Controllers\ContatoController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\PedidoProdutoController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\ProdutoDetalheController;

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

    Route::post('/fornecedores', [FornecedorController::class, 'store'])->name('fornecedores.create');
    Route::get('/fornecedores/{create?}', [FornecedorController::class, 'index'])->name('fornecedores');
    Route::post('/fornecedores/edit/{fornecedorId}', [FornecedorController::class, 'update'])->name('fornecedores.update');
    Route::get('/fornecedores/edit/{id}', [FornecedorController::class, 'edit'])->name('fornecedores.edit');
    Route::get('/fornecedores/delete/{id}', [FornecedorController::class, 'delete'])->name('fornecedores.delete');

    // Route::resource('produtos', "ProdutoController");
    Route::post('/produtos', [ProdutoController::class, 'store'])->name('produtos.create');
    Route::get('/produtos/{create?}', [ProdutoController::class, 'index'])->name('produtos');
    Route::post('/produtos/edit/{produtoId}', [ProdutoController::class, 'update'])->name('produtos.update');
    Route::get('/produtos/edit/{id}', [ProdutoController::class, 'edit'])->name('produtos.edit');
    Route::get('/produtos/delete/{id}', [ProdutoController::class, 'delete'])->name('produtos.delete');

    Route::get('/produto-detalhe/edit/{id}', [ProdutoDetalheController::class, 'edit'])->name('produto-detalhe.edit');
    Route::post('/produto-detalhe/edit/{id}', [ProdutoDetalheController::class, 'update'])->name('produto-detalhe.update');
    Route::get('/produto-detalhe/{id}/{create?}', [ProdutoDetalheController::class, 'index'])->name('produto-detalhe.index');
    Route::post('/produto-detalhe/{id}', [ProdutoDetalheController::class, 'store'])->name('produto-detalhe.store');

    Route::post('/clientes', [ClienteController::class, 'store'])->name('cliente.store');
    Route::get('/clientes/{create?}', [ClienteController::class, 'index'])->name('clientes');
    Route::post('/clientes/edit/{id}', [ClienteController::class, 'update'])->name('cliente.update');
    Route::get('/clientes/edit/{id}', [ClienteController::class, 'edit'])->name('cliente.edit');
    Route::get('/clientes/delete/{id}', [ClienteController::class, 'delete'])->name('cliente.delete');

    Route::post('/pedidos', [PedidoController::class, 'store'])->name('pedido.store');
    Route::get('/pedidos/{create?}', [PedidoController::class, 'index'])->name('pedidos');
    Route::post('/pedidos/edit/{id}', [PedidoController::class, 'update'])->name('pedido.update');
    Route::get('/pedidos/edit/{id}', [PedidoController::class, 'edit'])->name('pedido.edit');
    Route::get('/pedidos/delete/{id}', [PedidoController::class, 'delete'])->name('pedido.delete');

    Route::get('/pedido-produto/{id}/{create?}', [PedidoProdutoController::class, 'index'])->name('pedido-produto.index');
    Route::post('/pedido-produto/{id}', [PedidoProdutoController::class, 'store'])->name('pedido-produto.store');
});
