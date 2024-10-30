<x-layout baseRoute="{{ $baseRoute }}">

  {{-- Title Menu --}}
  <x-mainHeader baseRoute="{{ $baseRoute }}" query="{{ $query }}" title="{{ $title }}">

    <li class="nav-item dropdown">
      <button class="titleMenuButton btn btn-outline-secondary rounded-pill dropdown-toggle ms-2 px-4"
        role="button" data-bs-toggle="dropdown" aria-expanded="false">
        Acções
      </button>
      <ul class="dropdown-menu">
        @if ($lote->verbete_id > 0)
          <li>
            <a href="javascript:void(0)" class="dropdown-item" data-bs-toggle="modal"
              data-bs-target="#verbetes_form" hx-get="/verbetes/modal/{{ $lote->verbete_id }}"
              hx-target="#verbeteContent" hx-sync="this:replace" hx-swap="innerHTML"
              hx-indicator="#verbete_indicator">
              <i class="fa-solid fa-spell-check me-1"></i> Abrir Verbete
            </a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>
        @endif
        <li>
          <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#verbetes_list"
            class="dropdown-item">
            <i class="fa-solid fa-spell-check me-1"></i> Atribuir Verbete
          </a>
        </li>
        <li>
          <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#modal_nova_colocacao"
            aria-controls="modal_nova_colocacao" class="dropdown-item"
            {{ $lote->status != 'disponível' ? 'disabled' : '' }}>
            <i class="fa-solid fa-gavel me-1"></i> Nova Colocação
          </a>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>
        <li>
          <a href="/lotes/{{ $lote->id }}/print" target="_blank" type="submit" class="dropdown-item">
            <i class="bi bi-printer-fill"></i> Imprimir Ficha Bibliográfica
          </a>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>
        <li>
          <a href="/lotes/{{ $lote->id }}/edit" class="dropdown-item">
            <i class="fa-solid fa-file-contract me-1"></i> Editar Dados Contrato
          </a>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>
        <li>
          <a class="dropdown-item" href="/lotes/create">
            <i class="bi bi-file-earmark-plus"></i> Novo
          </a>
        </li>

        <li>
          <a class="dropdown-item link-danger " href="#" data-bs-toggle="modal"
            data-bs-target="#deleteModal">
            <i class="bi bi-trash3"></i> Apagar
          </a>
        </li>

      </ul>
    </li>
    @if ($ultimaColocacao)
      <li class="nav-item">
        <a href="/itemsLeilao/print/label/{{ $ultimaColocacao->id }}" target="_blank"
          class="titleMenuButton btn btn-outline-secondary rounded-pill ms-2 px-4">Etiqueta</a>
      </li>
    @endif
    <li class="nav-item">
      <a href="/lotes{{ $query }}" type="submit"
        class="titleMenuButton btn btn-outline-secondary rounded-pill ms-2 px-4">Voltar</a>
    </li>
    <li class="nav-item">
      <button type="submit" form="main_form"
        class="titleMenuButton btn btn-primary rounded-pill ms-2 px-4">Gravar</button>
    </li>
    <li class="nav-item">
      <a href="" data-bs-toggle="modal" data-bs-target="#lotesHelp"
        class="titleMenuButton btn btn-outline-secondary rounded-circle ms-2"><i
          class="bi bi-question-lg"></i></a>
    </li>
  </x-mainHeader>

  <x-flashMessage />

  <div class="container mt-3">

    <div class="row justify-content-center">
      <!-- Main Form (Left Main Col) -->
      @include('lotes.partials.mainForm')

      <!-- Other Info (Left Col) -->
      <div class="col col-xl-4">
        <!-- QrCode -->
        <x-formCard class="mb-4 d-flex flex-row justify-content-between">
          <div class="border border-danger flex-shrink-0">
            {!! $qrcode !!}
          </div>
          <div class="border border-success flex-grow-1">Teste</div>

        </x-formCard>
        <!-- Colocações em Leilões -->
        @include('lotes.partials.colocacoes')

        <!-- Outros Exemplares em Leilões -->
        @if (count($outros))
          @include('lotes.partials.outrosExemplares')
        @endif

        <!-- Informações Gerais -->
        @include('lotes.partials.info')

      </div>

    </div>
    <div class="row my-3"></div>
  </div>
</x-layout>

<!-- OffCanvas Colocacoes -->
<x-offcanvas class="offcanvas-size-xxl" title='Colocação em Leilão' name='colocacoes' static=1></x-offcanvas>

<!-- OffCanvas Nova Colocação -->
@include('lotes.partials.colocacaoNew')

<!-- Modal Duplicar Lote -->
@include('lotes.modal.duplicateItemLeilao')

<!-- Modal Apagar Lote -->
@include('lotes.modal.deleteItemLeilao')

<!-- OffCanvas Verbetes -->
@include('verbetes.modal.list')

<!-- OffCanvas Cliente Overview -->
<x-offcanvas class="offcanvas-size-xl" title='Cliente' name='cliente'></x-offcanvas>

<!-- Modal Ajuda -->
<x-modalHelp class="modal-dialog-scrollable" title="Ajuda: Lotes" id="lotesHelp">
  @include('manual.partials.lotesManual')
</x-modalHelp>

<!-- LOTES JAVASCRIPT -->
<script src="{{ asset('js/lotes.js') }}"></script>

<!-- HOT KEYS -->
@include('lotes.partials.hotkeys')
