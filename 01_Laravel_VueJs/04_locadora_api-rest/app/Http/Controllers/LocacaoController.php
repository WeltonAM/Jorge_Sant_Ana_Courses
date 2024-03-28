<?php

namespace App\Http\Controllers;

use App\Models\Locacao;
use App\Repositories\LocacaoRepository;
use Illuminate\Http\Request;

class LocacaoController extends Controller
{
    protected $locacao;

    public function __construct(Locacao $locacao)
    {
        $this->locacao = $locacao;
    }

    public function index(Request $request)
    {
        $locacaoRepository = new LocacaoRepository($this->locacao);

        // if ($request->has('atributos_locacoes')) {
        //     $atributos_locacoes = 'locacoes:id,' . $request->atributos_locacoes;

        //     $locacaoRepository->selectAtributosRelacionados($atributos_locacoes);
        // } else {
        //     $locacaoRepository->selectAtributosRelacionados('locacoes');
        // }

        if ($request->has('filtro')) {
            $locacaoRepository->filtro($request->filtro);
        }

        if ($request->has('atributos')) {
            $locacaoRepository->selectAtributos($request->atributos);
        }

        return response()->json($locacaoRepository->getResultado(), 200);
    }

    public function store(Request $request)
    {
        $request->validate($this->locacao->rules(), $this->locacao->feedback());

        $locacao = $this->locacao->create([
            'cliente_id' => $request->cliente_id,
            'carro_id' => $request->carro_id,
            'data_inicio_periodo' => $request->data_inicio_periodo,
            'data_final_previsto_periodo' => $request->data_final_previsto_periodo,
            'data_final_realizado_periodo' => $request->data_final_realizado_periodo,
            'valor_diaria' => $request->valor_diaria,
            'km_inicial' => $request->km_inicial,
            'km_final' => $request->km_final,
        ]);

        return response()->json($locacao, 201);
    }

    public function show(Int $id)
    {
        $locacao = $this->locacao->with('locacoes')->find($id);

        if (!$locacao) {
            return response()->json(['erro' => 'Locação não encontrada.'], 404);
        }

        return response()->json($locacao, 200);
    }

    public function update(Request $request, Int $id)
    {
        $locacao = $this->locacao->find($id);

        if (!$locacao) {
            return response()->json(['erro' => 'Locação não encontrada.'], 404);
        }

        if ($request->method() === 'PATCH') {

            $regrasDinamicas = array();

            foreach ($locacao->rules() as $input => $regra) {
                if (array_key_exists($input, $request->all())) {
                    $regrasDinamicas[$input] = $regra;
                }
            }

            $request->validate($regrasDinamicas, $locacao->feedback());
        } else {
            $request->validate($locacao->rules(), $locacao->feedback());
        }

        $locacao->fill($request->all());
        $locacao->save();

        return response()->json($locacao, 200);
    }

    public function destroy(Int $id)
    {
        $locacao = $this->locacao->find($id);

        if (!$locacao) {
            return response()->json(['erro' => 'Locação não encontrada.'], 404);
        }

        $locacao->delete();
        return response()->json(['msg' => 'A Locação foi removida com sucesso!'], 200);
    }
}
