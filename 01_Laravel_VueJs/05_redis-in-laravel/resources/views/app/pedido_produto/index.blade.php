@extends('app.index')

@section('titulo', 'Pedido Produto')
@section('content')

<div class="p-5">
    <h1 class="text-dark mb-5"><span style="font-size: 1.2rem">Adicionar Produtos ao Pedido:</span> {{ $pedido->id }}</h1>

    <div class="d-flex flex-column gap-4">
        <div class="menu m-auto col-lg-8">
            <button id="btnNovoProduto" class="text-white" style="display: {{ isset($create) ? 'none' : 'block' }};">
                Adicionar Produto
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                </svg>
            </button>
        </div>

        <div id="formularioPedido" style="display: {{ isset($create) ? 'block' : 'none' }};" class="col-lg-6 m-auto">
            @component(
                'app.pedido_produto.formulario',
                [
                    'action' => "/app/pedido-produto/$pedido->id",
                    'metodo' => 'post',
                    'classe' => 'borda-preta',
                    'pedidoId' => $pedido->id,
                    'produtos' => $produtos,
                    'btnCancelar' => true,
                ],
            )
            @endcomponent
        </div>

        <div id="tabelaProduto" style="display: {{ isset($create) ? 'none' : 'block' }};">
            @if (isset($pedido) && $pedido != null)
                <div class="container mt-5">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-header bg-primary text-white">
                                    Detalhes do Pedido
                                </div>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-striped">
                                            <tbody>
                                                <tr>
                                                    <th scope="row" class="fw-bold">Id do Pedido:</th>
                                                    <td class="text-center">{{ $pedido->id }}</td>
                                                </tr>

                                                <tr>
                                                    <th scope="row" class="fw-bold">Cliente:</th>
                                                    <td class="text-center">{{ $pedido->cliente_id }}</td>
                                                </tr>

                                                @if(isset($pedido->produtosPedido))
                                                    <tr>
                                                        <th scope="row" class="fw-bold">Produtos:</th>
                                                        <td class="text-center">
                                                            <ul class="list-unstyled">
                                                                @foreach($pedido->produtosPedido as $produto)
                                                                    <li class="p-2 bg-light">
                                                                        {{ $produto->nome }} -
                                                                        {{ $produto->pivot->quantidade }}
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                @endif

                                            </tbody>
                                        </table>
                                    </div>

                                    {{-- <div class="card-footer d-flex justify-content-end">
                                        <a
                                            class="btn btn-sm btn-info text-white"
                                            href="{{ route('pedido_produto.edit', ['id' => $pedido->id]) }}"
                                        >Editar pedido</a>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <p class="text-dark">Nenhum detalhe adicionado ao produto</p>
            @endif
        </div>
    </div>
</div>

@include('components.modalExclusao', [
    'modalId' => 'confirmDeleteModal',
    'modalTitle' => 'Confirmar Exclusão',
    'modalMessage' => 'Tem certeza que deseja excluir este produto?',
    'confirmBtnId' => 'confirmDeleteBtn',
    'confirmBtnText' => 'Excluir',
])

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    function openConfirmModal(produtoId) {
        console.log(produtoId);
        var deleteUrl = `produtos/delete/${produtoId}`;
        $('#confirmDeleteBtn').attr('href', deleteUrl);
        $('#confirmDeleteModal').modal('show');
    }

    $(document).ready(function() {
        $('#btnNovoProduto').click(function(e) {
            e.preventDefault();
            $('#formularioPedido').show();
            $('#tabelaProduto').hide();
            $('#btnNovoProduto').hide();
        });

        $('#produtosTable_previous').css('display', 'none');
        $('#produtosTable_next').css('display', 'none');
    });
</script>

@endsection
