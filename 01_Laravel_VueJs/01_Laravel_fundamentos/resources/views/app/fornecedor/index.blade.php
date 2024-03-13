@extends('welcome')

@section('content')

<h1>Fornecedor</h1>

@if (isset($fornecedores))
    @foreach ($fornecedores as $f)
        <p>{{$f}}</p>
    @endforeach
@else
    <p>Nenhum fornecedor cadastrado</p>
@endif

@endsection
