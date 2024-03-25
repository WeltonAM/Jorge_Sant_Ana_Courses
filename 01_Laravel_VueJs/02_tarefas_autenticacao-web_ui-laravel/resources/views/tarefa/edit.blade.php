@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Editar tarefa: {{ $tarefa->tarefa }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('tarefa.update', ['tarefa' => $tarefa->id]) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                          <label for="tareda">Tarefa</label>
                          <input type="text" id="tarefa" class="form-control" placeholder="Nova tarefa" value="{{ $tarefa->tarefa }}" name="tarefa">
                        </div>
                        <br>

                        <div class="form-group">
                            <label for="data_limite_conclusao">Data de Conclusão</label>
                            <input type="date" class="form-control" id="data_limite_conclusao" value="{{ $tarefa->data_limite_conclusao }}" name="data_limite_conclusao">
                        </div>
                        <br>

                        <button type="submit" class="btn btn-primary">Editar</button>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
