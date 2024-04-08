@extends('app.index')

@section('titulo', 'Pedidos')
@section('content')

    <div class="p-5">
        <h1 class="text-dark mb-5">Pedidos</h1>

        <div class="d-flex flex-column gap-4">
            <div class="menu m-auto col-lg-8">
                <button id="btnNovoPedido" class="text-white" style="display: {{ isset($create) ? 'none' : 'block' }};">
                    Novo
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                    </svg>
                </button>
            </div>

            <div id="formularioPedido" style="display: {{ isset($create) ? 'block' : 'none' }};" class="col-lg-6 m-auto">
                @component(
                    'app.pedido.formulario',
                    [
                        'action' => '\app\pedidos',
                        'metodo' => 'post',
                        'classe' => 'borda-preta',
                        'btnCancelar' => true,
                        'data' => $clientes,
                    ],
                )
                @endcomponent
            </div>

            <div id="tabelaPedido" style="display: {{ isset($create) ? 'none' : 'block' }};">
                @if (isset($pedidos) && $pedidos->count() > 0)
                    <table class="table mb-4" id="pedidoTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Cliente</th>
                                <th class="text-center">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pedidos as $p)
                            <tr>
                                <td>{{ $p->id }}</td>
                                <td>{{ $p->cliente_id }}</td>
                                <td>
                                    <div class="d-flex justify-content-center align-items-center">
                                        <a title="Adicionar produto" class="btn btn-sm w-50" href="{{ route('pedido-produto.index', ['id' => $p->id]) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                                            </svg>
                                        </a>

                                        <a title="Editar" class="btn btn-sm w-50" href="{{ route('pedido.edit', ['id' => $p->id]) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                            </svg>
                                        </a>

                                        <button title="Deletar" class="btn btn-sm w-50" style="background-color: transparent; color: #000; border-color: transparent;" onclick="openConfirmModal('{{ $p->id }}')">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                                <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-dark">Nenhum pedidos cadastrado</p>
                @endif
            </div>
        </div>
    </div>

    @include('components.modalExclusao', [
        'modalId' => 'confirmDeleteModal',
        'modalTitle' => 'Confirmar Exclusão',
        'modalMessage' => 'Tem certeza que deseja excluir este pedido?',
        'confirmBtnId' => 'confirmDeleteBtn',
        'confirmBtnText' => 'Excluir',
    ])

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

    <script>
        function openConfirmModal(id) {
            console.log(id);
            var deleteUrl = `pedidos/delete/${id}`;
            $('#confirmDeleteBtn').attr('href', deleteUrl);
            $('#confirmDeleteModal').modal('show');
        }

        $(document).ready(function() {
            $('#pedidoTable').DataTable({
                language: {
                    url:"https://cdn.datatables.net/plug-ins/1.11.5/i18n/pt-BR.json"
                }
            });

            $('#btnNovoPedido').click(function(e) {
                e.preventDefault();
                $('#formularioPedido').show();
                $('#tabelaPedido').hide();
                $('#btnNovoPedido').hide();
            });

            $('#pedidoTable_previous').css('display', 'none');
            $('#pedidoTable_next').css('display', 'none');
        });
    </script>

@endsection
