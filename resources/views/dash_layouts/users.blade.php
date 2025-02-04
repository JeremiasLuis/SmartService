<h2>Hitórico de Pagamentos</h2>
<div class="table-responsive small">
  <table class="table table-striped table-sm">
    <thead>
      <tr>
        <th scope="col">Cliente</th>
        <th scope="col">Serviço</th>
        <th scope="col">Preço</th>
        <th scope="col">Data</th>
        <th scope="col">Observação</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($orcamentos as $orcamento)
      <tr>
        <td>{{$orcamento->cliente}}</td>
        <td>{{$orcamento->servico_nome}}</td>
        <td>{{$orcamento->servico_preco}}</td>
        <td>{{$orcamento->created_at}}</td>
        <td>{{$orcamento->observacao}}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
