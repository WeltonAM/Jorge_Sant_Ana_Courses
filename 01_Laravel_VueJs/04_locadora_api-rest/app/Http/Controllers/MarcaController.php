<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MarcaController extends Controller
{
    protected $marca;

    public function __construct(Marca $marca)
    {
        $this->marca = $marca;
    }

    public function index()
    {
        $marcas = $this->marca->all();
        return response()->json($marcas, 200);
    }

    protected function validateRequest(Request $request)
    {
        return Validator::make($request->all(), [
            'nome' => 'required|unique:marcas',
            'imagem' => 'required'
        ], [
            'required' => 'O campo [:attribute] é obrigatório.',
            'nome.unique' => 'O [nome] da marca já existe.',
        ]);
    }

    public function store(Request $request)
    {
        $validator = $this->validateRequest($request);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return response()->json(['erro' => $errors], 422);
        }

        $marca = $this->marca->create($request->all());
        return response()->json($marca, 201);
    }

    public function show(Int $id)
    {
        $marca = $this->marca->find($id);

        if (!$marca) {
            return response()->json(['erro' => 'Marca não encontrada.'], 404);
        }

        return response()->json($marca, 200);
    }

    public function update(Request $request, Int $id)
    {
        $validator = $this->validateRequest($request);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return response()->json(['erro' => $errors], 422);
        }

        $marca = $this->marca->find($id);

        if (!$marca) {
            return response()->json(['erro' => 'Marca não encontrada.'], 404);
        }

        $marca->update($request->all());
        return response()->json($marca, 200);
    }

    public function destroy(Int $id)
    {
        $marca = $this->marca->find($id);

        if (!$marca) {
            return response()->json(['erro' => 'Marca não encontrada.'], 404);
        }

        $marca->delete();
        return response()->json(['msg' => 'A marca foi removida com sucesso!'], 200);
    }
}
