@extends('layouts.app')

@section('title', 'Página Inicial')
@section('content')

<div class="container py-3">
    <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
        <h1 class="display-4 fw-normal text-body-emphasis">Nossos Preços</h1>
        <p class="fs-5 text-body-secondary">Confira abaixo nossos preços competitivos para os serviços oferecidos. Garantimos qualidade e eficiência em cada serviço prestado. Escolha o plano que melhor se adapta às suas necessidades e entre em contato conosco para mais informações.</p></div>
<main>
    <div class="row row-cols-1 row-cols-md-3 gap-5 mb-3 text-center">
        @foreach ($services as $plan)
        <div class="col">
            <div class="card mb-4 rounded-3 shadow-sm" style="width: 400px; ">
                <div class="card-header py-3">
                    <h4 class="my-0 fw-normal">{{$plan->nome}}</h4>
                </div>
                <div class="card-body">
                    <h1 class="card-title pricing-card-title">{{$plan->preco}}<small class="text-body-secondary fw-light">/Kz</small></h1>
                    <div class="h-5">
                        <p>{{ \Illuminate\Support\Str::words($plan->descricao, 30) }}</p>
                    </div>
                    <button type="button" class="w-100 btn btn-lg btn-outline-primary">
                        @if(isset($plan->taxes))
                            Com Taxas Adicionais
                        @else
                            Sem Taxas
                        @endif
                    </button>
                </div>
            </div>
        </div>
      @endforeach
    </div>

</main>

</div>
@endsection
