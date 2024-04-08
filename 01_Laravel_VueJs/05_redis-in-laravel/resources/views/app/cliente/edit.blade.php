@extends('app.index')

@section('titulo', 'Clientes')
@section('content')

<div class="p-5">
    <h1 class="text-dark mb-5"><span style="font-size: 1.2rem">Edição de dados do cliente:</span> {{ $cliente->nome }}</h1>

    <div class="d-flex flex-column gap-4">
        <div id="formularioCliente" class="col-lg-6 m-auto">
            @component(
                'app.cliente.formulario',
                [
                    'action' => "/app/clientes/edit/{$cliente->id}",
                    'metodo' => 'post',
                    'classe' => 'borda-preta',
                    'data' => $cliente,
                    'btnCancelar' => true,
                ],
            )
            @endcomponent
        </div>
    </div>
</div>

@endsection
