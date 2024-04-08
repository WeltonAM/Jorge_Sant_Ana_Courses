<div class="topo">

    <div class="logo">
        <a href="/">
            <img src="{{ asset('img/logo.png') }}">
        </a>
    </div>

    <div class="menu">
        <ul>
            @foreach($rotas as $r)
                @include('components.menuItem', ['rota' => $r['rota'], 'texto' => $r['texto']])
            @endforeach
        </ul>
    </div>
</div>
