@extends('dash_layouts.app')
@section('title','Taxas Registradas')


@section('dataset')
<div class="my-3 p-3 bg-body rounded shadow-sm">
    <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-0">
        <h6>Taxas Registradas</h6>
        @if(auth()->user()->tipo == 'Gerente' || auth()->user()->tipo == 'Administrador' || auth()->user()->tipo == 'Secretário')
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCarModal">
            Adicionar Taxa
        </button>
        @endif
    </div>

    <div class="list-group mt-3">
        @foreach($taxas as $taxa)
        <div class="list-group-item d-flex justify-content-between align-items-center">
            <div>
                <strong>{{ $taxa->nome }}</strong> - {{ $taxa->total }}
            </div>
            <div>
                @if(auth()->user()->tipo == 'Gerente' || auth()->user()->tipo == 'Administrador' || auth()->user()->tipo == 'Secretário')
                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $taxa->id }}">Atualizar</button>
                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $taxa->id }}">Excluir</button>
                @endif
            </div>
        </div>

        <!-- Modal Atualizar -->
        <div class="modal fade" id="editModal{{ $taxa->id }}" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Atualizar Taxa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form action="/taxas/update/{{$taxa->id}}" method="POST">
                            @csrf
                            @method('PUT')
                            
                    <div class="mb-3">
                        <label class="form-label">Nome</label>
                        <input type="text" class="form-control" name="nome" value="{{$taxa->nome}}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Preço</label>
                        <input type="text" class="form-control" name="total" value="{{$taxa->total}}" required>
                    </div>
                            <button type="submit" class="btn btn-success">Atualizar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Excluir -->
        <div class="modal fade" id="deleteModal{{ $taxa->id }}" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirmar Exclusão</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p>Tem certeza que deseja excluir esta Taxa?</p>
                    </div>
                    <div class="modal-footer">
                        <form action="/taxas/delete/{{$taxa->id}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Sim, Excluir</button>
                        </form>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- Modal Adicionar Viatura -->
<div class="modal fade" id="addCarModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Adicionar Nova Taxa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="/taxas" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nome</label>
                        <input type="text" class="form-control" name="nome" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Preço</label>
                        <input type="text" class="form-control" name="total" required>
                    </div>
                    <button type="submit" class="btn btn-success">Registrar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
