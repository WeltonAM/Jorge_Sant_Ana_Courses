<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login() {
        return view('site.login');
    }

    public function autenticar(Request $req) {

        $regrasValidacao = [
            'usuario' => 'email',
            'senha' => 'required',
        ];

        $feedBack = [
            'usuario.email' => 'O campo [Email] é obrigatório.',
            'senha.required' => 'O campo [Senha] é obrigatório.',
        ];

        $req->validate($regrasValidacao, $feedBack);

        return view('site.login');
    }
}
