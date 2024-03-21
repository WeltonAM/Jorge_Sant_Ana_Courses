@extends('app.index')

@section('titulo', 'Detalhes')
@section('content')

    <div class="p-5">
        <h1 class="text-dark mb-5"><span style="font-size: 1.2rem">Edição de detalhes do produto:</span> {{ $produto->nome }}</h1>

        <div class="d-flex flex-column gap-4">
            <div id="formularioProduto" class="col-lg-6 m-auto">
                @component(
                    'app.produto-detalhe.formulario',
                    [
                        'action' => "/app/produto-detalhe/edit/{$produtoDetalhe->id}",
                        'metodo' => 'post',
                        'classe' => 'borda-preta',
                        'btnCancelar' => true,
                        'produtoId' => $produto->id,
                        'unidades' => $unidades,
                        'data' => $produtoDetalhe,
                    ],
                )
                @endcomponent
            </div>
        </div>
    </div>

@endsection
