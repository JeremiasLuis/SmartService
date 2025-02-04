<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comprovativo de Pagamento - Smart Service</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .receipt-container {
            max-width: 700px;
            margin: 40px auto;
            background: white;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }
        .company-logo {
            font-size: 24px;
            font-weight: bold;
            color: #007bff;
            text-align: center;
        }
        .table th {
            background-color: #007bff;
            color: white;
            text-align: left;
        }
        .badge {
            font-size: 1rem;
            padding: 10px;
        }
        .footer-text {
            text-align: center;
            font-size: 14px;
            color: #6c757d;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="receipt-container">
            <div class="text-center mb-4">
                <div class="company-logo">Smart Service</div>
                <p class="text-muted">Comprovativo de Pagamento</p>
            </div>

            <table class="table table-bordered">
                <tr>
                    <th>Serviço</th>
                    <td>{{ $orcamento->servico_nome ?? 'N/A' }} - {{ number_format($orcamento->servico_preco ?? 0, 2, ',', '.') }} KZ</td>
                </tr>
                <tr>
                    <th>Total do Orçamento</th>
                    <td>{{ number_format($orcamento->total_orcamento ?? 0, 2, ',', '.') }} KZ</td>
                </tr>
                <tr>
                    <th>Valor Pago</th>
                    <td>{{ number_format($orcamento->valor_pago ?? 0, 2, ',', '.') }} KZ</td>
                </tr>
                <tr>
                    <th>Valor em Falta</th>
                    <td>{{ number_format(($orcamento->total_orcamento ?? 0) - ($orcamento->valor_pago ?? 0), 2, ',', '.') }} KZ</td>
                </tr>
                <tr>
                    <th>Status do Pagamento</th>
                    <td>
                        @if($orcamento->estado_pagamento)
                            <span class="badge bg-success">{{ $orcamento->estado_pagamento }}</span>
                        @else
                            <span class="badge bg-danger">Pagamento ainda não registrado</span>
                        @endif
                    </td>
                </tr>
            </table>

            <!-- Tabela de Taxas -->
            <h5 class="mt-4">Taxas Aplicadas</h5>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Valor (KZ)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!empty(json_decode($orcamento->taxes, true)))
                            @foreach(json_decode($orcamento->taxes) as $taxa)
                                <tr>
                                    <td>{{ $taxa->nome }}</td>
                                    <td>{{ number_format($taxa->total, 2, ',', '.') }} KZ</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="2" class="text-center text-muted">Nenhuma taxa aplicada.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <div class="text-center mt-4">
                <p class="footer-text">Obrigado por escolher a <strong>Smart Service</strong>. Aguardamos você novamente!</p>
            </div>
        </div>
    </div>

</body>
</html>
