<nav class="navbar navbar-expand-lg navbar-light mb-0" style="background-color: #1E5DBC;">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}" style="background-color:  #1E5DBC; border: none; font-size: 24px; font-weight: bold; color: white; text-transform: uppercase; letter-spacing: 2px;">Smart Service</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto" style="margin-bottom: 0;">
                <li class="nav-item">
                    <a class="nav-link text-white" href="/#">Início</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="/#about">Sobre</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="/#services">Serviços</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="/#contact">Contacto</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="/pricing">Preços</a>
                </li>
                @guest
                <li class="nav-item">
                    <a href="/login" class="btn btn-light">Entrar</a>

            </li>
            <li class="nav-item">
                <a href="/register" class="btn btn-dark text-white mx-2">Criar Conta</a>

        </li>
            
                @endguest

                @auth
                <li class="nav-item">
                    <a href="/cars" class="btn btn-secondary nav-link text-white">Painel</a>
            </li>
                @endauth



            </ul>
        </div>
    </div>
</nav>
