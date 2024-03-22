@extends('app.index')

@section('titulo', 'Pedidos')
@section('content')

<div class="p-5">
    <h1 class="text-dark mb-5"><span style="font-size: 1.2rem">Edição de dados do pedido:</span> {{ $pedido->id }}</h1>

    <div class="d-flex flex-column gap-4">
        <div id="formularioCliente" class="col-lg-6 m-auto">
            @component(
                'app.pedido.formulario',
                [
                    'action' => "/app/pedidos/edit/{$pedido->id}",
                    'metodo' => 'post',
                    'classe' => 'borda-preta',
                    'data' => $clientes,
                    'btnCancelar' => true,
                ],
            )
            @endcomponent
        </div>
    </div>
</div>

@endsection
