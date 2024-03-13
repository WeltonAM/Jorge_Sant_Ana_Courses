<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
    </head>
    <body class="antialiased">
        <h3>Principal</h3>

        <ul>
            <li>
                <a href="{{route('principal')}}">Principal</a>
            </li>
            <li>
                <a href="{{route('sobre')}}">Sobre Nós</a>
            </li>
            <li>
                <a href="{{route('contato')}}">Contato</a>
            </li>
        </ul>

        <main>
            @yield('content')
        </main>
    </body>
</html>
