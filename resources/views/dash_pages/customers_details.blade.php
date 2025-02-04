@extends('dash_layouts.app')
@section('title','Clientes')


@section('dataset')
<div class="row g-5">
    <div class="col-md-5 col-lg-4 order-md-last">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-primary">Histórico de Orçamentos</span>
            <span class="badge bg-primary rounded-pill">{{ count($orcamentos)}}</span>
        </h4>
        
        <ul class="list-group mb-3">
            @foreach ($orcamentos as $orcamento )
            <li class="list-group-item d-flex justify-content-between lh-sm">
                <div><h6 class="my-0">{{$orcamento->servico_nome}}</h6><small class="text-body-secondary">{{$orcamento->servico_preco}}</small></div>
                <span class="text-body-secondary">{{$orcamento->total}}</span>
            </li> 
            @endforeach
           
        </ul>
        @if(auth()->user()->tipo !== 'Técnico')
        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modalServico">Solicitar orçamento</button>
        @endif
    </div>

    <div class="col-md-7 col-lg-8">
        <h4 class="mb-3">Dados Pessoais</h4>
        <form class="needs-validation" novalidate>
            <div class="row g-3">
              <div class="col-sm-6">
                <label for="firstName" class="form-label">Nome Completo</label>
                <input type="text" class="form-control" id="firstName" name="nome" readonly value="{{$user->nome}}">
              </div>
              <div class="col-12">
                <label for="username" class="form-label">E-mail</label>
                <div class="input-group has-validation">
                  <span class="input-group-text">@</span>
                  <input type="text" class="form-control" id="username" name="email" readonly value="{{$user->email}}" >
                </div>
              </div>

              <div class="col-12">
                <label for="email" class="form-label">Tipo<span class="text-body-secondary"></span></label>
                <input type="email" class="form-control" id="email" value="{{$user->tipo}}" readonly>
              </div>

              <div class="col-12">
                <label for="address" class="form-label">Estado</label>
                <input type="text" class="form-control" id="address" value="{{$user->status}}" readonly>
              </div>
              <div class="col-12">
                <label for="address" class="form-label">Documento de Identificação</label>
                <a href="{{asset($user->documento_identificacao)}}">Abrir Ficheiro</a>
              </div>
            </div>
            @if(auth()->user()->id == $user->id || auth()->user()->tipo !== 'Técnico')
            <button type="button" class="w-100 btn btn-primary btn-lg my-2" data-bs-toggle="modal" data-bs-target="#modalAtualizar">Atualizar informações</button>
        @endif 
        </form>
          </div>
    </div>



<!-- Modal Atualizar Informações -->
<div class="modal fade" id="modalAtualizar" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Atualizar Informações</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="/customers/update/{{$user->id}}" method="POST">
                    @csrf
                    @method('PUT')
                    <label class="form-label" >Nome</label>
                    <input type="text" name="nome" value="{{$user->nome}}" class="form-control">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" name="email" value="{{$user->email}}" class="form-control">
                    <label class="form-label">Estado de Perfil</label>
                    <select name="status" id="status" class="form-control">
                        <option value="cancelado" @selected($user->status == 'cancelado')>Cancelado</option>
                        <option value="activo" @selected($user->status == 'activo')>Activo</option>
                    </select>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
           
        </div>
    </div>
</div>

<!-- Modal Novo Serviço -->
<div class="modal fade" id="modalServico" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Adicionar Novo Serviço</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="/orcamentos" method="post">
                @csrf
            <div class="modal-body">
                <select  id="servicoSelect" name="id_servico" class="form-select">
                    <option value="" disabled selected>Selecione um serviço</option>
                    
                    @foreach ($servicos as $servico)
                        <option value="{{ $servico->id }}" data-taxa="{{$servico->taxes}}" data-preco="{{ $servico->preco }}">
                            {{ $servico->nome }} - kz{{ $servico->preco }}
                        </option>
                    @endforeach
                </select>
                <ul id="previewServicos" class="list-group mt-3"></ul>
                <input type="hidden" name="id_cliente" value="{{$user->id}}">
                <input type="hidden" name="total" id="inputPreco">
                <p class="mt-2">Total: <strong id="totalPreco">kz0</strong></p>
            </div>
            <div class="modal-footer">
                <a class="btn btn-secondary" href="#" data-bs-dismiss="modal">Cancelar</a>
                <button type="submit" class="btn btn-primary" id="confirmarServicos">Salvar</button>
            </div>
        </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
    let servicoSelect = document.getElementById("servicoSelect");
    let previewServicos = document.getElementById("previewServicos");
    let totalPreco = document.getElementById("totalPreco");
    let inputPreco = document.getElementById("inputPreco");
    let servicosSelecionados = [];

    servicoSelect.addEventListener("change", function() {
        let selectedOption = servicoSelect.options[servicoSelect.selectedIndex];

        if (!selectedOption.value) return;

        let servicoId = selectedOption.value;
        let servicoNome = selectedOption.text;
        let servicoPreco = parseFloat(selectedOption.dataset.preco);
        
        // Processar taxa
        let servicoTaxas = selectedOption.dataset.taxa ? JSON.parse(selectedOption.dataset.taxa) : [];
        let totalTaxa = 0;
        let taxaDetalhes = "";

        if (Array.isArray(servicoTaxas)) {
            totalTaxa = servicoTaxas.reduce((acc, taxa) => acc + parseFloat(taxa.total || 0), 0);
            taxaDetalhes = servicoTaxas.map(taxa => `${taxa.nome}: kz${taxa.total}`).join(", ");
        }
        
        let precoTotal = servicoPreco + totalTaxa;

        // Verifica se já foi adicionado
        if (!servicosSelecionados.find(s => s.id === servicoId)) {
            servicosSelecionados.push({
                id: servicoId,
                nome: servicoNome,
                preco: servicoPreco,
                taxa: totalTaxa,
                taxaDetalhes: taxaDetalhes,
                total: precoTotal
            });
            updatePreview();
        }
    });

    function updatePreview() {
        previewServicos.innerHTML = "";
        let total = 0;

        servicosSelecionados.forEach(servico => {
            let li = document.createElement("li");
            li.classList.add("list-group-item", "d-flex", "justify-content-between", "align-items-center");
            li.innerHTML = `
                <div>
                    <strong>${servico.nome}</strong> - kz${servico.preco} 
                    <br><small class="text-muted">Taxas: ${servico.taxaDetalhes} (Total: kz${servico.taxa})</small>
                </div>
                <button class="btn btn-danger btn-sm" onclick="removeServico('${servico.id}')">Remover</button>
            `;

            previewServicos.appendChild(li);
            total += servico.total;
        });

        totalPreco.textContent = `kz${total}`;
        inputPreco.value = total;
    }

    window.removeServico = function(servicoId) {
        servicosSelecionados = servicosSelecionados.filter(s => s.id !== servicoId);
        updatePreview();
    };
});

</script>


@endsection
