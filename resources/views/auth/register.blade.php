@extends('layouts.app')

@section('title', 'Cadastrar')

@section('content')
<div class="d-flex justify-content-center align-items-center" style="min-height: 100vh; background-color: #f8f9fa;">
    <div class="card shadow-lg p-4" style="width: 100%; max-width: 400px; border-radius: 10px;">
        <div class="text-center mb-4">
            <h3 class="mb-2" style="color: #1E5DBC;">Bem-vindo a Smart Service!</h3>
            <p class="text-muted">Crie uma conta para continuar</p>
        </div>
        @include('messages.success')
        @include('messages.error')
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
        <p class="text-center mt-4">
            Já tem uma conta? <a href="/login" class="text-primary">Entrar</a>
        </p>
    </div>
</div>

<div class="modal fade" id="supportModal" tabindex="-1" aria-labelledby="supportModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #1E5DBC; color: white;">
                <h5 class="modal-title" id="supportModalLabel">Informação</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Por favor, entre em contato com o suporte para resolver a situação.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

@endsection
