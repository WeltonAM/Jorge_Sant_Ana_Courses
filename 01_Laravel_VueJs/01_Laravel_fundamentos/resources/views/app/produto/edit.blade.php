@extends('app.index')

@section('titulo', 'Produtos')
@section('content')

<div class="p-5">
    <h1 class="text-dark mb-5"><span style="font-size: 1.2rem">Edição de Produto:</span> {{ $produto->nome }}</h1>

    <div class="d-flex flex-column gap-4">
        <div id="formularioProduto" class="col-lg-6 m-auto">
            @component(
                'app.produto.formulario',
                [
                    'action' => "/app/produtos/edit/{$produto->id}",
                    'metodo' => 'post',
                    'classe' => 'borda-preta',
                    'data' => $produto,
                    'btnCancelar' => true,
                ],
            )
            @endcomponent
        </div>
    </div>
</div>

@endsection
