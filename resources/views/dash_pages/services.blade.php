@extends('dash_layouts.app')
@section('title','Serviços')


@section('dataset')
<div class="my-3 p-3 bg-body rounded shadow-sm">
    <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-0">
        <h6>Serviços Registrados</h6>
        @if(auth()->user()->tipo == 'Gerente' || auth()->user()->tipo == 'Administrador' || auth()->user()->tipo == 'Secretário')
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
            Adicionar Registro
        </button>
        @endif
    </div>
    <div class="d-flex flex-column flex-md-row p-4 gap-4 py-md-5 align-items-center justify-content-center">
        <div class="list-group" style="width: 100%;">
            @foreach($services as $service)
            <div class="list-group-item d-flex gap-3 py-4 align-items-center" style="font-size: 0.9rem;">
                <img src="{{ asset($service->imagem) }}" alt="{{ $service->nome }}" width="40" height="40" class="rounded-circle flex-shrink-0">
                <div class="d-flex gap-2 w-100 justify-content-between">
                    <div>
                        <h6 class="mb-0">{{ $service->nome }}</h6>
                        <p class="mb-0 opacity-75">{{ $service->descricao }}</p>
                    </div>
                    <div>
                        <button class="btn btn-info btn-md mb-2" data-bs-toggle="modal" data-bs-target="#detailsModal"
                         onclick="showDetails('{{ $service->nome }}', '{{ $service->descricao }}', '{{ $service->preco }}',{{$service->taxes}})">Detalhes</button>
                         @if(auth()->user()->tipo == 'Gerente' || auth()->user()->tipo == 'Administrador' || auth()->user()->tipo == 'Secretário')
                        <button class="btn btn-danger btn-md" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" onclick="confirmDelete({{ $service->id }})">Deletar</button>
                    @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Modal de Adicionar Serviço -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Adicionar Novo Serviço</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/services" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="nome" name="nome" required>
                    </div>
                    <div class="mb-3">
                        <label for="preco" class="form-label">Preço</label>
                        <input type="number" class="form-control" id="preco" name="preco" required>
                    </div>
                    <div class="mb-3">
                        <label for="preco" class="form-label">Imagem de Capa</label>
                        <input type="file" class="form-control" id="preco" name="document" required>
                    </div>
                    <div class="mb-3">
                        <label for="descricao" class="form-label">Descrição</label>
                        <textarea name="descricao" class="form-control" cols="30" rows="5" required></textarea>
                    </div>

                    <div class="mb-3">
                        @foreach($taxas as $taxa)
                            <div>
                                <input type="checkbox" name="taxas[]" id="taxa_{{ $taxa->id }}" value="{{ $taxa->id }}">
                                <label for="taxa_{{ $taxa->id }}">{{ $taxa->nome }} - Kz {{ number_format($taxa->total, 2, ',', '.') }}</label>
                            </div>
                        @endforeach
                    </div>
                    <button type="submit" class="btn btn-success">Registrar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Detalhes -->
<div class="modal fade" id="detailsModal" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailsModalLabel">Detalhes do Serviço</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Nome:</strong> <span id="detailName"></span></p>
                <p><strong>Descrição:</strong> <span id="detailDescription"></span></p>
                <p><strong>Preço:</strong> <span id="detailPrice"></span></p>
                <div id="detailTaxes"></div>
                <p><strong>Total a pagar</strong> <span id="totalPrice"></span></p>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Confirmação de Exclusão -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar Exclusão</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Tem certeza que deseja deletar este serviço?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form action="#" method="POST" id="deleteForm">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Deletar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
  function showDetails(name, description, price, taxes) { 
    document.getElementById('detailName').innerText = name;
    document.getElementById('detailDescription').innerText = description;
    document.getElementById('detailPrice').innerText = price;
    
    let taxesArray = typeof taxes === "string" ? JSON.parse(taxes) : taxes;
    let taxesContainer = document.getElementById('detailTaxes');
    let totalPrice = document.getElementById('totalPrice');
    let total = price;
    taxesContainer.innerHTML = ""; 
    taxesArray.forEach(tax => {
        let taxItem = document.createElement("li");
        taxItem.innerText = `${tax.nome}: Kz ${tax.total.toFixed(2)}`;
        total = parseFloat(total) + parseFloat(tax.total);
        taxesContainer.appendChild(taxItem);
    });
    totalPrice.innerText = total;
}


    function confirmDelete(serviceId) {
        document.getElementById('deleteForm').action = `/services/delete/${serviceId}`;
    }
</script>
@endsection
