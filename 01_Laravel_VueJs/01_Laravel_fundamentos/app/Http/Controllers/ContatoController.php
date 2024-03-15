<?php

namespace App\Http\Controllers;

use App\Models\SiteContato;
use Illuminate\Http\Request;

class ContatoController extends Controller
{
    public function contato() {
        return view('site.contato');
    }

    public function store(Request $req) {

        $contato = new SiteContato();

        $contato->nome = $req['nome'];
        $contato->telefone = $req['telefone'];
        $contato->email = $req['email'];
        $contato->motivo_contato = $req['motivo_contato'];
        $contato->mensagem = $req->input('mensagem');

        try {
            $contato->save();
            $msg = 'Contato realizado com sucesso!';
            $msgClass = 'success';
        } catch (\Throwable $th) {
            $msg = 'Erro ao realizar contato.';
            $msgClass = 'danger';
        }

        return view('site.contato', compact('msg', 'msgClass'));
    }
}
