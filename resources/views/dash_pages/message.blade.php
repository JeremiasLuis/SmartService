@extends('dash_layouts.app')
@section('title','Caixa de Entrada')


@section('dataset')
<div class="my-3 p-3 bg-body rounded shadow-sm">
    <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-0">
        <h6>Caixa de Entrada</h6>
    </div>

    <div class="d-flex flex-column flex-md-row p-4 gap-4 py-md-5 align-items-center ">
        <div class="list-group" style="width: 100%;">
            @foreach ($mensagens as $mensagem)
                <a href="#"
                   class="list-group-item list-group-item-action d-flex gap-3 py-3"
                   data-bs-toggle="modal"
                   data-bs-target="#mensagemModal{{ $mensagem->id }}">
                    <div class="d-flex gap-2 w-100 justify-content-between">
                        <div>
                            <h6 class="mb-0">{{ $mensagem->titulo }}</h6>
                            <p class="mb-0 opacity-75">{{ Str::limit($mensagem->conteudo, 50) }}</p>
                        </div>
                        <small class="opacity-50 text-nowrap">{{ $mensagem->created_at->diffForHumans() }}</small>
                    </div>
                </a>

                <!-- Modal Detalhes da Mensagem -->
                <div class="modal fade" id="mensagemModal{{ $mensagem->id }}" tabindex="-1" aria-labelledby="mensagemModalLabel{{ $mensagem->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="mensagemModalLabel{{ $mensagem->id }}">{{ $mensagem->titulo }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p><strong>Remetente:</strong> {{ $mensagem->nome }}</p>
                                <p><strong>Contacto:</strong> {{ $mensagem->contacto }}</p>
                                <p><strong>Data:</strong> {{ $mensagem->created_at->format('d/m/Y H:i') }}</p>
                                <hr>
                                <p>{{ $mensagem->conteudo }}</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
