<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Super Gestão - @yield('titulo')</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">

        <link rel="stylesheet" href="{{ asset('css/estilo_basico.css') }}"/>
    </head>

    <body class="antialiased d-flex flex-column">
        @include('components.menu', [
            'rotas' => [
                ['rota' => route('produtos'), 'texto' => 'Produtos'],
                ['rota' => route('clientes'), 'texto' => 'Clientes'],
                ['rota' => route('fornecedores'), 'texto' => 'Fornecedores'],
                ['rota' => route('pedidos'), 'texto' => 'Pedidos'],
                ['rota' => route('sair'), 'texto' => 'Sair'],
            ]
        ])

        @if(session('msg'))
            @include('components.feedBack', ['msg' => session('msg') ?? null, 'msgClass' => session('msgClass') ?? 'primary'])
        @endif

        @if($errors->any())
            @include('components.feedBack', ['msg' => $errors->first(), 'msgClass' => 'danger'])
        @endif

        @include('components.feedBack', ['msg' => $msg ?? null, 'msgClass' => $msgClass ?? ''])

        <div class="conteudo-destaque">
            @yield('content')
        </div>

        <footer class="footer p-3 border-top mt-3" style="background-color: rgba(75, 119, 190, 0.2);">
            <div class="container">
                <p class="text-center mb-0 text-black-50">App Super Gestão</p>
                <p class="text-center text-black-50">Todos os direitos reservados &copy; <?php echo date('Y'); ?></p>
            </div>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>
</html>
