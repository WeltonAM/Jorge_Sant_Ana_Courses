@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Adicionar nova tarefa</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('tarefa.store') }}">
                        @csrf

                        <div class="form-group">
                          <label for="tarefa">Tarefa</label>
                          <input type="text" id="tarefa" class="form-control" placeholder="Nova tarefa" name="tarefa">
                        </div>
                        <br>

                        <div class="form-group">
                            <label for="data_limite_conclusao">Data de Conclusão</label>
                            <input type="date" class="form-control" id="data_limite_conclusao" name="data_limite_conclusao">
                        </div>
                        <br>

                        <a href="{{ route('tarefa.index') }}" class="btn btn-secondary">Cancelar</a>

                        <button type="submit" class="btn btn-success">Adicionar</button>
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
