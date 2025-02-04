@extends('dash_layouts.app')
@section('title','Clientes')

@section('dataset')
<div class="my-3 p-3 bg-body rounded shadow-sm">
    <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-0">
        <h6>Clientes Registrados</h6>
        @if(auth()->user()->tipo == 'Gerente' || auth()->user()->tipo == 'Administrador' || auth()->user()->tipo == 'Secretário')
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
            Adicionar Registro
        </button>
        @endif
    </div>

    @foreach($users as $cliente)
    <div class="d-flex text-body-secondary pt-3">
        <svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 32x32" preserveAspectRatio="xMidYMid slice" focusable="false">
            <title>Placeholder</title>
            <rect width="100%" height="100%" fill="#007bff"/>
            <text x="50%" y="50%" fill="#007bff" dy=".3em">32x32</text>
        </svg>
        <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
            <div class="d-flex justify-content-between">
                <strong class="text-gray-dark">{{ $cliente->nome }}</strong>
                <a href="/customers/customers-details/{{$cliente->id}}">Detalhes</a>
            </div>
            <span class="d-block">{{ $cliente->email }}</span>
        </div>
    </div>
    @endforeach
</div>

<!-- Modal de Adição de Utilizador -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Adicionar Novo Cliente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/customers" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome Completo</label>
                        <input type="text" class="form-control" id="nome" name="nome" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Senha</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Documento de Identificação</label>
                        <input type="file" class="form-control" id="documento" name="document" required>
                        <input type="hidden" class="form-control" id="tipo" name="tipo" value="Cliente">
                    </div>


                    <button type="submit" class="btn btn-success">Registrar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
