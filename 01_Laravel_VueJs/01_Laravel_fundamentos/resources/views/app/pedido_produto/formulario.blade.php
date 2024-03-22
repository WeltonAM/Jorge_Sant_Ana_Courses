<form
    @if(isset($action)) action="{{ $action }}" @endif
    @if(isset($metodo)) method="{{ $metodo }}" @endif
>
    @csrf

    <input type="hidden" name="pedido_id" value="{{ $pedidoId }}">

    <select
        name="produto_id"
        class="form-select {{ $classe ?? '' }}"
    >
        <option style="padding: 5px 10px;">Selecione um Produto</option>

        @if(isset($produtos))
            @foreach($produtos as $p)
                <option style="padding: 5px 10px;" value="{{ $p->id }}" {{ old('produto_id') == $p->id || (isset($data->produto_id) && $data->produto_id == $p->id) ? 'selected' : '' }}>{{ $p->descricao }}</option>
            @endforeach
        @endif
    </select>
    <br>

    <input
        type="number"
        name="quantidade"
        value="{{ old('quantidade') ? old('quantidade') : '' }}"
        placeholder="Quantidade"
        class="{{ $classe ?? '' }}"
    >
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
        window.location.href = '/app/pedido-produto/' + {{ $pedidoId }};
    });
</script>
