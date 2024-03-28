<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Repositories\ClienteRepository;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    protected $cliente;

    public function __construct(Cliente $cliente)
    {
        $this->cliente = $cliente;
    }

    public function index(Request $request)
    {
        $clienteRepository = new ClienteRepository($this->cliente);

        if ($request->has('atributos_locacoes')) {
            $atributos_locacoes = 'locacoes:id,' . $request->atributos_locacoes;

            $clienteRepository->selectAtributosRelacionados($atributos_locacoes);
        } else {
            $clienteRepository->selectAtributosRelacionados('locacoes');
        }

        if ($request->has('filtro')) {
            $clienteRepository->filtro($request->filtro);
        }

        if ($request->has('atributos')) {
            $clienteRepository->selectAtributos($request->atributos);
        }

        return response()->json($clienteRepository->getResultado(), 200);
    }

    public function store(Request $request)
    {
        $request->validate($this->cliente->rules(), $this->cliente->feedback());

        $cliente = $this->cliente->create([
            'nome' => $request->nome,
        ]);

        return response()->json($cliente, 201);
    }

    public function show(Int $id)
    {
        $cliente = $this->cliente->with('locacoes')->find($id);

        if (!$cliente) {
            return response()->json(['erro' => 'Cliente não encontrado.'], 404);
        }

        return response()->json($cliente, 200);
    }

    public function update(Request $request, Int $id)
    {
        $cliente = $this->cliente->find($id);

        if (!$cliente) {
            return response()->json(['erro' => 'Cliente não encontrado.'], 404);
        }

        if ($request->method() === 'PATCH') {

            $regrasDinamicas = array();

            foreach ($cliente->rules() as $input => $regra) {
                if (array_key_exists($input, $request->all())) {
                    $regrasDinamicas[$input] = $regra;
                }
            }

            $request->validate($regrasDinamicas, $cliente->feedback());
        } else {
            $request->validate($cliente->rules(), $cliente->feedback());
        }

        $cliente->fill($request->all());
        $cliente->save();

        return response()->json($cliente, 200);
    }

    public function destroy(Int $id)
    {
        $cliente = $this->cliente->find($id);

        if (!$cliente) {
            return response()->json(['erro' => 'Cliente não encontrado.'], 404);
        }

        $cliente->delete();
        return response()->json(['msg' => 'O Cliente foi removido com sucesso!'], 200);
    }
}
