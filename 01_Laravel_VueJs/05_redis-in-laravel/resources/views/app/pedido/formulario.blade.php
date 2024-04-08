<form
    @if(isset($action)) action="{{ $action }}" @endif
    @if(isset($metodo)) method="{{ $metodo }}" @endif
>
    @csrf

    <select
        name="cliente_id"
        class="form-select {{ $classe ?? '' }}"
    >
        <option>Selecione um Cliente</option>

        @if(isset($data))
            @foreach($data as $c)
                <option value="{{ $c->cliente_id }}" {{ old('cliente_id') == $c->cliente_id || (isset($data->cliente_id) && $data->cliente_id == $c->id) ? 'selected' : '' }}>{{ $c->nome }}</option>
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
        window.location.href = '/app/pedidos';
    });
</script>
