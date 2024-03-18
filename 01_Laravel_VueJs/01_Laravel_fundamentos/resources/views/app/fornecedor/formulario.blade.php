<form
    @if(isset($action)) action="{{ $action }}" @endif
    @if(isset($metodo)) method="{{ $metodo }}" @endif
>
    @csrf

    <input
        name="nome"
        value="{{ isset($data->nome) ? $data->nome : old('nome') }}"
        type="text"
        placeholder="Nome"
        class="{{ $classe ?? '' }}"
    >
    <br>

    <input
        name="site"
        value="{{ isset($data->site) ? $data->site : old('site') }}"
        type="text"
        placeholder="Site"
        class="{{ $classe ?? '' }}"
    >
    <br>

    <input
        name="uf"
        value="{{ isset($data->uf) ? $data->uf : old('uf') }}"
        type="text"
        placeholder="Estado"
        class="{{ $classe ?? '' }}"
    >
    <br>

    <input
        name="email"
        value="{{ isset($data->email) ? $data->email : old('email') }}"
        type="text"
        placeholder="E-mail"
        class="{{ $classe ?? '' }}"
    >
    <br>

    <button type="submit" class="{{ $classe ?? '' }}">{{ isset($data->email) ? 'Editar' : 'Enviar'}}</button>
</form>
