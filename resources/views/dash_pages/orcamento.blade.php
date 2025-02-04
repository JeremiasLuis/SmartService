@extends('dash_layouts.app')
@section('title','Histórico de Orçamentos')

@section('dataset')
<div class="my-3 p-3 bg-body rounded shadow-sm">
    <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-0">
        <h6>Histórico de Orçamentos Registrados</h6>
    </div>

    <div class="list-group mt-3">
        @foreach($orcamentos as $orcamento)
        <div class="list-group-item d-flex justify-content-between align-items-center">
            <div>
                <strong> Total {{ $orcamento->total_orcamento }}</strong> - {{ $orcamento->estado_pagamento ? $orcamento->estado_pagamento : 'Pagamento Não Registrado' }}
            </div>
            <div>
                <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#detailsModal{{ $orcamento->id_orcamento }}">Detalhes</button>
               @if(isset($orcamento->id_pagamento))
                <a class="btn btn-info btn-sm" href="/download/{{$orcamento->id_orcamento}}">Comprovativo</a>
                @endif
                @if(auth()->user()->tipo == 'Gerente' || auth()->user()->tipo == 'Administrador' || auth()->user()->tipo == 'Secretário')
                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#choosePaymentModal{{ $orcamento->id_orcamento }}" @if($orcamento->total == $orcamento->valor_pago) disabled @endif>Pagamento</button>
               @endif
            </div>
        </div>
      
        
        <div class="modal fade" id="detailsModal{{ $orcamento->id_orcamento }}" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Detalhes do Orçamento</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Serviço:</strong> {{ $orcamento->servico_nome }} - {{ number_format($orcamento->servico_preco, 2, ',', '.') }} KZ</p>
                        <p><strong>Taxas:</strong></p>
                        <ul>
                            @foreach(json_decode($orcamento->taxes) as $taxa)
                                <li>{{ $taxa->nome }}: {{ number_format($taxa->total, 2, ',', '.') }} KZ</li>
                            @endforeach
                        </ul>
                        <p><strong>Valor Pago:</strong> {{ number_format($orcamento->valor_pago, 2, ',', '.') }} KZ</p>
                        <p><strong>Valor em Falta:</strong> {{ number_format($orcamento->total_orcamento - $orcamento->valor_pago, 2, ',', '.') }} KZ</p>
                        <p><strong>Total a pagar:</strong> {{ number_format($orcamento->total_orcamento, 2, ',', '.') }} KZ</p>
                       
                        <p><strong>Status do Pagamento:</strong> {{ $orcamento->estado_pagamento ?  $orcamento->estado_pagamento : 'Pagamento ainda não registrado' }}</p>
                        <p><strong>Nota:</strong> <small> {{ $orcamento->observacao }} </small></p>
                       
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="choosePaymentModal{{ $orcamento->id_orcamento }}" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Escolher Tipo de Pagamento</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body text-center">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#paymentModal{{ $orcamento->id_orcamento }}" data-bs-dismiss="modal">Primeiro Pagamento</button>
                        <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#installmentModal{{ $orcamento->id_orcamento }}" data-bs-dismiss="modal">Outra Prestação</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="paymentModal{{ $orcamento->id_orcamento }}" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Pagamento do Orçamento</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                    <form action="{{ route('pagamento.store') }}" method="POST">
    @csrf
    <input type="hidden" name="id_orcamento" value="{{ $orcamento->id_orcamento }}">

    <div class="mb-3">
        <label class="form-label">Método de Pagamento</label>
        <select name="metodo" class="form-control" required>
            <option value="Em Mão">Dinheiro</option>
            <option value="TPA">Transferência Bancária</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Parcelar pagamento?</label>
        <select name="parcelar" class="form-control" required>
            <option value="não">Não</option>
            <option value="sim">Sim</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Valor a Pagar</label>
        <input type="number" class="form-control" name="valor" min="1" max="{{ $orcamento->total - $orcamento->valor_pago }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Observação</label>
        <textarea class="form-control" name="observacao" rows="3" maxlength="255"></textarea>
    </div>

    <button type="submit" class="btn btn-success">Confirmar Pagamento</button>
</form>

                    </div>
                </div>
            </div>
        </div>
        @if($orcamento->id_pagamento)

        <div class="modal fade" id="installmentModal{{ $orcamento->id_orcamento }}" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Atualizar Pagamento</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('pagamento.update', $orcamento->id_pagamento) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label">Valor a Pagar</label>
                                <input type="number" class="form-control" name="valor" min="1" max="{{ $orcamento->total - $orcamento->valor_pago }}" required>
                            </div>

                            <button type="submit" class="btn btn-success">Atualizar Pagamento</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @endforeach
    </div>
</div>
@endsection
