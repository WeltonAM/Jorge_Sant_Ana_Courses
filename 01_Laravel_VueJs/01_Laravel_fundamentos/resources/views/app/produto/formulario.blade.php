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
        name="descricao"
        value="{{ isset($data->descricao) ? $data->descricao : old('descricao') }}"
        type="text"
        placeholder="Descrição"
        class="{{ $classe ?? '' }}"
    >
    <br>

    <input
        name="peso"
        value="{{ isset($data->peso) ? $data->peso : old('peso') }}"
        type="number"
        step="0.1"
        min="1"
        max="9999"
        placeholder="Peso"
        class="{{ $classe ?? '' }}"
    >
    <br>

    <select
        name="unidade"
        class="form-select {{ $classe ?? '' }}"
    >
        <option>Selecione Unidade de Medida</option>

        @if(isset($unidades))
            @foreach($unidades as $unidade)
                <option value="{{ $unidade->id }}" {{ old('unidade') == $unidade->id || (isset($data->unidade_id) && $data->unidade_id == $unidade->id) ? 'selected' : '' }}>{{ $unidade->descricao }}</option>
            @endforeach
        @endif
    </select>

    <br>

    <div class="d-flex gap-4">
        @if(isset($btnCancelar))
            <button type="button" id="btn-cancelar" class="btn-sm" style="background-color: red">Cancelar</button>
        @endif

        <button type="submit" class="btn-sm {{ $classe ?? '' }}">{{ isset($data->nome) ? 'Editar' : 'Enviar'}}</button>
    </div>
</form>

<script>
    document.getElementById('btn-cancelar').addEventListener('click', function() {
        window.location.href = '/app/produtos';
    });
</script>
