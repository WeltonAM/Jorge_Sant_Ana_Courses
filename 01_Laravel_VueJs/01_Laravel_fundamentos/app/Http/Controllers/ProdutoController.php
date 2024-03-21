<?php

namespace App\Http\Controllers;

use App\Models\Produto;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProdutoController extends Controller
{
    public function index(Request $req) {
        $produtos = Produto::all();

        return view('app.produto.index', ['produtos' => $produtos, 'create' => $req['create'] ?? null]);
    }

    protected function validateRequest(Request $request)
    {
        return Validator::make($request->all(), [
            'nome' => 'required|min:3|max:40',
            'site' => 'required',
            'uf' => 'required|min:2|max:2',
            'email' => 'email'
        ], [
            'required' => 'O campo [:attribute] deve ser preenchido',
            'nome.min' => 'O campo [nome] deve ter no mínimo 3 caracteres.',
            'nome.max' => 'O campo [nome] deve ter no máximo 40 caracteres.',
            'uf.min' => 'O campo [estado] deve ter no mínimo 2 caracteres.',
            'uf.max' => 'O campo [estado] deve ter no máximo 2 caracteres.',
            'email.email' => 'O campo [email] não foi preenchido corretamente.'
        ]);
    }

    public function store(Request $request)
    {
        $create = '';

        $validator = $this->validateRequest($request);

        if ($validator->fails()) {
            return redirect('/app/produtos/create')->withErrors($validator)->withInput();
        }

        try {
            Produto::create($request->all());
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

        if (!$produto) {
            return redirect()->route('produtos.index')->with(['msg' => 'Produto não encontrado.', 'msgClass' => 'danger']);
        }

        return view('app.produto.edit', compact('produto'));
    }

    public function update(Request $request, $produtoId)
    {
        $edit = '';
        $validator = $this->validateRequest($request);

        $data = $request->except('_token');

        if ($validator->fails()) {
            return redirect('/app/produtos/edit')->withErrors($validator)->withInput();
        }

        try {
            Produto::where('id', $produtoId)->update($data);
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
            dd($e);
            $msg = 'Erro ao deletar produto.';
            $msgClass = 'danger';
        }

        return redirect("/app/produtos")->with(['msg' => $msg, 'msgClass' => $msgClass]);
    }
}
