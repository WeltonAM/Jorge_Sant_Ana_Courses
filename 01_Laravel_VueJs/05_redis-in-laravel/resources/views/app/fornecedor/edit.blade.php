@extends('app.index')

@section('titulo', 'Fornecedores')
@section('content')

<div class="p-5">
    <h1 class="text-dark mb-5"><span style="font-size: 1.2rem">Edição de Fornecedor:</span> {{ $fornecedor->nome }}</h1>

    <div class="d-flex flex-column gap-4">
        <div id="formularioFornecedor" class="col-lg-6 m-auto">
            @component(
                'app.fornecedor.formulario',
                [
                    'action' => "/app/fornecedores/edit/{$fornecedor->id}",
                    'metodo' => 'post',
                    'classe' => 'borda-preta',
                    'data' => $fornecedor,
                    'btnCancelar' => true,
                ],
            )
            @endcomponent
        </div>
    </div>
</div>

@endsection
