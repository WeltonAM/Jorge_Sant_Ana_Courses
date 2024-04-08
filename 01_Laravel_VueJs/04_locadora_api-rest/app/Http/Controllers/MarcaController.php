<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use App\Repositories\MarcaRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MarcaController extends Controller
{
    protected $marca;

    public function __construct(Marca $marca)
    {
        $this->marca = $marca;
    }

    public function index(Request $request)
    {
        $marcaRepository = new MarcaRepository($this->marca);

        if ($request->has('atributos_modelos')) {
            $atributos_modelos = 'modelos:id,' . $request->atributos_modelos;

            $marcaRepository->selectAtributosRelacionados($atributos_modelos);
        } else {
            $marcaRepository->selectAtributosRelacionados('modelos');
        }

        if ($request->has('filtro')) {
            $marcaRepository->filtro($request->filtro);
        }

        if ($request->has('atributos')) {
            $marcaRepository->selectAtributos($request->atributos);
        }

        return response()->json($marcaRepository->getResultadoPaginado(3), 200);
    }

    public function store(Request $request)
    {
        $request->validate($this->marca->rules(), $this->marca->feedback());

        $imagem = $request->file('imagem');
        $imagem_urn = $imagem->store('imagens', 'public');

        $marca = $this->marca->create([
            'nome' => $request['nome'],
            'imagem' => $imagem_urn,
        ]);

        return response()->json($marca, 201);
    }

    public function show(Int $id)
    {
        $marca = $this->marca->with('modelos')->find($id);

        if (!$marca) {
            return response()->json(['erro' => 'Marca não encontrada.'], 404);
        }

        return response()->json($marca, 200);
    }

    public function update(Request $request, Int $id)
    {
        $marca = $this->marca->find($id);

        if (!$marca) {
            return response()->json(['erro' => 'Marca não encontrada.'], 404);
        }

        if ($request->filled('nome')) {
            $request->validate([
                'nome' => 'required|unique:marcas,nome,' . $marca->id . '|min:3',
            ], $marca->feedback());

            $marca->nome = $request->nome;
        } else if ($request->hasFile('imagem')) {
            $request->validate([
                'imagem' => 'required|file|mimes:png,jpg,jpeg',
            ], $marca->feedback());

            Storage::disk('public')->delete($marca->imagem);

            $imagem = $request->file('imagem');
            $imagem_urn = $imagem->store('imagens', 'public');
            $marca->imagem = $imagem_urn;
        } else if (!$request->filled('nome') && !$request->hasFile('imagem')) {
            $request->validate($marca->rules(), $marca->feedback());
        }

        $marca->save();

        return response()->json($marca, 200);
    }

    public function destroy(Int $id)
    {
        $marca = $this->marca->find($id);

        if ($marca === null) {
            return response()->json(['erro' => 'Marca não encontrada.'], 404);
        }

        $modelos = $marca->modelos;
        if ($modelos->isNotEmpty()) {
            return response()->json(['erro' => 'Esta marca possui modelos associados. Exclua os modelos primeiro.'], 422);
        }

        Storage::disk('public')->delete($marca->imagem);

        $marca->delete();
        return response()->json(['msg' => 'A marca foi removida com sucesso!'], 200);
    }
}
