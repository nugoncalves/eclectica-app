<x-layout baseRoute={{$baseRoute}}>

  <x-mainHeader baseRoute={{$baseRoute}} query={{$query}} title={{$title}}>
    <!-- <li class="nav-item">
      <a href="/clientes/import" class="titleMenuButton btn btn-outline-secondary rounded-pill ms-2 px-4">Importar</a>
    </li>
    <li class="nav-item">
      <button data-bs-toggle="modal" data-bs-target="#genericShipping" class="titleMenuButton btn btn-outline-secondary rounded-pill ms-2 px-4">Envio Genérico</button>
    </li>
    <li class="nav-item">
      <a href="/clientes/create" data-bs-toggle="modal" data-bs-target="#createClient" class="titleMenuButton btn btn-primary rounded-pill ms-2 px-4">Novo</a>
    </li>
    <li class="nav-item">
      <a href="" data-bs-toggle="modal" data-bs-target="#clientesHelp" class="titleMenuButton btn btn-outline-secondary rounded-circle ms-2"><i class="bi bi-question-lg"></i></a>
    </li> -->
  </x-mainHeader>

  {{-- Flash Message --}}
  <x-flashMessage />

  <x-listGroup>
    <x-search baseRoute={{$baseRoute}} />

    <x-listGroupHeader>
      <div class="d-none d-lg-block col-1">#</div>
      <div class="d-none d-lg-block col-7">Nome Completo</div>
      <div class="d-none d-lg-block col-4 text-end">Contactos</div>
      <div class="d-block d-lg-none col-12">Cliente</div>
    </x-listGroupHeader>

    @if(count($fornecedores) == 0)
    <x-listGroupItem href=''>Não foram encontrados Clientes</x-listGroupItem>
    @endif


    @foreach ($fornecedores as $f)
    <x-listGroupItem href="/fornecedores/{{$f->id}}">
      <!-- <div class="col col-lg-1 text-secondary fw-bold">
        {{$f->id}}
      </div> -->
      <div class="col col-lg-1 d-flex flex-column flex-sm-row flex-lg-column justify-content-between justify-content-lg-start">
        <div class="p-small d-lg-block text-dark fw-bolder">
          {{$f->id}}
        </div>

        <div class="p-small">
          {{$f->seller_reference}}
        </div>
      </div>
      <div class="col col-lg-7 d-flex flex-column flex-sm-row flex-lg-column text-start justify-content-between">
        <div class="col">
          {{$f->full_name}}
        </div>
        <div class="col p-small text-secondary">
          {{$f->city}}
        </div>
      </div>

      <div class="col col-lg-4 d-flex flex-column flex-sm-row flex-lg-column text-start text-lg-end justify-content-between justify-content-lg-end">
        <div class="p-small d-lg-block text-dark fw-bolder">
          <i class="fa-regular fa-envelope"></i> {{$f->email}}
        </div>

        <div class="p-small">
          <i class="fa-solid fa-mobile-screen-button"></i> {{$f->phone}}
        </div>
      </div>
    </x-listGroupItem>
    @endforeach

  </x-listGroup>

  <div class="container my-5">{!! $fornecedores->withQueryString()->links('pagination::bootstrap-5') !!}</div>

</x-layout>