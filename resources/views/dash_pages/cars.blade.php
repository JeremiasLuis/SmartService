@extends('dash_layouts.app')
@section('title','Viaturas Registradas')


@section('dataset')
<div class="my-3 p-3 bg-body rounded shadow-sm">
    <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-0">
        @if(auth()->user()->tipo == 'Cliente')
        <h6>Minhas Viaturas</h6>
        @else
        <h6>Viaturas Registradas</h6>
        @endif
        @if(auth()->user()->tipo == 'Gerente' || auth()->user()->tipo == 'Administrador' || auth()->user()->tipo == 'Secretário')
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCarModal">
            Adicionar Viatura
        </button>
        @endif
    </div>

    <div class="list-group mt-3">
        @foreach($cars as $viatura)
        <div class="list-group-item d-flex justify-content-between align-items-center">
            <div>
                <strong>{{ $viatura->marca }}</strong> - {{ $viatura->tipo_avaria }}
            </div>
            <div>
                
                <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#detailsModal{{ $viatura->id }}">Detalhes</button>
                @if(auth()->user()->tipo == 'Gerente' || auth()->user()->tipo == 'Administrador' || auth()->user()->tipo == 'Secretário')
                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $viatura->id }}">Atualizar</button>
                @endif
                @if(auth()->user()->tipo == 'Técnico')
                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalAtualizarEstado{{ $viatura->id }}">Atualizar Estado</button>
                @endif
                @if(auth()->user()->tipo == 'Gerente' || auth()->user()->tipo == 'Administrador' || auth()->user()->tipo == 'Secretário')
                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $viatura->id }}">Excluir</button>
                @endif
                @if($viatura->estado == 'Concluído')
                <button class="btn btn-secondary btn-sm" onclick="gerarQRCode('{{ $viatura->id }}', '{{ $ip }}')">
                    Gerar QR Code
                </button>
                @endif

            </div>
        </div>


        <!-- Modal para exibir o QR Code -->
<div class="modal fade" id="qrCodeModal" tabindex="-1" aria-labelledby="qrCodeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="qrCodeModalLabel">QR Code de Saída</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <div id="qrCodeContainer"></div>
            </div>
        </div>
    </div>
</div>

        <!-- Modal Detalhes -->
        <div class="modal fade" id="detailsModal{{ $viatura->id }}" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Detalhes da Viatura</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Marca:</strong> {{ $viatura->marca }}</p>
                        <p><strong>Matricula:</strong> {{ $viatura->matricula }}</p>
                        <p><strong>cor:</strong> {{ $viatura->cor }}</p>
                        <p><strong>Modelo:</strong> {{ $viatura->modelo }}</p>
                        <p><strong>Tipo:</strong> {{ $viatura->tipo }}</p>
                        <p><strong>Estado:</strong> {{ $viatura->estado }}</p>
                        <p><strong>Avaria:</strong> {{ $viatura->tipo_avaria }}</p>
                        <p><strong>Cliente:</strong> {{ $viatura->cliente }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="editModal{{ $viatura->id }}" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Atualizar Viatura</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form action="/cars/update/{{$viatura->id}}" method="POST">
                            @csrf
                            @method('PUT')
                            
                    <div class="mb-3">
                        <label class="form-label">Marca</label>
                        <input type="text" class="form-control" name="marca" value="{{$viatura->marca}}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Modelo</label>
                        <input type="text" class="form-control" name="modelo" value="{{$viatura->modelo}}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Matricula</label>
                        <input type="text" class="form-control" name="matricula" value="{{$viatura->matricula}}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Cor</label>
                        <input type="text" class="form-control" name="cor" value="{{$viatura->cor}}" required>
                    </div>
                    <div class="mb-3">
                    <label class="form-label">Tipo</label>
                    <select name="tipo" id="tipo" class="form-control">
                        <option value="Pequeno" @selected($viatura->tipo == 'Pequeno')>Pequeno</option>
                        <option value="Médio" @selected($viatura->tipo == 'Médio')>Médio</option>
                        <option value="Grande" @selected($viatura->tipo == 'Grande')>Grande</option>
                    </select>
                </div>

                    <div class="mb-3">
                        <label class="form-label">Cliente</label>
                        <select name="id_cliente" id="tipo" class="form-control">
                            @foreach ($users as $cliente )
                            <option value="{{$cliente->id}}" selected={{$cliente->id == $viatura->id_cliente}}>{{$cliente->nome}}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Avaria</label>
                       <textarea name="tipo_avaria" id="avaria" cols="30" rows="5" class="form-control">
                            {{$viatura->tipo_avaria}}
                       </textarea>
                    </div>
                   
                    <div class="mb-3">
                        <label class="form-label">Estado</label>
                        <select name="estado" id="tipo" class="form-control">
                            <option value="Entrada" @selected($viatura->estado == 'Entrada')>Entrada</option>
                            <option value="Em Reparação" @selected($viatura->estado == 'Em Reparação')>Em Reparação</option>
                            <option value="Concluído" @selected($viatura->estado == 'Concluído')>Concluído</option>
                        </select>
                    </div>

                    <div class="mb-3">
                <label class="form-label">Código de Validação</label>
                <input type="text" class="form-control" name="codigo_validacao" readonly value="{{$viatura->codigo_validacao}}">
            </div>
            <div class="mb-3">
                <label class="form-label">Senha</label>
                <input type="password" class="form-control" name="senha" required>
            </div>
                            <button type="submit" class="btn btn-success">Atualizar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="modalAtualizarEstado{{ $viatura->id }}" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Atualizar Viatura</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form action="/cars/update/{{$viatura->id}}" method="POST">
                            @csrf
                            @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Estado</label>
                        <select name="estado" id="tipo" class="form-control">
                            <option value="Entrada" @selected($viatura->estado == 'Entrada')>Entrada</option>
                            <option value="Em Reparação" @selected($viatura->estado == 'Em Reparação')>Em Reparação</option>
                            <option value="Concluído" @selected($viatura->estado == 'Concluído')>Concluído</option>
                        </select>
                    </div>
                                <div class="mb-3">
                <label class="form-label">Código de Validação</label>
                <input type="text" class="form-control" name="codigo_validacao" readonly value="{{$viatura->codigo_validacao}}">
            </div>
            <div class="mb-3">
                <label class="form-label">Senha</label>
                <input type="password" class="form-control" name="senha" required>
            </div>

                            <button type="submit" class="btn btn-success">Atualizar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="deleteModal{{ $viatura->id }}" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirmar Exclusão</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p>Tem certeza que deseja excluir esta viatura?</p>
                    </div>
                    <div class="modal-footer">
                        <form action="/cars/delete/{{$viatura->id}}" method="POST">
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

<div class="modal fade" id="addCarModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Adicionar Nova Viatura</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="/cars" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Marca</label>
                        <input type="text" class="form-control" name="marca" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Modelo</label>
                        <input type="text" class="form-control" name="modelo" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Matricula</label>
                        <input type="text" class="form-control" name="matricula" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Cor</label>
                        <input type="text" class="form-control" name="cor" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tipo</label>
                        <select name="tipo" id="tipo" class="form-control">
                            <option value="Pequeno">Pequeno</option>
                            <option value="Médio">Médio</option>
                            <option value="Grande">Grande</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Cliente</label>
                        <select name="id_cliente" id="tipo" class="form-control">
                            @foreach ($users as $cliente )
                            <option value="{{$cliente->id}}">{{$cliente->nome}}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Avaria</label>
                       <textarea name="tipo_avaria" id="avaria" cols="30" rows="5" class="form-control">

                       </textarea>
                    </div>
                   
                    <button type="submit" class="btn btn-success">Registrar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="qrcode"></div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>

<script>
  
    async function gerarQRCode(id, ip) {
        document.getElementById('qrCodeContainer').innerHTML = '';
        const response = await fetch('https://api.ipify.org?format=json');
            const data = await response.json();
            console.log(JSON.stringify(data))
            const ips = data.ip;
        const url = `http://${ips}:8000/cars/qrcode/${id}`;
        new QRCode(document.getElementById("qrCodeContainer"), url);
        var qrModal = new bootstrap.Modal(document.getElementById('qrCodeModal'));
        qrModal.show();
    }
  

    
</script>
@endsection
