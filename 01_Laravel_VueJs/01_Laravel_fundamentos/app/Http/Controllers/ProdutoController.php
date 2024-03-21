<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Unidade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProdutoController extends Controller
{
    public function index(Request $req)
    {
        $produtos = Produto::all();
        $unidades = Unidade::all();

        return view('app.produto.index', ['produtos' => $produtos, 'unidades' => $unidades, 'create' => $req['create'] ?? null]);
    }

    protected function validateRequest(Request $request)
    {
        return Validator::make($request->all(), [
            'nome' => 'required|min:3|max:40',
            'descricao' => 'required|min:3|max:2000',
            'peso' => 'required|integer',
            'unidade' => 'exists:unidades,id'
        ], [
            'required' => 'O campo [:attribute] deve ser preenchido',

            'nome.min' => 'O campo [Nome] deve ter no mínimo 3 caracteres.',
            'nome.max' => 'O campo [Nome] deve ter no máximo 40 caracteres.',

            'descricao.min' => 'O campo [Descrição] deve ter no mínimo 3 caracteres.',
            'descricao.max' => 'O campo [Descrição] deve ter no máximo 40 caracteres.',

            'peso.integer' => '[Peso] deve conter somente números.',

            'unidade.exists' => '[Unidade] não salva.',
        ]);
    }

    public function store(Request $request)
    {
        $create = '';

        $validator = $this->validateRequest($request);

        if ($validator->fails()) {
            return redirect('/app/produtos/create')->withErrors($validator)->withInput();
        }

        $nome = $request->input('nome');
        $descricao = $request->input('descricao');
        $peso = $request->input('peso');
        $unidade_id = $request->input('unidade');

        try {
            $produto = new Produto();

            $produto->nome = $nome;
            $produto->descricao = $descricao;
            $produto->peso = $peso;
            $produto->unidade_id = $unidade_id;

            $produto->save();

            $msg = 'Produto cadastrado com sucesso.';
            $msgClass = 'success';
        } catch (\Exception $e) {
            $msg = 'Erro ao cadastrar produto.';
            $msgClass = 'danger';
            $create = 'create';
        }

        return redirect("/app/produtos/$create")->with(['msg' => $msg, 'msgClass' => $msgClass]);
    }

    public function edit($id)
    {
        $produto = Produto::find($id);
        $unidades = Unidade::all();

        if (!$produto) {
            return redirect()->route('produtos.index')->with(['msg' => 'Produto não encontrado.', 'msgClass' => 'danger', 'unidades' => $unidades]);
        }

        return view('app.produto.edit', compact(['produto', 'unidades']));
    }

    public function update(Request $request, $produtoId)
    {
        $edit = '';
        $validator = $this->validateRequest($request);

        if ($validator->fails()) {
            return redirect("/app/produtos/$produtoId/edit")->withErrors($validator)->withInput();
        }

        try {
            $produto = Produto::find($produtoId);
            if (!$produto) {
                return redirect()->route('produtos.index')->with(['msg' => 'Produto não encontrado.', 'msgClass' => 'danger']);
            }

            $produto->nome = $request->input('nome');
            $produto->descricao = $request->input('descricao');
            $produto->peso = $request->input('peso');
            $produto->unidade_id = $request->input('unidade');

            $produto->save();

            $msg = 'Produto atualizado com sucesso.';
            $msgClass = 'success';
        } catch (\Exception $e) {
            dd($e);
            $msg = 'Erro ao atualizar produto.';
            $msgClass = 'danger';
            $edit = 'edit';
        }

        return redirect("/app/produtos/$edit")->with(['msg' => $msg, 'msgClass' => $msgClass]);
    }

    public function delete($produtoId)
    {
        try {
            Produto::find($produtoId)->delete();
            $msg = 'Produto deletado com sucesso.';
            $msgClass = 'success';
        } catch (\Exception $e) {
            $msg = 'Erro ao deletar produto.';
            $msgClass = 'danger';
        }

        return redirect("/app/produtos")->with(['msg' => $msg, 'msgClass' => $msgClass]);
    }
}
