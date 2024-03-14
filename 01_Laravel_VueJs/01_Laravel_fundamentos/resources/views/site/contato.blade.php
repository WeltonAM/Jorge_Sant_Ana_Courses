@extends('welcome')

@section('titulo', 'Contato')

@section('content')
    <div class="conteudo-pagina">
        <div class="titulo-pagina">
            <h1>Entre em contato conosco</h1>
        </div>

        <div class="informacao-pagina">
            <div class="contato-principal">
                @component('components.formulario', ['action' => '\contato', 'metodo' => 'post', 'classe' => 'borda-preta'])
                    <p>A nossa equipe analisará a sua mensagem e retornaremos o mais brevemente possível.</p>
                    <p>Nosso tempo médio de resposta é de 48h.</p>
                @endcomponent
            </div>
        </div>
    </div>
@endsection
