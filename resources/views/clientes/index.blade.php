<x-layout baseRoute={{$baseRoute}}>

  <x-mainHeader baseRoute={{$baseRoute}} query={{$query}} title={{$title}}>
    <li class="nav-item">
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
    </li>
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

    @if(count($clientes) == 0)
    <x-listGroupItem href=''>Não foram encontrados Clientes</x-listGroupItem>
    @endif


    @foreach ($clientes as $c)
    <x-listGroupItem href="/clientes/{{$c->id}}">
      <div class="col col-lg-1 text-secondary fw-bold">
        {{$c->id}}
      </div>
      <div class="col col-lg-7 d-flex flex-column flex-sm-row flex-lg-column text-start justify-content-between">
        <div class="col">
          {{$c->full_name}}
        </div>
        <div class="col p-small text-secondary">
          {{$c->city}}
        </div>
      </div>

      <div class="col col-lg-4 d-flex flex-column flex-sm-row flex-lg-column text-start text-lg-end justify-content-between justify-content-lg-end">
        <div class="p-small d-lg-block text-dark fw-bolder">
          <i class="fa-regular fa-envelope"></i> {{$c->email}}
        </div>

        <div class="p-small">
          <i class="fa-solid fa-mobile-screen-button"></i> {{$c->phone}}
        </div>
      </div>
    </x-listGroupItem>
    @endforeach

  </x-listGroup>

  <div class="container my-5">{!! $clientes->withQueryString()->links('pagination::bootstrap-5') !!}</div>

</x-layout>

<!-- Modal Envio Genérico-->
<div class="modal fade" id="genericShipping" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  @include('clientes.partials.genericShippingAddress')
</div>

<!-- Modal para confirmar apagar o registo -->
<x-modalActionConfirm title='Já criou o novo registo de cliente na Plataforma BidSpirit?' id='createClient' class='text-warning'>
  <x-slot:icon><i class="bi bi-file-earmark-x-fill"></i></i></x-slot:icon>
  <x-slot:body>
    <div class="alert alert-secondary m-3 p-4" role="alert">
      <p>
        <strong>Certifique-se que criou um novo registo de cliente na plataforma BidSpirit.</strong>
        <br>
        Depois guarde o número gerado e use-o na criação do novo cliente.
      </p>
    </div>
  </x-slot:body>
  <x-slot:footer>
    <button type="button" class="btn btn-outline-secondary rounded-pill mx-1 px-4" data-bs-dismiss="modal">Cancelar</button>
    <a href="/clientes/create" class="btn btn-primary rounded-pill mx-1 px-4">Continuar</a>
  </x-slot:footer>
</x-modalActionConfirm>

<!-- Modal Ajuda -->
<x-modalHelp class="modal-dialog-scrollable" title="Ajuda: Clientes" id="clientesHelp">
  @include('manual.partials.clientesManual')
</x-modalHelp>