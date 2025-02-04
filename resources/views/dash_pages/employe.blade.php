@extends('dash_layouts.app')
@section('title', 'Funcionários')

@section('dataset')
<div class="my-3 p-3 bg-body rounded shadow-sm">
    <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-0">
        <h6>Funcionários Registrados</h6>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
            Adicionar Registro
        </button>
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
            <div class="d-flex justify-content-end mt-2">
                <button class="btn btn-warning btn-sm me-2" data-bs-toggle="modal" data-bs-target="#editUserModal{{$cliente->id}}" data-id="{{ $cliente->id }}" data-nome="{{ $cliente->nome }}" data-email="{{ $cliente->email }}" data-tipo="{{ $cliente->tipo }}">
                    Editar
                </button>
                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{$cliente->id}}" data-id="{{ $cliente->id }}" data-name="{{ $cliente->nome }}">
                    Deletar
                </button>
            </div>
        </div>
    </div>


    <!-- Modal de Edição de Utilizador -->
<div class="modal fade" id="editUserModal{{$cliente->id}}" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Editar Funcionário</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/customers/update/{{$cliente->id}}" action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="editNome" class="form-label">Nome Completo</label>
                        <input type="text" class="form-control" id="editNome" name="nome" value="{{$cliente->nome}}">
                    </div>
                    <div class="mb-3">
                        <label for="editEmail" class="form-label">E-mail</label>
                        <input type="email" class="form-control" id="editEmail" name="email" value="{{$cliente->email}}">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Tipo de Funcionário</label>
                        <select name="tipo" id="tipo" class="form-control" >
                            <option value="Administrador" @selected($cliente->tipo == 'Administrador')>Administrador</option>
                            <option value="Secretário" @selected($cliente->tipo == 'Secretário')>Secretário</option>
                            <option value="Técnico" @selected($cliente->tipo == 'Técnico')>Técnico</option>
                            <option value="Técnico" @selected($cliente->tipo == 'Gerente')>Gerente</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editDocumento" class="form-label">Documento de Identificação</label>
                        <input type="file" class="form-control" id="editDocumento" name="document">
                    </div>

                    <button type="submit" class="btn btn-warning">Atualizar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Confirmação de Deletar -->
<div class="modal fade" id="deleteModal{{$cliente->id}}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirmar Deletação</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Tem certeza de que deseja excluir o cliente <strong id="clienteName"></strong>?</p>
            </div>
            <div class="modal-footer">
                <form action="/customers/delete/{{$cliente->id}}" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Deletar</button>
                </form>
            </div>
        </div>
    </div>
</div>
    @endforeach
</div>


<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Adicionar Novo Funcionário</h5>
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
                        <label for="password" class="form-label">Tipo de Funcionário</label>
                        <select name="tipo" id="tipo" class="form-control" >
                            <option value="Administrador">Administrador</option>
                            <option value="Secretário">Secretário</option>
                            <option value="Técnico">Técnico</option>
                            <option value="Técnico">Gerente</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="documento" class="form-label">Documento de Identificação</label>
                        <input type="file" class="form-control" id="documento" name="document" required>
                    </div>

                    <button type="submit" class="btn btn-success">Registrar</button>
                </form>
            </div>
        </div>
    </div>
</div>



@endsection


