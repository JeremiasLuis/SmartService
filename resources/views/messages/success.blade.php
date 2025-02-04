@if (session()->has('success'))
    <p class="alert alert-info small">
        <i class="icon fa fa-check"></i>
        {{session('success')}}
    </p>
@endif
