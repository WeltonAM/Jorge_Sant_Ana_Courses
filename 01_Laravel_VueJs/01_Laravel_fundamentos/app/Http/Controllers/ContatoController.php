<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContatoController extends Controller
{
    public function contato() {
        return view('site.contato');
    }

    public function store(Request $req) {
        $nome = $req['nome'];
        $telefone = $req['telefone'];
        $email = $req['email'];
        $motivo_contato = $req['motivo_contato'];
        $mensagem = $req->input('mensagem');

        dd($nome, $telefone, $email, $motivo_contato, $mensagem);
    }
}
