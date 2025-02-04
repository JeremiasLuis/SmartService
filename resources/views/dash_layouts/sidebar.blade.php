<div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary">
    <div class="offcanvas-md offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="sidebarMenuLabel">Painel de Gestão</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
        <ul class="nav flex-column">
          @if(auth()->user()->tipo == 'Gerente' || auth()->user()->tipo == 'Administrador')
          <li class="nav-item">
            <a class="nav-link d-flex align-items-center gap-2 active" aria-current="page" href="/dashboard">
              <svg class="bi"><use xlink:href="#house-fill"/></svg>
              Inicio
            </a>
          </li>
         
        <li class="nav-item">
            <a class="nav-link d-flex align-items-center gap-2 active" aria-current="page" href="/customers/employee">
              <svg class="bi"><use xlink:href="#gear-wide-connected"/></svg>
              Funcionários
            </a>
          </li>
         
          @endif
          @if(auth()->user()->tipo == 'Cliente')
          <li class="nav-item">
            <a class="nav-link d-flex align-items-center gap-2 active" aria-current="page" href="/customers/customers-details/{{auth()->user()->id}}">
              <svg class="bi"><use xlink:href="#house-fill"/></svg>
              Perfil
            </a>
          </li>
          @endif
          <li class="nav-item">
            <a class="nav-link d-flex align-items-center gap-2" href="/cars">
              <svg class="bi"><use xlink:href="#file-earmark"/></svg>
              Viaturas
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link d-flex align-items-center gap-2" href="/services">
              <svg class="bi"><use xlink:href="#cart"/></svg>
              Serviços
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link d-flex align-items-center gap-2" href="/taxas">
                <svg class="bi"><use xlink:href="#graph-up"/></svg>
              Taxas
            </a>
          </li>
          @if(auth()->user()->tipo != 'Técnico' || auth()->user()->tipo != 'Secretário')
          <li class="nav-item">
            <a class="nav-link d-flex align-items-center gap-2" href="/orcamentos">
                <svg class="bi"><use xlink:href="#list"/></svg>
              Orçamentos
            </a>
          </li>
          @endif
          @if(auth()->user()->tipo != 'Cliente')
          <li class="nav-item">
            <a class="nav-link d-flex align-items-center gap-2" href="/customers">
              <svg class="bi"><use xlink:href="#people"/></svg>
              Clientes
            </a>
          </li>
          @endif
          @if(auth()->user()->tipo == 'Gerente' || auth()->user()->tipo == 'Administrador')
          <li class="nav-item">
            <a class="nav-link d-flex align-items-center gap-2" href="/message">
              <svg class="bi"><use xlink:href="#puzzle"/></svg>
              Caixa de Entrada
            </a>
          </li>
        </ul>
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-body-secondary text-uppercase">
          <span>Obter Relatório</span>
          <a class="link-secondary" href="{{route('relatorios.index')}}" aria-label="Add a new report">
            <svg class="bi"><use xlink:href="#plus-circle"/></svg>
          </a>
        </h6>
@endif
        <hr class="my-3">

        <ul class="nav flex-column mb-auto">
          <li class="nav-item">
            <a class="nav-link d-flex align-items-center gap-2" href="/settings">
              <svg class="bi"><use xlink:href="#gear-wide-connected"/></svg>
              Definições
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link d-flex align-items-center gap-2" href="/sair">
              <svg class="bi"><use xlink:href="#door-closed"/></svg>
              Encerrar sessão
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
