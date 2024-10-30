@if(session()->has('message'))
<div class="container">
  <div class="row">
    <div {{ $attributes->merge(['class' => 'alert alert-success alert-dismissible fade show']) }} role="alert">
      <i class="bi bi-check-circle-fill"></i> {{session('message')}}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  </div>
</div>
@endif

@if(session()->has('warning'))
<div class="container mt-3">
  <div class="row">
    <div {{ $attributes->merge(['class' => 'alert alert-warning alert-dismissible fade show']) }} role="alert">
      <i class="fa-solid fa-triangle-exclamation"></i> {{ session('warning') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  </div>
</div>
@endif

@if(session()->has('error'))
<div class="container mt-3">
  <div class="row">
    <div {{ $attributes->merge(['class' => 'alert alert-danger alert-dismissible fade show']) }} role="alert">
      <i class="fa-solid fa-triangle-exclamation"></i> {{ session('error') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  </div>
</div>
@endif


@if ($errors->any())
<div class="alert alert-danger alert-dismissible fade show">
  <div class="fw-bold h4">Ocorreram erros</div>
  <ul class="list-unstyled">
    @foreach ($errors->all() as $error)
    <li class="ms-3"><i class="fa-regular fa-circle-right"></i> {{ $error }}</li>
    @endforeach
  </ul>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif