@extends('dash_layouts.app')
@section('title','Definições')

@section('dataset')
<div class="my-3 p-3 bg-body rounded shadow-sm">
    <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-0">
        <h6>Configurações da Conta</h6>
    </div>

    <div class="list-group mt-3">
        <button class="list-group-item list-group-item-action" data-bs-toggle="modal" data-bs-target="#updatePasswordModal">
            Atualizar Senha
        </button>
        <button class="list-group-item list-group-item-action text-danger" data-bs-toggle="modal" data-bs-target="#cancelAccountModal">
            Cancelar Conta
        </button>
        <button class="list-group-item list-group-item-action" data-bs-toggle="modal" data-bs-target="#termsModal">
            Termos e Condições
        </button>
        <button class="list-group-item list-group-item-action" data-bs-toggle="modal" data-bs-target="#twoFactorModal">
            Habilitar Autenticação em Dois Fatores
        </button>
        <button class="list-group-item list-group-item-action" data-bs-toggle="modal" data-bs-target="#notificationSettingsModal">
            Configuração de Notificações
        </button>
    </div>
</div>
<div class="modal fade" id="updatePasswordModal" tabindex="-1" aria-labelledby="updatePasswordLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updatePasswordLabel">Atualizar Senha</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="/customers/updatePassword" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Senha Atual</label>
                        <input type="password" name="old_password" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nova Senha</label>
                        <input type="password" name="new_password" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-success">Atualizar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Cancelar Conta -->
<div class="modal fade" id="cancelAccountModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cancelar Conta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Tem certeza que deseja cancelar sua conta? Esta ação não pode ser desfeita.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não</button>
                <form action="/customers/update/{{auth()->user()->id}}" method="POST">
                    @csrf
                    @method('PUT')
                <input type="hidden" name="status" value="cancelado">
                <button type="submit" class="btn btn-danger">Sim, Cancelar</button>
            </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Termos e Condições -->
<div class="modal fade" id="termsModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Termos e Condições</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Aqui você pode adicionar os termos e condições do serviço...</p>
            </div>
        </div>
    </div>
</div>

<!-- Modal Autenticação em Dois Fatores -->
<div class="modal fade" id="twoFactorModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Autenticação em Dois Fatores</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Ative a autenticação em dois fatores para maior segurança.</p>
                <button class="btn btn-primary">Ativar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Configuração de Notificações -->
<div class="modal fade" id="notificationSettingsModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Configuração de Notificações</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Escolha como deseja receber notificações.</p>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="emailNotifications">
                    <label class="form-check-label" for="emailNotifications">Notificações por e-mail</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="smsNotifications">
                    <label class="form-check-label" for="smsNotifications">Notificações por SMS</label>
                </div>
                <button class="btn btn-success mt-3">Salvar</button>
            </div>
        </div>
    </div>
</div>
@endsection
