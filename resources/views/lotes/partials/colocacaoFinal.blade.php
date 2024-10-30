<!-- DADOS FINAIS DA COLOCAÇÃO -->

<div class=" {{ $leilao->status == 'espera' ? 'd-none' : '' }}">

  <!-- HTMX INDICATOR -->
  <div class="d-flex justify-content-center htmx-indicator" id="colocacoes_indicator">
    <img src="{{ asset('assets/svg-loaders/stampede.gif') }}" height="20px">
  </div>

  <!-- INFO SOBRE LOTE -->
  <x-formCard>
    <div id="info-itemLeilao">
      <div class="mt-3 d-flex flex-row justify-content-between align-items-center">
        <div class="col-8">
          <div class="h6 text-info-emphasis mt-2 mb-0">
            <span class="fw-bold">[ {{ $iL->leilao_id ?? '' }}.{{ $iL->leilao_lote ?? '' }} ]</span>
            {{ $leilao->name ?? '' }}
          </div>

          <div class="fw-bold text-secondary fs-5 mt-2 mb-0">
            {{ $iC->main_lang_name ?? '' }}
          </div>
        </div>
        <div class="col-4 fs-3 mb-0 fw-bold text-end" id="item-price-div">
          <div class="text-end m-0 p-0">
            <i class="fa-solid fa-gavel"></i> {{ $iL->price ?? '0' }} €
          </div>
          <div class="border-warning p-xtra-small text-end text-secondary m-0 p-0">
            <i class="bi bi-tag"></i> {{ $iL->start_price ?? '0' }} €
          </div>
        </div>
      </div>
    </div>
  </x-formCard>

  <!-- STATUS AND NOTES -->
  <x-formCard class="mt-3" id="lote_status">
    @include('lotes.htmx_views.status')
  </x-formCard>

  <!-- IMAGENS -->
  @if (count($images) > 0)
    <x-formCard class="mt-3">
      @foreach ($images as $img)
        <img src="{{ asset($img->path) }}" alt="{{ $iL->id }}" class="img-thumbnail m-1" style="max-width: 150px; max-height: 150px; " />
      @endforeach
    </x-formCard>
  @endif

  <!-- INFO SOBRE COMPRADOR -->
  @if ($comprador)
    <x-formCard class="mt-3">

      <x-infoCard.title title="Comprador" />
      <div class="row">
        <div class="col-12 text-center text-secondary" style="font-size: 5rem;">
          <h4 class="text-secondary fw-bold">
            {{ $comprador->id ?? 'Indeterminado' }} | <span class="fw-bold">{{ $comprador->id === 0 ? 'comprador Indeterminado' : $comprador->full_name }}</span>
            <a href="/clientes/{{ $comprador->id }}" class="text-secondary ms-2"><i class="bi bi-pencil-square"></i></a>
          </h4>
          <p class="p-xtra-small">{{ $comprador->address }}, {{ $comprador->zip }} {{ $comprador->city }} {{ $comprador->state ? ', ' . $comprador->state : '' }}, {{ $comprador->country }}</p>
        </div>
        <div class="px-5 ">
          <div class="row my-3">
            <div class="col-12 col-lg-6 "><i class="bi bi-phone me-2"></i> Telefone</div>
            <div class="col-12 col-lg-6 text-primary text-start text-lg-end">{{ $comprador->phone }}</div>
          </div>
          <div class="row my-3">
            <div class="col-12 col-lg-6"><i class="bi bi-envelope-at me-2"></i> E-Mail</div>
            <div class="col-12 col-lg-6 text-primary text-start text-lg-end"><a href="mailto:{{ $comprador->email }}"
                target="_blank">{{ $comprador->email }}</a></div>
          </div>
        </div>
        <div class="row px-5 justify-content-center text-center">
          <a href="/clientes/{{ $comprador->id }}/shippingLabel" target="_blank"
            class="col col-lg-5 px-3 btn btn-sm btn-primary rounded rounded-pill">Etiqueta Envio</a>
        </div>
      </div>

    </x-formCard>
  @endif

  <!-- LISTA DE LICITAÇÕES -->
  @if (count($licitacoes))
    <x-formCard class="mt-3">

      <x-infoCard.title title="Licitações" />

      <x-infoCard.infoTable>

        <x-slot:tableHeader>
          <th class="p-xtra-small text-center">Licitante</th>
          <th class="p-xtra-small">Nome</th>
          <th class="p-xtra-small text-center">Data & Hora</th>
          <th class="p-xtra-small text-end">Valor</th>
        </x-slot:tableHeader>
        <x-slot:tableBody>
          @foreach ($licitacoes as $licitacao)
            <tr class="{{ $licitacao->sold_bid == 1 ? 'table-success' : '' }}">
              <td class="p-xtra-small text-center">{{ $licitacao->bidder_id }}</td>
              <td class="p-xtra-small">{{ $licitacao->full_name }}</td>
              <td class="p-xtra-small text-center">{{ $licitacao->bid_time }}</td>
              <td class="p-xtra-small text-end">{{ $licitacao->bid_price }} €</td>
              <td></td>
            </tr>
          @endforeach
        </x-slot:tableBody>

      </x-infoCard.infoTable>

    </x-formCard>
  @endif

</div>
