<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClienteController extends Controller
{
    public function index(Request $req)
    {
        $clientes = Cliente::all();

        return view('app.cliente.index', ['clientes' => $clientes, 'create' => $req['create'] ?? null]);
    }

    protected function validateRequest(Request $req)
    {
        return Validator::make($req->all(), [
            'nome' => 'required|min:3|max:40',
        ], [
            'required' => 'O campo [:attribute] deve ser preenchido',

            'nome.min' => 'O campo [Nome] deve ter no mínimo 3 caracteres.',
            'nome.max' => 'O campo [Nome] deve ter no máximo 40 caracteres.',
        ]);
    }

    public function store(Request $req)
    {
        $create = '';

        $validator = $this->validateRequest($req);

        if ($validator->fails()) {
            return redirect('/app/clientes/create')->withErrors($validator)->withInput();
        }

        $nome = $req->input('nome');

        try {
            $cliente = new Cliente();

            $cliente->nome = $nome;

            $cliente->save();

            $msg = 'Cliente cadastrado com sucesso.';
            $msgClass = 'success';
        } catch (\Exception $e) {
            $msg = 'Erro ao cadastrar cliente.';
            $msgClass = 'danger';
            $create = 'create';
        }

        return redirect("/app/clientes/$create")->with(['msg' => $msg, 'msgClass' => $msgClass]);
    }

    public function edit($id)
    {
        $cliente = Cliente::find($id);

        if (!$cliente) {
            return redirect()->route('clientes')->with(['msg' => 'Cliente não encontrado.', 'msgClass' => 'danger']);
        }

        return view('app.cliente.edit', compact('cliente'));
    }

    public function update(Request $req, $id)
    {
        $edit = '';
        $validator = $this->validateRequest($req);

        if ($validator->fails()) {
            return redirect("/app/clientes/edit/$id")->withErrors($validator)->withInput();
        }

        try {
            $produto = Cliente::find($id);

            if (!$produto) {
                return redirect()->route('clientes')->with(['msg' => 'Cliente não encontrado.', 'msgClass' => 'danger']);
            }

            $produto->nome = $req->input('nome');

            $produto->save();

            $msg = 'Cliente atualizado com sucesso.';
            $msgClass = 'success';
        } catch (\Exception $e) {
            dd($e);
            $msg = 'Erro ao atualizar cliente.';
            $msgClass = 'danger';
            $edit = 'edit';
        }

        return redirect("/app/clientes/$edit")->with(['msg' => $msg, 'msgClass' => $msgClass]);
    }

    public function delete($id)
    {
        try {
            Cliente::find($id)->delete();
            $msg = 'Cliente deletado com sucesso.';
            $msgClass = 'success';
        } catch (\Exception $e) {
            $msg = 'Erro ao deletar cliente.';
            $msgClass = 'danger';
        }

        return redirect("/app/clientes")->with(['msg' => $msg, 'msgClass' => $msgClass]);
    }
}
