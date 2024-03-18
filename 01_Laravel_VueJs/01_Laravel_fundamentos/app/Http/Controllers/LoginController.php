<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $req) {
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

        $email = $req['email'];
        $senha = $req['senha'];

        $userModel = new User();
        $usuario = $userModel->where('email', $email)->where('password', $senha)->get()->first();

        if($usuario) {
            session_start();
            $_SESSION['nome'] = $usuario->name;
            $_SESSION['email'] = $usuario->email;

            return redirect('/app/dashboard')->with(['msg' => "Olá, $usuario->name", 'msgClass' => 'success']);
        } else {
            return view('site.login', ['msg' => 'Usuário inválido', 'msgClass' => 'danger']);
        }
    }

    public function logout(Request $req)
    {
        session_destroy();
        return redirect('/')->with(['msg' => "Até breve!", 'msgClass' => 'success']);
    }
}
