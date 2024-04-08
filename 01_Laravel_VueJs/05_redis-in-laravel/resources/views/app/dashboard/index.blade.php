@extends('app.index')

@section('titulo', 'Dashboard')
@section('content')

<div class="p-5">
    @if(session('msg'))
        @include('components.feedBack', ['msg' => session('msg') ?? null, 'msgClass' => session('msgClass') ?? ''])
    @endif

    <h1 class="text-dark">Dashboard</h1>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@endsection
