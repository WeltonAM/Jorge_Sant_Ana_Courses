{{$slot}}

<form
    @if(isset($action)) action="{{ $action }}" @endif
    @if(isset($metodo)) method="{{ $metodo }}" @endif
>
    @csrf

    <input
        name="nome"
        value="{{ old('nome') ? old('nome') : '' }}"
        type="text"
        placeholder="Nome"
        class={{$classe ?? ''}}
    >
    <br>

    <input
        name="telefone"
        value="{{ old('telefone') ? old('telefone') : '' }}"
        type="text"
        placeholder="Telefone"
        class={{$classe ?? ''}}
    >
    <br>

    <input
        name="email"
        value="{{ old('email') ? old('email') : '' }}"
        type="text"
        placeholder="E-mail"
        class={{$classe ?? ''}}
    >
    <br>

    <select name="motivo_contatos_id" class={{$classe ?? ''}}>
        <option value="">Qual o motivo do contato?</option>

        @if(isset($data))
            @foreach ($data as $m)
                <option value="{{ $m->id }}" {{ old('motivo_contatos_id') == $m->id ? 'selected' : '' }} >{{ $m->motivo_contato }}</option>
            @endforeach
        @endif
    </select>
    <br>

    <textarea name="mensagem" class={{$classe ?? ''}} placeholder="Preencha aqui a sua mensagem">@if(old('mensagem')){{ old('mensagem') }}@endif</textarea>
    <br>

    <button type="submit" class={{$classe ?? ''}}>ENVIAR</button>
</form>
