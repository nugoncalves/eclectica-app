<x-layout baseRoute="{{ $baseRoute }}">

  {{-- Title Menu --}}
  <x-mainHeader baseRoute="{{ $baseRoute }}" query="{{ $query }}" title="{{ $title }}">
    <li class="nav-item dropdown">
      <button class="titleMenuButton btn btn-outline-secondary rounded-pill dropdown-toggle ms-2 px-4" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        Acções </i>
      </button>
      <ul class="dropdown-menu">
        <li>
          <a class="dropdown-item" href="/lotes/export/{{ $leilao->id }}" target="_blank">
            <i class="fa-solid fa-file-export"></i> Exportar
          </a>
        </li>
        <li>
          <a class="dropdown-item" href="" data-bs-toggle="modal" data-bs-target="#leilaoImport">
            <i class="fa-solid fa-file-import"></i> Processar
          </a>
        </li>
        <li>
          <a class="dropdown-item" href="/leiloes/catalogo/{{ $leilao->id }}" target="_blank">
            <i class="bi bi-file-earmark-word-fill"></i> Catálogo
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
      <a href="/leiloes{{ $query }}" type="submit" class="titleMenuButton btn btn-outline-secondary rounded-pill mx-2 px-4">Voltar</a>
    </li>

    <li class="nav-item">
      <button type="submit" form="main_form" class="titleMenuButton btn btn-primary rounded-pill px-4">Gravar</button>
    </li>
    <li class="nav-item">
      <a href="" data-bs-toggle="modal" data-bs-target="#leiloesHelp" class="titleMenuButton btn btn-outline-secondary rounded-circle ms-2"><i class="bi bi-question-lg"></i></a>
    </li>
  </x-mainHeader>

  {{-- FLASH MESSAGE --}}
  <x-flashMessage />

  <div class="container mt-3">
    <div class="row justify-content-center">
      <div class="col col-xl-8">

        @include('leiloes.partials.mainForm')

        @include('leiloes.partials.lotes_de_leilao')

      </div>

      <!-- Other Info (Left Col) -->
      <div class="col-12 col-xl-4">
        {{-- Estatísticas Gerais --}}
        <x-formCard class="mb-4">
          <x-infoCard.title title="Informações Gerais" />

          <x-infoCard.infoData name="Total de Lotes" :value="$totais['lotes']" />
          <x-infoCard.infoData name="Total Bases" :value="$totais['bases']" />
          <x-infoCard.infoData name="Total Estimativa" :value="$totais['estimativas']" />

        </x-formCard>
      </div>
    </div>
  </div>

</x-layout>

{{-- OffCanvas Lotes --}}
<x-offcanvas class="offcanvas-size-xxl" title='Lote' name='lotes'></x-offcanvas>

{{-- Modal para Importação de Resultados --}}
@include('leiloes.modal.import')

<!-- Modal para confirmar apagar o registo -->
<x-modalActionConfirm title='Tem a certeza que quer apagar o leilão?' id='deleteModal' class='text-danger'>
  <x-slot:icon><i class="bi bi-file-earmark-x-fill"></i></i></x-slot:icon>
  <x-slot:body>
    <div class="alert alert-secondary m-3 p-4" role="alert">
      <p>
        <strong>{{ $leilao->id }}</strong>
        <br>
        {{ $leilao->end_date }}
        <br>
        {{ $leilao->name }}
      </p>
    </div>
    <p class="text-center text-secondary">Não será possível recuperar o registo depois de apagado.</p>
  </x-slot:body>
  <x-slot:footer>
    <button type="button" class="btn btn-outline-secondary rounded-pill mx-1 px-4" data-bs-dismiss="modal">Cancelar</button>
    <form method="POST" action="/leiloes/{{ $leilao->id }}">
      @csrf
      @method('DELETE')
      <button class="btn btn-danger rounded-pill mx-1 px-4">Apagar</button>
    </form>
  </x-slot:footer>
</x-modalActionConfirm>

<!-- Modal Ajuda -->
<x-modalHelp class="modal-dialog-scrollable" title="Ajuda: Leilões" id="leiloesHelp">
  @include('manual.partials.leiloesManual')
</x-modalHelp>
