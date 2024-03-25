<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8/">

    <title>Pdf - Tarefas</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            margin: 20px auto;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #fff;
            padding: 8px;
            text-align: left;
        }

        tr:nth-child(even) {
            background-color: #aaa;
        }
        tr:nth-child(odd) {
            background-color: #ddd;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Lista de Tarefas</h2>

        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tarefas</th>
                    <th>Data Limite</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($tarefas as $t)
                    <tr>
                        <td>{{ $t->id }}</td>
                        <td>{{ $t->tarefa }}</td>
                        <td>{{ date('d/m/Y', strtotime($t->data_limite_conclusao)) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
