<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PedidoController extends Controller
{
    public function index(Request $req)
    {
        $pedidos = Pedido::all();
        $clientes = Cliente::all();

        return view('app.pedido.index', ['pedidos' => $pedidos, 'clientes' => $clientes, 'create' => $req['create'] ?? null]);
    }

    protected function validateRequest(Request $req)
    {
        return Validator::make($req->all(), [
            'cliente_id' => 'exists:clientes,id',
        ], [
            'cliente_id.exists' => '[Cliente] não encontrado na base de dados.',
        ]);
    }

    public function store(Request $req)
    {
        $create = '';

        $validator = $this->validateRequest($req);

        if ($validator->fails()) {
            return redirect('/app/pedidos/create')->withErrors($validator)->withInput();
        }

        try {
            $pedido = new Pedido();

            $pedido->cliente_id = $req->input('cliente_id');

            $pedido->save();

            $msg = 'Pedido cadastrado com sucesso.';
            $msgClass = 'success';
        } catch (\Exception $e) {
            $msg = 'Erro ao cadastrar pedido.';
            $msgClass = 'danger';
            $create = 'create';
        }

        return redirect("/app/pedidos/$create")->with(['msg' => $msg, 'msgClass' => $msgClass]);
    }

    public function edit($id)
    {
        $pedido = Pedido::find($id);
        $clientes = Cliente::all();

        if (!$pedido) {
            return redirect()->route('pedido.index')->with(['msg' => 'Pedido não encontrado.', 'msgClass' => 'danger']);
        }

        return view('app.pedido.edit', compact(['pedido', 'clientes']));
    }

    public function update(Request $req, $id)
    {
        $edit = '';
        $validator = $this->validateRequest($req);

        if ($validator->fails()) {
            return redirect("/app/pedidos/edit/$id")->withErrors($validator)->withInput();
        }

        try {
            $produto = Pedido::find($id);

            if (!$produto) {
                return redirect()->route('pedido.index')->with(['msg' => 'Pedido não encontrado.', 'msgClass' => 'danger']);
            }

            $produto->cliente_id = $req->input('cliente_id');

            $produto->save();

            $msg = 'Pedido atualizado com sucesso.';
            $msgClass = 'success';
        } catch (\Exception $e) {
            dd($e);
            $msg = 'Erro ao atualizar cliente.';
            $msgClass = 'danger';
            $edit = 'edit';
        }

        return redirect("/app/pedidos/$edit")->with(['msg' => $msg, 'msgClass' => $msgClass]);
    }

    public function delete($id)
    {
        try {
            Pedido::find($id)->delete();

            $msg = 'Pedido deletado com sucesso.';
            $msgClass = 'success';
        } catch (\Exception $e) {
            $msg = 'Erro ao deletar pedido.';
            $msgClass = 'danger';
        }

        return redirect("/app/pedidos")->with(['msg' => $msg, 'msgClass' => $msgClass]);
    }
}
