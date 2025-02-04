@extends('layouts.app')

@section('title', 'Página Inicial')
<style>
    .bg-image {
        background-image: url('{{ asset('image/Hero.jpg') }}');
        background-size: cover;
        background-position: center;
        height: 100vh;
    }
</style>
@section('content')
<div class="bg-image d-flex align-items-center">
    <div class="container text-white">
        <div class="row">
            <div class="col-md-6">
                <h2 class="fw-bold display-6 mb-3">PROFISSIONAIS EM REPARAÇÃO DE CARROS COM SERVIÇOS CERTIFICADOS</h2>
                <p class="my-3">
                    Oferecemos mecânicos bem treinados e excelente atendimento ao cliente,<br>
                     tudo a preços competitivos para reparos de veículos <br>
                     na sua casa ou local de trabalho.
                </p>
                <div class="d-flex align-items-center mt-4">
                    <a href="/#contact" class="btn btn-primary me-3 btn-lg display-6">
                        <span class="fw-bold fs-3 font-regular">Marque Agora!</span>
                    </a>
                    <div class="d-flex flex-row align-items-center gap-3">
                        <div>
                            <i class="fas fa-phone fa-2x me-2" style="vertical-align: middle; font-size: 36px;"></i>
                        </div>
                        <div class="d-flex flex-column text-left">
                            <span class="fw-bold fs-3">936 123 303</span>
                            <span class="lh-1 display-8">Disponível 24/24 ao dia</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="d-flex justify-content-center" style="background-color: #1E5DBC;">
    <div class="row text-white p-4 w-auto container ">
        <!-- Coluna 1 -->
        <div class="col-md-4 d-flex align-items-center">
            <i class="fas fa-tag fa-2x me-3"></i>
            <div>
                <h5 class="mb-1">Melhores Preços</h5>
                <p class="mb-0">Todos os reparos e serviços mecânicos estão disponíveis a preços acessíveis.</p>
            </div>
        </div>
        <div class="col-md-4 d-flex align-items-center">
            <i class="fas fa-shield-alt fa-2x me-3"></i>
            <div>
                <h5 class="mb-1">100% de Garantias</h5>
                <p class="mb-0">Todos os nossos reparos e serviços vêm com um período de garantia.</p>
            </div>
        </div>
        <div class="col-md-4 d-flex align-items-center">
            <i class="fas fa-user-check fa-2x me-3"></i>
            <div>
                <h5 class="mb-1">Mecânicos certificados</h5>
                <p class="mb-0">Todos os nossos mecânicos são qualificados e recebem treinamento regularmente.</p>
            </div>
        </div>
    </div>
</div>


<div class="container mt-5 py-4" id="about">
    <div class="row justify-content-between align-items-center">
        <div class="col-md-6 mb-4 mb-md-0">
            <img src="{{ asset('image/artem.png') }}" alt="Imagem de Carro" class="img-fluid w-100" style="max-height: 400px; object-fit: cover;">
        </div>
        <div class="col-md-6 d-flex flex-column">
            <div class="d-flex align-items-center mb-3">
                <i class="fas fa-car fa-2x me-2" style="color: #1E5DBC;"></i>
                <span class="fw-bold fs-5" style="color: #1E5DBC;">Quem Somos</span>
            </div>
            <h3 class="fw-bold text-justify">Serviços de Reparação e Manutenção de Carros Certificados</h3>
            <p class="text-muted text-justify">
                Na nossa empresa, temos o compromisso de oferecer serviços de reparação e manutenção de alta qualidade para o seu veículo. Nossa equipe de profissionais qualificados se dedica a garantir que cada serviço prestado atenda aos mais altos padrões de qualidade e segurança. Acreditamos que a confiança é fundamental, e por isso, trabalhamos incansavelmente para assegurar que seu carro esteja sempre em ótimas condições, proporcionando a você tranquilidade e satisfação.
            </p>
            <div class="mt-5">
                <img src="{{ asset('image/thumb-2.jpg') }}" alt="Imagem de Serviços" class="img-fluid  w-100" style="max-height: 300px; object-fit: cover;">
            </div>
        </div>
    </div>
</div>


<div class="container my-5" id="services">
    <div class="d-flex align-items-center mb-3">
        <i class="fas fa-car-alt fa-2x me-2" style="color: #1E5DBC;"></i>
        <span class="fw-bold fs-5" style="color: #1E5DBC;">O que oferecemos</span>
    </div>
    <h3 class="fw-bold text-justify">Explore nossos serviços</h3>
    <div class="row row-cols-1 row-cols-md-3 g-4 mt-4">
        <div class="col">
            <div class="card h-100">
                <img src="{{asset('image/thumb-3.jpg')}}" class="card-img-top" alt="Imagem 1">
                <div class="card-body">
                    <h5 class="card-title fw-bold" style="color: #1E5DBC;">Oléo & Fluidos</h5>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card h-100">
                <img src="{{asset('image/thumb-4.jpg')}}" class="card-img-top" alt="Imagem 2">
                <div class="card-body">
                    <h5 class="card-title fw-bold" style="color: #1E5DBC;">Calibragem de Pneus</h5>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card h-100">
                <img src="{{asset('image/thumb-5.jpg')}}" class="card-img-top" alt="Imagem 3">
                <div class="card-body">
                    <h5 class="card-title fw-bold" style="color: #1E5DBC;"> Revisão Completa</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center mt-5">
        <a href="#" class="btn btn-outline-primary btn-lg">Mais Serviços</a>
    </div>
</div>

<div class="container my-5" id="usecase">
    <div class="position-relative">
        <img src="{{asset('image/thumb-6.jpg')}}" class="img-fluid" alt="Descrição da Imagem">
        <div class="position-absolute top-50 end-0 translate-middle-y bg-white  p-3" style="width: 300px; margin-right: -20px;" class="rounded shadow">
            <div class="d-flex align-items-center mb-3 ">
                <i class="fas fa-wrench fa-2x me-2" style="color: #1E5DBC;"></i>
                <span class="fw-bold fs-5" style="color: #1E5DBC;">último serviço</span>
            </div>
            <h3 class="fw-bold text-justify">Peças de Performance Subaru WRX STI</h3>
            <p>Cada componente é escolhido para otimizar a potência e a eficiência do seu veículo, garantindo que você aproveite ao máximo cada curva.</p>
            <ul type="point">
                <li><strong>Marca:</strong> Subaru Impreza</li>
                <li><strong>Submodelo:</strong> 4 portas 2.0L 5MT AWD (152 HP)</li>
                <li><strong>Motor:</strong> 2000 cc turbo tipo EJ20.</li>
                <li><strong>Cor:</strong> Azul</li>
            </ul>
        <a href="#" class="btn" style="background-color: #1E5DBC; color: white; border: none; padding: 10px 20px; text-decoration: none; border-radius: 5px; width: 100%;">Veja Também Outros</a>
        </div>
    </div>
</div>


<div class="container my-5">
    <div class="text-center mb-5">
        <div class="d-flex justify-content-center align-items-center mb-3">
            <i class="fas fa-comments fa-2x me-2" style="color: #1E5DBC;"></i>
            <h2 class="fw-bold mb-0" style="color: #1E5DBC;">O Que Dizem Sobre Nós</h2>
        </div>
        <p class="text-muted">
            Confira as opiniões de quem já confiou em nossos serviços e teve uma experiência incrível.
        </p>
    </div>
    <div class="row g-4">
        <div class="col-md-4">
            <div class="p-4 bg-light rounded shadow-sm text-center">
                <i class="fas fa-quote-left fa-2x text-primary mb-3"></i>
                <p class="text-muted">
                    "Serviço excelente! A equipe foi muito profissional e eficiente. Recomendo sem dúvidas."
                </p>
                <div class="d-flex align-items-center justify-content-center mt-3">
                    <img src="{{asset('image/pedro.png')}}" alt="Avatar" class="rounded-circle me-2" style="width: 50px; height: 50px;">
                    <div>
                        <h6 class="fw-bold mb-0" style="color: #1E5DBC;">Pedro Tchinhangua</h6>
                        <small class="text-muted">Lubango, Minhota</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-4 bg-light rounded shadow-sm text-center">
                <i class="fas fa-quote-left fa-2x text-primary mb-3"></i>
                <p class="text-muted">
                    "A qualidade do serviço foi além das minhas expectativas. Atendimento impecável!"
                </p>
                <div class="d-flex align-items-center justify-content-center mt-3">
                    <img src="{{asset('image/nelson.jpg')}}" alt="Avatar" class="rounded-circle me-2" style="width: 50px; height: 50px;">
                    <div>
                        <h6 class="fw-bold mb-0" style="color: #1E5DBC;">Avelino Molõssande</h6>
                        <small class="text-muted">Lubango, Comercial</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-4 bg-light rounded shadow-sm text-center">
                <i class="fas fa-quote-left fa-2x text-primary mb-3"></i>
                <p class="text-muted">
                    "Muito satisfeita com os resultados! Preço justo e serviço de alta qualidade."
                </p>
                <div class="d-flex align-items-center justify-content-center mt-3">
                    <img src="{{asset('image/jeremias.jpeg')}}" alt="Avatar" class="rounded-circle me-2" style="width: 50px; height: 50px;">
                    <div>
                        <h6 class="fw-bold mb-0" style="color: #1E5DBC;"> Jeremias Tchitieñgeñga </h6>
                        <small class="text-muted">Lubango, Mictha</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container my-5" style="background-color: #1E5DBC; height: 100%;">
    <div class="position-relative" style="padding: 6%; background-image: url('{{ asset('image/Group.png') }}'); background-size: cover; background-position: center;">
         <div class=" text-white p-3" style="width: 500px; margin-left: 20px;">
            <div class="d-flex align-items-center mb-3">
                <i class="fas fa-calendar-alt fa-2x me-2" style="color: white;"></i>
                <span class="fw-bold fs-5"  style="color: white;">Agende uma Consulta</span>
            </div>
            <h3 class="fw-bold text-justify my-3">Confie em nosso serviço para colocá-lo de volta na estrada!</h3>
            <p>Entre em contato conosco para agendar uma consulta e obter um orçamento gratuito. Estamos aqui para ajudar você a encontrar a melhor solução para suas necessidades, garantindo um atendimento personalizado e de qualidade.</p>

            <div class="d-flex align-items-center mb-3 mt-5">
                <i class="fas fa-map-marker-alt fa-1x me-2" style="color: white; background-color: #2B4448; border-radius: 50%; padding: 20px;"></i>
                <div class="text-left">
                    <h5 class="mb-0">Localização</h5>
                    <p class="mb-0">Rua Dr. António Agostinho Neto, Lubango - Huíla</p>
                </div>
            </div>
            <div class="d-flex align-items-center mb-3">
                <i class="fas fa-envelope fa-1x me-2" style="color: white; background-color: #2B4448; border-radius: 50%; padding: 20px;"></i>
                <div class="text-left">
                    <h5 class="mb-0">Email</h5>
                    <p class="mb-0">smartservice@gmail.com</p>
                </div>
            </div>
            <div class="d-flex align-items-center mb-3">
               <i class="fas fa-phone fa-1x me-2" style="color: white; background-color: #2B4448; border-radius: 50%; padding: 20px;"></i>
                <div class="text-left">
                    <h5 class="mb-0">Telefone</h5>
                    <p class="mb-0">927 023 710</p>
                </div>
            </div>

        </div>
        <div id="contact" class="position-absolute top-50 end-0 translate-middle-y bg-white p-3" style="width: 500px; margin-right: -20px;" class="rounded shadow">
            <h3 class="fw-bold text-justify my-3" style="color: #1E5DBC;">Como podemos ajudar</h3>
            @include('messages.success')
            @include('messages.error')
           <form action="/message" method="POST">
    @csrf
    <div class="mb-3">
        <input type="text" class="form-control" name="nome" id="nome" placeholder="Nome" required>
    </div>
    
    <div class="mb-3">
        <input type="text" class="form-control" id="email" placeholder="Titulo" name="titulo" required>
    </div>
    <div class="mb-3">
        <input type="text" class="form-control" name="contacto" id="telefone" placeholder="Contacto" required>
    </div>
    <div class="mb-3">
        <textarea class="form-control" id="mensagem" rows="3" name="conteudo" placeholder="Sua Mensagem" required></textarea>
    </div>
    <button type="submit" class="btn" style="background-color: #2B4448; color: white; border: none; padding: 10px 20px; border-radius: 5px;">Enviar Mensagem</button>
</form>

        </div>
    </div>
</div>

<div class="container my-5" id="faq">
    <div class="d-flex align-items-center mb-3">
        <i class="fas fa-question-circle fa-2x me-2" style="color: #1E5DBC;"></i>
        <span class="fw-bold fs-5" style="color: #1E5DBC;">Perguntas Frequentes</span>
    </div>
    <h3 class="fw-bold text-justify">Tire suas dúvidas</h3>
    <div class="row mt-4">
        <div class="col-md-6 mb-3">
            <div class="border-left p-3" style="border-left: 4px solid #1E5DBC;">
                <h5 class="fw-bold">Como agendar um serviço?</h5>
                <p>Você pode agendar um serviço através do nosso site ou entrando em contato pelo telefone.</p>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="border-left p-3" style="border-left: 4px solid #1E5DBC;">
                <h5 class="fw-bold">Quais formas de pagamento são aceitas?</h5>
                <p>Aceitamos cartões de crédito, débito e pagamentos em dinheiro.</p>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="border-left p-3" style="border-left: 4px solid #1E5DBC;">
                <h5 class="fw-bold">Os serviços têm garantia?</h5>
                <p>Sim, todos os nossos serviços vêm com garantia de qualidade.</p>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="border-left p-3" style="border-left: 4px solid #1E5DBC;">
                <h5 class="fw-bold">Como posso entrar em contato?</h5>
                <p>Você pode nos contatar pelo e-mail ou telefone disponíveis na seção de contato.</p>
            </div>
        </div>
    </div>
</div>


@endsection
