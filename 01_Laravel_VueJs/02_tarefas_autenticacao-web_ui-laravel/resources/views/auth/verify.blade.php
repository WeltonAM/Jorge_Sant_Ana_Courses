@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Falta pouco! Precisamos que valide seu email!</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            Um novo email de verificação foi enviado.
                        </div>
                    @endif

                    Antes de utilizar os recursos da aplicação, por favor valide seu email por meio do link de verificação que te enviamos.
                    <br>
                    <br>

                    Caso você não tenha recebido o email de verificação:
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">clique aqui para solicitar novo email de verificação</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
