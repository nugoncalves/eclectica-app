<div class="list-group rounded shadow bg-white mb-4" id="lotes_de_leilao">
  <div class="row align-items-center justify-content-between py-3 px-5">
    <div class="col-12 col-lg-4 fw-bold fs-5 text-dark-emphasis">
      <div>Lista de Lotes</div>
      <div class="p-xtra-small p-0 m-0">[Lotes: {{ $totais['lotes'] }}]</div>
    </div>

    <form class='col-12 col-lg-7 mt-3 mt-lg-0' hx-target='#lotes_de_leilao' hx-get='/leiloes/filter_lotes/{{ $leilao->id }}' hx-swap='outerHTML'>
      <div class="input-group input-group-sm align-items-center">
        <input type="search" class="px-3 form-control form-control-sm rounded-pill" name="search" placeholder="Procurar texto..." value="{{ $_GET['search'] ?? '' }}">
        <button class="btn btn-outline-secondary rounded-circle mx-2 btn-sm" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
        @if ($_GET['search'] ?? false)
          <button class="btn btn-outline-danger rounded-pill mx-2 btn-sm" type="submit" hx-target='#lotes_de_leilao' hx-get='/leiloes/filter_lotes/{{ $leilao->id }}' hx-swap='outerHTML' hx-params='none'><i class="fa-solid fa-xmark"></i> Limpar</button>
        @endif
      </div>
      <div hx-boost="true"></div>
    </form>

  </div>
  <x-listGroupHeader>
    <div class="col col-lg-1">Lote</div>
    <div class="d-none d-lg-block col">Descrição</div>
    <div class="d-none d-lg-block col-2 text-end">Valor</div>
  </x-listGroupHeader>
  @if ($totais['lotes'] == 0)
    <div class="p-4">
      Não foram encontrados lotes de leilão com "{{ $_GET['search'] ?? '' }}."
    </div>
  @endif
  <div class="overflow-auto rounded-bottom" style="max-height: 600px;">
    @foreach ($itemsLeilao as $item)
      <a class="py-4 px-5 list-group-item list-group-item-action list-parent"
        href=""
        {{-- href="/historico/{{ $item->id }}"
        target="_blank" --}}
        hx-get="/historico/{{ $item->id }}"
        hx-target="#htmx_lotes"
        hx-sync="this:replace"
        hx-swap="innerHTML"
        hx-indicator="#colocacoes_indicator"
        data-bs-toggle="offcanvas"
        data-bs-target="#offcanvas_lotes"
        aria-controls="offcanvas_lotes">

        <div class="row d-flex flex-column flex-lg-row align-items-center">
          <div class="col col-lg-1 text-secondary fw-bold p-xtra-small">
            {{ $item->leilao_lote }}
          </div>
          <div class="col p-small">
            {{ $item->main_lang_name }}
          </div>

          <div class="flex-row col col-lg-2 d-flex flex-lg-column text-start text-lg-end justify-content-between justify-content-lg-end">
            <div class="p-small d-lg-block text-end fw-bolder">
              <i class="fa-solid fa-gavel"></i> {{ $item->price }} €
            </div>
            <div class="p-small text-end">
              <i class="bi bi-tag"></i> {{ $item->start_price }} €
            </div>
          </div>
        </div>
      </a>
    @endforeach

  </div>

</div>
