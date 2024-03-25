@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        Tarefas
                    </div>

                    <div class="d-flex gap-4">
                        <a href="{{ route('tarefa.exportacao', ['ext' => 'pdf']) }}" class="btn btn-dark">
                            PDF
                        </a>

                        <a href="{{ route('tarefa.exportacao', ['ext' => 'csv']) }}" class="btn btn-dark">
                            CSV
                        </a>

                        <a href="{{ route('tarefa.exportacao', ['ext' => 'xlsx']) }}" class="btn btn-dark">
                            XLSX
                        </a>

                        <a href="{{ route('tarefa.create') }}" class="btn btn-primary">
                            Nova Tarefa
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    @if(isset($tarefas) && $tarefas->count() > 0)
                        <table class="table table-striped" id="tabelaTarefas">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tarefas</th>
                                    <th scope="col">Data Limite</th>
                                    <th scope="col">Ações</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($tarefas as $t)
                                    <tr>
                                        <th scope="">{{ $t->id }}</th>
                                        <td>{{ $t->tarefa }}</td>
                                        <td>{{ date('d/m/Y', strtotime($t->data_limite_conclusao)) }}</td>
                                        <td class="d-flex justify-items-center align-items-center gap-4">
                                            <a href="{{ route('tarefa.edit', ['tarefa' => $t->id]) }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                                </svg>
                                            </a>

                                            <div>
                                                <form method="POST" action="{{ route('tarefa.destroy', ['tarefa' => $t->id]) }}">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-danger">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                                            <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div>
                            Nenhuma tarefa cadastrada
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script>

    $(document).ready(function() {

        $('#tabelaTarefas').DataTable({
            language: {
                url:"https://cdn.datatables.net/plug-ins/1.11.5/i18n/pt-BR.json"
            }
        });

        $('#tabelaTarefas_previous').css('display', 'none');
        $('#tabelaTarefas_next').css('display', 'none');
    });
</script>

@endsection
