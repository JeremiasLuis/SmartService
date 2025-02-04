@extends('layouts.app')

@section('title', 'Viatura | Informações')

@section('content')
<div class="d-flex justify-content-center align-items-center" style="min-height: 100vh; background-color: #f8f9fa;">
    <div class="card shadow-lg p-4" style="width: 100%; max-width: 400px; border-radius: 10px;">
        <div class="text-center mb-4">
            <h3 class="mb-2" style="color: #1E5DBC;">Smart Service!</h3>
            <p class="text-muted">Os melhores serviços sempre</p>
        </div>
        @include('messages.success')
        @include('messages.error')
        <form>
           @method('POST')
            <div class="mb-3">
                <label for="email" class="form-label">Nome</label>
                <input type="text" class="form-control" readonly value="Smart Service" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Endereço</label>
                <input type="text" readonly class="form-control" value="Rua Dr. António Agostinho Neto, Lubango - Huíla" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Data de saída de Veículo</label>
                <input type="text" class="form-control" readonly value="{{$viatura->updated_at->diffForHumans()}}" required>
            </div>
        </form>
        <p class="text-center mt-4">
            Solicitar Serviço? <a href="/#contact" class="text-primary">Contacte-nos</a>
        </p>
    </div>
</div>



@endsection
