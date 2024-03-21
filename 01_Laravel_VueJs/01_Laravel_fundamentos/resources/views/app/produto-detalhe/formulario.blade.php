<form
    @if(isset($action)) action="{{ $action }}" @endif
    @if(isset($metodo)) method="{{ $metodo }}" @endif
>
    @csrf

    <input type="hidden" name="produto_id" value="{{ $produtoId }}">

    <input
        name="produto_id"
        value="{{ isset($data->produto_id) ? $data->produto_id : old('produto_id') }}"
        type="number"
        step="1"
        placeholder="Id do Produto"
        class="{{ $classe ?? '' }}"
    >
    <br>

    <input
        name="comprimento"
        value="{{ isset($data->comprimento) ? $data->comprimento : old('comprimento') }}"
        type="number"
        step="0.1"
        min="1"
        max="9999"
        placeholder="Comprimento"
        class="{{ $classe ?? '' }}"
    >
    <br>

    <input
        name="largura"
        value="{{ isset($data->largura) ? $data->largura : old('largura') }}"
        type="number"
        step="0.1"
        placeholder="Largura"
        class="{{ $classe ?? '' }}"
    >
    <br>

    <input
        name="altura"
        value="{{ isset($data->altura) ? $data->altura : old('altura') }}"
        type="number"
        step="0.1"
        placeholder="Altura"
        class="{{ $classe ?? '' }}"
    >
    <br>

    <select
        name="unidade_id"
        class="form-select {{ $classe ?? '' }}"
    >
        <option>Selecione Unidade de Medida</option>

        @if(isset($unidades))
            @foreach($unidades as $unidade)
                <option value="{{ $unidade->id }}" {{ old('unidade_id') == $unidade->id || (isset($data->unidade_id) && $data->unidade_id == $unidade->id) ? 'selected' : '' }}>{{ $unidade->descricao }}</option>
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
        window.location.href = '/app/produto-detalhe/' + {{ $produtoId }};
    });
</script>
