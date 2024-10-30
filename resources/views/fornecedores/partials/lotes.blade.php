<!-- LISTA DE LEILÕES COM LOTES DE FORNECEDOR -->

<div class="list-group rounded shadow bg-white mb-4" id="lotes_de_leilao">
  <div class="row align-items-center justify-content-between py-3 px-5">
    <div class="col-12 col-lg-4 fw-bold fs-5 text-dark-emphasis">
      <div>Lista de Lotes</div>
    </div>

    <form class='col-12 col-lg-7 mt-3 mt-lg-0' hx-target='#fornecedores_content' hx-get='/fornecedores/lotes/{{$fornecedor->id}}' hx-boost='true' hx-swap='innerHTML'>
      <!-- <form class='col-12 col-lg-7 mt-3 mt-lg-0' action='/fornecedores/lotes/4085' target="_blank"> -->
      <div class="input-group input-group-sm align-items-center">
        <input type="search" class="px-3 form-control form-control-sm rounded-pill" name="search" placeholder="Procurar texto..." value="{{ $_GET['search'] ?? '' }}">
        <button class="btn btn-outline-secondary rounded-circle mx-2 btn-sm" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
        @if ($_GET['search'] ?? false)
        <button class="btn btn-outline-danger rounded-pill mx-2 btn-sm" type="submit" hx-target='#fornecedores_content' hx-get='/fornecedores/lotes/{{ $fornecedor->id }}' hx-swap='innerHTML' hx-params='none'><i class="fa-solid fa-xmark"></i> Limpar</button>
        @endif
      </div>
    </form>

  </div>
  <x-listGroupHeader>
    <div class="col col-lg-2">Contrato</div>
    <div class="d-none d-lg-block col">Descrição</div>
    <div class="d-none d-lg-block col-2 text-end">Valor</div>
  </x-listGroupHeader>
  @if (empty($items_contrato))
  <div class="p-4">
    Não foram encontrados lotes com "{{ $_GET['search'] ?? '' }}."
  </div>
  @endif
  <div class="rounded-bottom">
    @foreach ($items_contrato as $item)
    <a href="" class="py-4 px-5 list-group-item list-group-item-action list-parent" data-bs-toggle="offcanvas" data-bs-target="#offcanvas_lotes" aria-controls="offcanvas_lotes" hx-get="/historico/{{ $item->id }}" hx-target="#htmx_lotes" hx-sync="this:replace" hx-swap="innerHTML" hx-indicator="#colocacoes_indicator">

      <div class="row d-flex flex-column flex-lg-row align-items-center">
        <div class="flex-row col col-lg-2 d-flex flex-lg-column text-start justify-content-between justify-content-lg-start">
          <div class="p-small d-lg-block fw-bolder">
            {{ $item->contrato_id }} - {{ $item->contrato_index  }}
          </div>
          <div class="p-small">
            {{ ($item->status) }}
          </div>
        </div>
        <div class="col p-small">
          {{ $item->main_lang_name }}
        </div>

        <div class="flex-row col col-lg-2 d-flex flex-lg-column text-start text-lg-end justify-content-between justify-content-lg-end">
          <div class="p-small d-lg-block text-end fw-bolder">
            <i class="fa-solid fa-gavel"></i> {{ ($item->itemsLeilaoLast->price) ?? '0' }} €
          </div>
          <div class="p-small text-end">
            <i class="bi bi-tag"></i> {{ ($item->itemsLeilaoLast->start_price) ?? '0' }} €
          </div>
        </div>
      </div>
    </a>
    @endforeach

    <div class="container my-5 px-5" id="pagination_links" hx-boost="true" hx-target="#fornecedores_content">
      {!! $items_contrato->withQueryString()->links('pagination::bootstrap-5') !!}
    </div>
  </div>

</div>