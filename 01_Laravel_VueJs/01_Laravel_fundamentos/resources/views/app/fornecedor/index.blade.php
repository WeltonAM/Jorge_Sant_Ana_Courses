@extends('welcome')

@section('titulo', 'Fornecedores')
@section('content')

<div class="p-5">
    <h1 class="text-dark">Fornecedores</h1>

    @if (isset($fornecedores) && $fornecedores->count() > 0)
        <table class="table" id="fornecedoresTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Site</th>
                    <th>UF</th>
                    <th>Email</th>
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
                    </tr>
                    @endforeach
                </tbody>
        </table>
    @else
        <p>Nenhum fornecedor cadastrado</p>
    @endif
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#fornecedoresTable').DataTable({
            language: {
                url:"https://cdn.datatables.net/plug-ins/1.11.5/i18n/pt-BR.json"
            }
        });

        $('#fornecedoresTable_previous').css('display', 'none');
        $('#fornecedoresTable_next').css('display', 'none');
    });
</script>

@endsection
