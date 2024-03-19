@extends('app.index')

@section('titulo', 'Fornecedores')
@section('content')

<div class="p-5">
    <h1 class="text-dark mb-5">Fornecedores</h1>

    <div class="d-flex flex-column gap-4">
        <div class="menu m-auto col-lg-8">
            <button id="btnNovoFornecedor" class="text-white" style="display: {{ isset($create) ? 'none' : 'block' }};">
                Novo
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                </svg>
            </button>
        </div>

        <div id="formularioFornecedor" style="display: {{ isset($create) ? 'block' : 'none' }};" class="col-lg-6 m-auto">
            @component(
                'app.fornecedor.formulario',
                [
                    'action' => '\app\fornecedores',
                    'metodo' => 'post',
                    'classe' => 'borda-preta',
                    'btnCancelar' => true,
                ],
            )
            @endcomponent
        </div>

        <div id="tabelaForneceor" style="display: {{ isset($create) ? 'none' : 'block' }};">
            @if (isset($fornecedores) && $fornecedores->count() > 0)
                <table class="table mb-4" id="fornecedoresTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Site</th>
                            <th>UF</th>
                            <th>Email</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($fornecedores as $fornecedor)
                        <tr>
                            <td>{{ $fornecedor->id }}</td>
                            <td>{{ $fornecedor->nome }}</td>
                            <td>{{ $fornecedor->site }}</td>
                            <td>{{ $fornecedor->uf }}</td>
                            <td>{{ $fornecedor->email }}</td>
                            <td>
                                <div class="d-flex">
                                    <a class="btn btn-sm" href="{{ route('fornecedores.edit', ['id' => $fornecedor->id]) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                        </svg>
                                    </a>

                                    <a class="btn btn-sm" href="{{ route('fornecedores.delete', ['id' => $fornecedor->id]) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                            <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
                                        </svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>Nenhum fornecedor cadastrado</p>
            @endif
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
        $('#fornecedoresTable').DataTable({
            language: {
                url:"https://cdn.datatables.net/plug-ins/1.11.5/i18n/pt-BR.json"
            }
        });

        $('#btnNovoFornecedor').click(function(e) {
            e.preventDefault();
            $('#formularioFornecedor').show();
            $('#tabelaForneceor').hide();
            $('#btnNovoFornecedor').hide();
        });

        $('#fornecedoresTable_previous').css('display', 'none');
        $('#fornecedoresTable_next').css('display', 'none');
    });
</script>

@endsection
