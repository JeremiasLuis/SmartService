<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório de Viaturas - Smart Service</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }
        .container {
            margin-top: 50px;
        }
        .table th, .table td {
            text-align: center;
            vertical-align: middle;
        }
        .table th {
            background-color: #007bff;
            color: white;
        }
        .table td {
            background-color: #ffffff;
        }
        .footer {
            text-align: center;
            font-size: 14px;
            color: #6c757d;
            margin-top: 30px;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="text-center mb-4">
            <h1 class="display-4">Relatório de Viaturas</h1>
            <p class="lead">Emitido em: {{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}</p>
        </div>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Matrícula</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Cor</th>
                    <th>Tipo</th>
                    <th>Estado</th>
                    <th>Tipo de Avaria</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($viaturas as $viatura)
                    <tr>
                        <td>{{ $viatura->matricula }}</td>
                        <td>{{ $viatura->marca }}</td>
                        <td>{{ $viatura->modelo }}</td>
                        <td>{{ $viatura->cor }}</td>
                        <td>{{ $viatura->tipo }}</td>
                        <td>{{ $viatura->estado }}</td>
                        <td>{{ $viatura->tipo_avaria }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="footer">
            <p>Smart Service - Todos os direitos reservados</p>
        </div>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
