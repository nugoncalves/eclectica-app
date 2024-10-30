{{-- LISTA DE LOTES --}}
<div class="list-group rounded shadow bg-white mb-1" id="lotes_de_leilao">
  {{-- CABEÇALHO --}}
  <div class="row align-items-center justify-content-between py-3 px-5">
    <div class="col-12 col-lg-4 fw-bold fs-5 text-dark-emphasis">
      <div>Lista de Lotes</div>
      <div class="p-xtra-small p-0 m-0">[Lotes: {{ $totais['lotes'] }}]</div>
    </div>
  </div>

  <x-listGroupHeader>
    <div class="d-none d-lg-block col-1"></div>
    <div class="d-none d-lg-block col-9">Descrição</div>
    <div class="d-none d-lg-block text-end col-2">A Pagar</div>
    <div class="d-block d-lg-none col">Sumário</div>
  </x-listGroupHeader>

  {{-- Lotes --}}
  <div class="overflow-auto rounded-bottom" style="max-height: 600px;" id="lotes_de_leilão">
    <form id="lista_lotes" method="POST" action="/pagamentos" id="lista_lotes" hx-post="/pagamentos/totais"
      hx-sync="this:replace" hx-target="#totais" hx-swap="outerHTML" hx-trigger="change">
      @csrf

      @foreach ($lotes as $i => $l)
        <div class="py-4 ps-5 pe-3 list-group-item list-group-item-action list-parent">
          <!-- Hidden Inputs para passar Dados -->
          <input type="hidden" name="lotes[{{ $i }}][id]" value="{{ $l->id }}">
          <input type="hidden" name="lotes[{{ $i }}][items_contrato_id]" value="{{ $l->items_contrato_id }}">
          <input type="hidden" name="lotes[{{ $i }}][leilao_id]" value="{{ $l->leilao_id }}">
          <input type="hidden" name="lotes[{{ $i }}][seller_id]" value="{{ $l->seller_id }}">
          <input type="hidden" name="lotes[{{ $i }}][price]" value="{{ $l->price }}">
          <input type="hidden" name="lotes[{{ $i }}][commission_seller]" value="{{ $l->commission_seller }}">

          {{-- TODO Campo provisório apenas para a criação de pagamentos antigos APAGAR APÓS CONCLUIR --}}
          <input type="hidden" name="lotes[{{ $i }}][date]"
            value="{{ date('Y-m-te', strtotime($leilao->end_date) + 30) }}">

          <div class="row d-flex flex-column flex-lg-row align-items-center">
            <div class="col col-lg-1 flex-row text-secondary fw-bold p-xtra-small">
              <input class="form-check-input" type="checkbox" value="1" name="lotes[{{ $i }}][check]" checked>
            </div>
            <div class="col col-lg-8 p-small">
              <span class="text-secondary fw-bold">{{ $l->leilao_id }}.{{ $l->leilao_lote }}.</span> {{ $l->main_lang_name }}
            </div>
            <div
              class="col col-lg-2 p-0 m-0 d-flex flex-column flex-sm-row flex-lg-column text-end justify-content-between justify-content-lg-end">
              <div class="col col-lg-12 fw-bold">
                {{ Number::currency($l->price - $l->commission_seller - $l->commission_seller * 0.23, in: 'EUR', locale: 'pt') }}
              </div>
              <div class="col col-lg-12 p-xtra-small text-secondary">
                <i class="fa-solid fa-gavel"></i> {{ Number::currency($l->price, in: 'EUR', locale: 'pt') }}
              </div>
            </div>
            <div class="col-1 p-xtra-small text-end">
              <a href="" class="btn btn-sm" data-bs-toggle="offcanvas" data-bs-target="#offcanvas_lotes"
                aria-controls="offcanvas_lotes" hx-get="/historico/{{ $l->id }}" hx-target="#htmx_lotes"
                hx-sync="this:replace" hx-swap="innerHTML" hx-indicator="#colocacoes_indicator">
                <i class="bi bi-eye-fill"></i>
              </a>
            </div>
          </div>
        </div>
        {{--
            </a> --}}
      @endforeach
  </div>

  </form>
  @include('pagamentos.proforma.partials.totais')
</div>

<!-- Totais -->
{{-- <div class="col d-flex justify-content-end" id="totais">
</div> --}}
