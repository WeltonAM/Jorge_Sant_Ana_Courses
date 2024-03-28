<?php

namespace App\Http\Controllers;

use App\Models\Carro;
use App\Repositories\CarroRepository;
use Illuminate\Http\Request;

class CarroController extends Controller
{
    protected $carro;

    public function __construct(Carro $carro)
    {
        $this->carro = $carro;
    }

    public function index(Request $request)
    {
        $carroRepository = new CarroRepository($this->carro);

        if ($request->has('atributos_modelo')) {
            $atributos_modelo = 'modelo:id,' . $request->atributos_modelo;

            $carroRepository->selectAtributosRelacionados($atributos_modelo);
        } else {
            $carroRepository->selectAtributosRelacionados('modelo');
        }

        if ($request->has('filtro')) {
            $carroRepository->filtro($request->filtro);
        }

        if ($request->has('atributos')) {
            $carroRepository->selectAtributos($request->atributos);
        }

        return response()->json($carroRepository->getResultado(), 200);
    }

    public function store(Request $request)
    {
        $request->validate($this->carro->rules(), $this->carro->feedback());

        $carro = $this->carro->create([
            'modelo_id' => $request->modelo_id,
            'placa' => $request->placa,
            'disponivel' => $request->disponivel,
            'km' => $request->km,
        ]);

        return response()->json($carro, 201);
    }

    public function show(Int $id)
    {
        $carro = $this->carro->with('modelo')->find($id);

        if (!$carro) {
            return response()->json(['erro' => 'Carro não encontrado.'], 404);
        }

        return response()->json($carro, 200);
    }

    public function update(Request $request, Int $id)
    {
        $carro = $this->carro->find($id);

        if (!$carro) {
            return response()->json(['erro' => 'Carro não encontrado.'], 404);
        }

        if ($request->method() === 'PATCH') {

            $regrasDinamicas = array();

            foreach ($carro->rules() as $input => $regra) {
                if (array_key_exists($input, $request->all())) {
                    $regrasDinamicas[$input] = $regra;
                }
            }

            $request->validate($regrasDinamicas, $carro->feedback());
        } else {
            $request->validate($carro->rules(), $carro->feedback());
        }

        $carro->fill($request->all());
        $carro->save();

        return response()->json($carro, 200);
    }

    public function destroy(Int $id)
    {
        $carro = $this->carro->find($id);

        if (!$carro) {
            return response()->json(['erro' => 'Carro não encontrado.'], 404);
        }

        $carro->delete();
        return response()->json(['msg' => 'O carro foi removido com sucesso!'], 200);
    }
}
