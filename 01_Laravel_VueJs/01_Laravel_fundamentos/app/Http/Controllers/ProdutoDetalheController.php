<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\ProdutoDetalhe;
use App\Models\Unidade;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProdutoDetalheController extends Controller
{
    public function index(Request $req, $id)
    {
        $produto = Produto::find($id);
        $unidades = Unidade::all();

        return view('app.produto-detalhe.index', ['produto' => $produto, 'unidades' => $unidades, 'create' => $req['create'] ?? null]);
    }

    protected function validateRequest(Request $request)
    {
        return Validator::make($request->all(), [
            'produto_id' => 'required|integer',
            'comprimento' => ['required', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/'],
            'largura' => ['required', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/'],
            'altura' => ['required', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/'],
            'unidade' => 'exists:unidades,id',
        ], [
            'required' => 'O campo [:attribute] deve ser preenchido',

            'produto_id.integer' => '[Id do produto] deve conter somente números.',
            'comprimento.numeric' => '[Comprimento] deve conter somente números.',
            'largura.numeric' => '[Largura] deve conter somente números.',
            'altura.numeric' => '[Altura] deve conter somente números.',

            'unidade.exists' => '[Unidade] não salva.',
        ]);
    }

    public function store(Request $req, $id)
    {
        $create = '';

        $validator = $this->validateRequest($req);

        if ($validator->fails()) {
            return redirect("/app/produto-detalhe/$id/create")->withErrors($validator)->withInput();
        }

        try {
            ProdutoDetalhe::create($req->all());

            $msg = 'Detalhes adicionados ao produto com sucesso.';
            $msgClass = 'success';
        } catch (\Exception $e) {
            $msg = 'Erro ao adicionar detalhes ao produto.';
            $msgClass = 'danger';
            $create = 'create';
        }

        return redirect("/app/produto-detalhe/$id/$create")->with(['msg' => $msg, 'msgClass' => $msgClass]);
    }

    public function edit($id)
    {
        $produtoDetalhe = ProdutoDetalhe::find($id);
        $produto = Produto::find($produtoDetalhe->produto_id);
        $unidades = Unidade::all();

        if (!$produtoDetalhe) {
            return redirect()->route('produto-detalhe.index')->with(['produto' => $produto, 'msg' => 'Datelhes do produto não encontrado.', 'msgClass' => 'danger', 'unidades' => $unidades]);
        }

        return view('app.produto-detalhe.edit', compact(['produto', 'unidades', 'produtoDetalhe']));
    }

    public function update(Request $req, $id)
    {
        $edit = '';
        $validator = $this->validateRequest($req);

        $data = $req->except('_token');

        if ($validator->fails()) {
            return redirect()->route('produto-detalhe.edit', ['id' => $id])->withErrors($validator)->withInput();
        }

        try {
            ProdutoDetalhe::where('id', $id)->update($data);
            $msg = 'Detalhes do produto atualizados com sucesso.';
            $msgClass = 'success';
        } catch (\Exception $e) {
            $msg = 'Erro ao atualizar detalhes do produto.';
            $msgClass = 'danger';
            $edit = 'edit/';
        }

        return redirect("/app/produto-detalhe/$edit$id")->with(['msg' => $msg, 'msgClass' => $msgClass]);
    }

    public function destroy(string $id)
    {
        //
    }
}
