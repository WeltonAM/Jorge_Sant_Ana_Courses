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
                <a href="/">Principal</a>
            </li>
            <li>
                <a href="/sobre">Sobre Nós</a>
            </li>
            <li>
                <a href="/contato">Contato</a>
            </li>
        </ul>

        <main>
            @yield('content')
        </main>
    </body>
</html>
