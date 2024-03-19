<?php

namespace App\Http\Controllers;

use App\Models\Fornecedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FornecedorController extends Controller
{
    public function index(Request $req)
    {
        $fornecedores = Fornecedor::all();

        return view('app.fornecedor.index', ['fornecedores' => $fornecedores, 'create' => $req['create'] ?? null]);
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
            return redirect('/app/fornecedores/create')->withErrors($validator)->withInput();
        }

        try {
            Fornecedor::create($request->all());
            $msg = 'Fornecedor cadastrado com sucesso.';
            $msgClass = 'success';
        } catch (\Exception $e) {
            $msg = 'Erro ao cadastrar fornecedor.';
            $msgClass = 'danger';
            $create = 'create';
        }

        return redirect("/app/fornecedores/$create")->with(['msg' => $msg, 'msgClass' => $msgClass]);
    }

    public function edit($id)
    {
        $fornecedor = Fornecedor::find($id);

        if (!$fornecedor) {
            return redirect()->route('fornecedores.index')->with(['msg' => 'Fornecedor não encontrado.', 'msgClass' => 'danger']);
        }

        return view('app.fornecedor.edit', compact('fornecedor'));
    }

    public function update(Request $request, $fornecedorId)
    {
        $edit = '';
        $validator = $this->validateRequest($request);

        $data = $request->except('_token');

        if ($validator->fails()) {
            return redirect('/app/fornecedores/edit')->withErrors($validator)->withInput();
        }

        try {
            Fornecedor::where('id', $fornecedorId)->update($data);
            $msg = 'Fornecedor atualizado com sucesso.';
            $msgClass = 'success';
        } catch (\Exception $e) {
            dd($e);
            $msg = 'Erro ao atualizar fornecedor.';
            $msgClass = 'danger';
            $edit = 'edit';
        }

        return redirect("/app/fornecedores/$edit")->with(['msg' => $msg, 'msgClass' => $msgClass]);
    }
}
