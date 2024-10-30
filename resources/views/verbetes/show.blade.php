<x-layout baseRoute={{$baseRoute}}>

  {{-- FLASH MESSAGE --}}
  <x-flashMessage />

  <form method="POST" action="/verbetes/{{$verbete->id}}">
    @csrf
    @method('PUT')

    {{-- Title Menu--}}
    <x-mainHeader baseRoute={{$baseRoute}} query={{$query}} title={{$title}}>
      <li class="nav-item dropdown">
        <button class="titleMenuButton btn btn-outline-secondary rounded-pill dropdown-toggle ms-2 px-4" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Acções </i>
        </button>
        <ul class="dropdown-menu">
          <li>
            <a class="dropdown-item" href="/verbetes/create">
              <i class="bi bi-file-earmark-plus"></i> Novo
            </a>
          </li>

          <li>
            <a class="dropdown-item" href="/verbetes/print/{{$verbete->id}}" target="_blank">
              <i class="fa-solid fa-print"></i> Imprimir
            </a>
          </li>
          <li>
            <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#duplicateModal" aria-labelledby="duplicateModal">
              <i class="bi bi-copy"></i> Duplicar
            </a>
          </li>
          <li>
            <a class="dropdown-item link-danger" href="#" data-bs-toggle="modal" data-bs-target="#deleteModal" aria-labelledby="deleteModal">
              <i class="bi bi-trash3"></i> Apagar
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-item">
        <a href="/verbetes{{$query}}" type="submit" class="titleMenuButton btn btn-outline-secondary rounded-pill mx-2 px-4">Voltar</a>
      </li>
      <li class="nav-item">
        <button type="submit" class="titleMenuButton btn btn-primary rounded-pill px-4">Gravar</button>
      </li>
      <li class="nav-item">
        <a href="" data-bs-toggle="modal" data-bs-target="#verbetesHelp" class="titleMenuButton btn btn-outline-secondary rounded-circle ms-2"><i class="bi bi-question-lg"></i></a>
      </li>
    </x-mainHeader>

    {{-- Div de Conteúdo --}}
    <div class="container mt-3">
      <div class="row justify-content-center">
        <div class="col col-xl-8 mb-4">

          <!-- Main Form (Left Main Col) -->
          @include('verbetes.partials.mainform')
        </div>

        <!-- Other Info (Left Col) -->
        <div class="col col-xl-4">

          {{-- Histórico do Título em Leilões --}}
          @include('partials.historico')

          {{-- Lista de Compradores --}}
          @include('verbetes.partials.compradores')

          {{-- Lista de Under Bidders  --}}
          @if(count($licitantes)>0)
          @include('verbetes.partials.underBidders')
          @endif
        </div>

        <div class="row my-3"></div>
      </div>
    </div>
  </form>
</x-layout>

{{-- OffCanvas Colocacoes --}}
<x-offcanvas class="offcanvas-size-xxl" title='Colocação em Leilão' name='colocacoes'>
  <div class="d-flex justify-content-center htmx-indicator" id="colocacoes_indicator"><img src="{{asset('assets/svg-loaders/stampede.gif')}}" height="20px"></div>
</x-offcanvas>

{{-- OffCanvas Cliente Overview  --}}
<x-offcanvas class="offcanvas-size-xl" title='Cliente' name='cliente'></x-offcanvas>


<!-- MODAIS -->

<!-- Modal para confirmar DUPLICAR o registo -->
<x-modalActionConfirm title='Tem a certeza que quer duplicar o verbete?' id='duplicateModal' class='text-warning'>
  <x-slot:icon><i class="fa-solid fa-copy"></i></x-slot:icon>
  <x-slot:body>
    <div class="alert alert-secondary m-3 p-4" role="alert">
      @include('verbetes.partials.verbete_overview')
    </div>
  </x-slot:body>
  <x-slot:footer>
    <button type="button" class="btn btn-outline-secondary rounded-pill mx-1 px-4" data-bs-dismiss="modal">Cancelar</button>
    <a href="/verbetes/{{$verbete->id}}/duplicate" class="btn btn-warning rounded-pill mx-1 px-4">Duplicar</a>
  </x-slot:footer>
</x-modalActionConfirm>


<!-- Modal para confirmar apagar o registo -->
<x-modalActionConfirm title='Tem a certeza que quer apagar o verbete?' id='deleteModal' class='text-danger'>
  <x-slot:icon><i class="bi bi-file-earmark-x-fill"></i></i></x-slot:icon>
  <x-slot:body>
    <div class="alert alert-secondary m-3 p-4" role="alert">
      @include('verbetes.partials.verbete_overview')
    </div>
    <p class="text-center text-secondary">Não será possível recuperar o registo depois de apagado.</p>
  </x-slot:body>
  <x-slot:footer>
    <button type="button" class="btn btn-outline-secondary rounded-pill mx-1 px-4" data-bs-dismiss="modal">Cancelar</button>
    <form method="POST" action="/verbetes/{{$verbete->id}}">
      @csrf
      @method('DELETE')
      <button class="btn btn-danger rounded-pill mx-1 px-4">Apagar</button>
    </form>
  </x-slot:footer>
</x-modalActionConfirm>

<!-- Modal Ajuda -->
<x-modalHelp class="modal-dialog-scrollable" title="Ajuda: Lotes" id="verbetesHelp">
  @include('manual.partials.verbetesManual')
</x-modalHelp>

<!-- VERBETES JAVASCRIPT -->
<script src="{{asset('js/verbetes.js')}}"></script>