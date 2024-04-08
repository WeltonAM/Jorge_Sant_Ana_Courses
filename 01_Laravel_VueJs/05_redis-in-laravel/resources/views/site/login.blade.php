@extends('welcome')

@section('titulo', 'Login')

@section('content')
    <div class="conteudo-pagina">
        <div class="titulo-pagina">
            <h1>Acessar ao sistema</h1>
        </div>

        <div class="informacao-pagina">
            <div class="contato-principal">
                <form action="{{ route('login') }}" method="POST">
                    @csrf

                    <div class="d-flex flex-column justify-center align-items-center">
                        <div class="col-lg-6">
                            <input name="email" value="{{ old('email') }}" type="email" placeholder="Digite seu Email" class="form-control borda-preta">
                        </div>

                        <div class="col-lg-6">
                            <input name="senha" value="{{ old('senha') }}" type="password" placeholder="Digite sua Senha" class="form-control borda-preta">
                        </div>

                        <button type="submit" class="col-lg-6 borda-preta">Acessar</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection
