<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Pedido;
use App\Models\PedidoProduto;
use App\Models\Produto;
use Illuminate\Support\Facades\Validator;

class PedidoProdutoController extends Controller
{
    public function index(Request $req)
    {
        $produtos = Produto::all();
        $pedido = Pedido::find($req['id']);

        return view('app.pedido_produto.index', ['pedido' => $pedido, 'produtos' => $produtos, 'create' => $req['create'] ?? null]);
    }

    protected function validateRequest(Request $req)
    {
        return Validator::make($req->all(), [
            'produto_id' => 'exists:produtos,id',
            'quantidade' => 'required|integer',
        ], [
            'required' => 'O campo [:attribute] deve ser preenchido.',

            'quantidade.integer' => 'A [Quantidade] deve ter um número válido.',

            'produto_id.exists' => '[Produto] não encontrado na base de dados.',
        ]);
    }

    public function store(Request $req)
    {
        $validator = $this->validateRequest($req);

        if ($validator->fails()) {
            return redirect("/app/pedido-produto/$req->id/create")->withErrors($validator)->withInput();
        }

        try {
            $pedidoProduto = PedidoProduto::where('pedido_id', $req['pedido_id'])
                ->where('produto_id', $req['produto_id'])
                ->first();

            if ($pedidoProduto) {
                $pedidoProduto->update(['quantidade' => $pedidoProduto->quantidade + $req['quantidade']]);

                // $pedido->produtosPedido()->attach($req['produto_id'], ['quantidade' => $req['quantidade']]);

            } else {
                PedidoProduto::create([
                    'pedido_id' => $req['pedido_id'],
                    'produto_id' => $req['produto_id'],
                    'quantidade' => $req['quantidade'],
                ]);
            }

            $msg = 'Produto adicionado ao pedido com sucesso.';
            $msgClass = 'success';
        } catch (\Exception $e) {
            $msg = 'Erro ao adicionar produto ao pedido.';
            $msgClass = 'danger';
        }

        return redirect("/app/pedido-produto/$req->id")->with(['msg' => $msg, 'msgClass' => $msgClass]);
    }
}
