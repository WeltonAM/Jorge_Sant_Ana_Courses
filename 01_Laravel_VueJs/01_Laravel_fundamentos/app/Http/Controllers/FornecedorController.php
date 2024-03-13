<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FornecedorController extends Controller
{
    public function index() {
        $dados['fornecedores'] = ['Fornecedor#01', 'Fornecedor#02', 'Fornecedor#03'];

        return view('app.fornecedor.index')->with($dados);
    }
}
