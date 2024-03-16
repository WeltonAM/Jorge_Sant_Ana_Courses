<?php

namespace App\Http\Controllers;

use App\Models\MotivoContato;
use App\Models\SiteContato;
use Illuminate\Http\Request;

class ContatoController extends Controller
{
    public function contato() {
        $motivo_contatos = MotivoContato::all();

        return view('site.contato', ['motivo_contatos' => $motivo_contatos]);
    }

    public function store(Request $req) {
        $motivo_contatos = MotivoContato::all();

        $contato = new SiteContato();

        $req->validate([
            'nome' => 'required|min:3|max:40|unique:site_contatos',
            'telefone' => 'required',
            'email' => 'email',
            'motivo_contatos_id' => 'required',
            'mensagem' => 'required|max:2000',
        ]);

        $contato->nome = $req['nome'];
        $contato->telefone = $req['telefone'];
        $contato->email = $req['email'];
        $contato->motivo_contatos_id = $req['motivo_contatos_id'];
        $contato->mensagem = $req->input('mensagem');

        try {
            $contato->save();
            $msg = 'Contato realizado com sucesso!';
            $msgClass = 'success';
        } catch (\Exception $e) {
            $msg = 'Erro ao realizar contato.';
            $msgClass = 'danger';
        }

        return view('site.contato', ['motivo_contatos' => $motivo_contatos, 'msg' => $msg, 'msgClass' => $msgClass]);
    }
}
