@extends('welcome')

@section('titulo', 'Contato')

@section('content')
    <div class="conteudo-pagina">
        <div class="titulo-pagina">
            <h1>Entre em contato conosco</h1>
        </div>

        <div class="informacao-pagina">
            <div class="contato-principal">
                <form action="/contato" method="POST">
                    @csrf
                    <input name="nome" type="text" placeholder="Nome" class="borda-preta">
                    <br>

                    <input name="telefone" type="text" placeholder="Telefone" class="borda-preta">
                    <br>

                    <input name="email" type="text" placeholder="E-mail" class="borda-preta">
                    <br>

                    <select name="motivo_contato" class="borda-preta">
                        <option value="">Qual o motivo do contato?</option>
                        <option value="1">Dúvida</option>
                        <option value="2">Elogio</option>
                        <option value="3">Reclamação</option>
                    </select>
                    <br>

                    <textarea class="borda-preta" placeholder="Preencha aqui a sua mensagem"></textarea>
                    <br>

                    <button type="submit" class="borda-preta">ENVIAR</button>
                </form>
            </div>
        </div>
    </div>
@endsection
