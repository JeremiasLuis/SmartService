@extends('layouts.app')

@section('title', 'Login | Entrar')

@section('content')
<div class="d-flex justify-content-center align-items-center" style="min-height: 100vh; background-color: #f8f9fa;">
    <div class="card shadow-lg p-4" style="width: 100%; max-width: 400px; border-radius: 10px;">
        <div class="text-center mb-4">
            <h3 class="mb-2" style="color: #1E5DBC;">Bem-vindo de volta!</h3>
            <p class="text-muted">Entre para continuar</p>
        </div>
        @include('messages.success')
        @include('messages.error')
        <form method="POST" action="{{ route('entrar') }}">
           @csrf
           @method('POST')
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email"  name="email" placeholder="Digite seu email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Senha</label>
                <input type="password" class="form-control"  name="password" id="password" placeholder="Digite sua senha" required>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="rememberMe">
                    <label class="form-check-label" for="rememberMe">Lembrar-me</label>
                </div>
                <a href="#" class="text-primary" data-bs-toggle="modal" data-bs-target="#supportModal">Esqueceu sua senha?</a>
            </div>
            <div class="d-grid mb-3">
                <button type="submit" class="btn btn-primary" style="background-color: #1E5DBC; border-color: #1E5DBC;">
                    Entrar
                </button>
            </div>
        </form>
        <p class="text-center mt-4">
            Não tem uma conta? <a href="/register" class="text-primary">Cadastre-se</a>
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
