<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index(Request $req) {
        return view('app.produto.index');
    }
}
