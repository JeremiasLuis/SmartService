



@if (session()->has('error'))
    <p class="alert alert-danger small">
        <i class="icon fa fa-warning"></i>
        {{session('error')}}
    </p>
@endif


