@extends('dash_layouts.app')
@section('title','Viaturas | Viaturas')


@section('dataset')
<div class="container mt-5">
    <div class="text-center mb-4">
        <h4 class="mt-3">Relatórios de Viaturas</h4>
    </div>
    <form method="GET" action="{{ route('relatorios.index') }}" class="row g-3 mb-4">
        <div class="col-md-5">
            <label for="data_inicio" class="form-label">Data Início</label>
            <input type="date" class="form-control" id="data_inicio" name="data_inicio" value="{{ $dataInicio }}">
        </div>
        <div class="col-md-5">
            <label for="data_fim" class="form-label">Data Fim</label>
            <input type="date" class="form-control" id="data_fim" name="data_fim" value="{{ $dataFim }}">
        </div>
        <div class="col-md-2 d-flex align-items-end">
            <button type="submit" class="btn btn-primary w-100">Filtrar</button>
        </div>
    </form>
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Resumo</h5>
        </div>
        <div class="card-body">
            <p class="mb-2"><strong>Total de Viaturas:</strong> {{ $totalViaturas }}</p>
            <p class="mb-2"><strong>Viaturas Concluídas:</strong> {{ $viaturasConcluidas }}</p>
            <p class="mb-0"><strong>Viaturas Por Concluir:</strong> {{ $viaturasPorConcluir }}</p>
        </div>
    </div>
    <div class="text-end">
        <a href="{{ route('relatorios.pdf', ['data_inicio' => $dataInicio, 'data_fim' => $dataFim]) }}" class="btn btn-danger">
            <i class="bi bi-file-earmark-pdf"></i> Baixar PDF
        </a>
    </div>
</div>

@endsection
