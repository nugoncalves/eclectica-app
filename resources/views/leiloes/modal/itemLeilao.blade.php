{{-- LEILÃO TERMINADO: Resultados [não permite edições] --}}
<x-formCard class="mt-3">

  <div id="info-itemLeilao">
    <div class="mt-3 d-flex flex-row justify-content-between align-items-center">
      <div>
        @if($iL->devolvido)
        <span class="px-4 py-1 text-tertiary bg-secondary-subtle rounded-pill">Devolvido</span>
        @elseif ($iL->vendido)
        <span class="px-4 py-1 rounded-pill text-bg-success">Vendido</span>
        @else
        <span class="px-4 py-1 text-bg-warning rounded-pill">Retirado</span>
        @endif
      </div>
      <div class="fs-3 mb-0 fw-bold" id="item-price-div">
        <i class="fa-solid fa-gavel"></i> {{ ($iL->price) ?? '0' }}</span> €
      </div>
    </div>
    <div class="h6 fw-bold text-info-emphasis mt-2 mb-0">
      {{ ($iL->leilao_id) ?? '' }}.{{ ($iL->leilao_lote) ?? '' }} | {{ ($leilao->data) ?? '' }}
    </div>
    <div class="h4 fw-bold text-info-emphasis mt-2 mb-0">
      {{ ($leilao->name) ?? '' }}
    </div>
  </div>

</x-formCard>

<x-formCard class="mt-3">
  <x-infoCard.title title="Comprador" />
  <div>{{ ($comprador->id) ?? '????' }} | <span class="fw-bold">{{ ($comprador->id === 0) ? 'Cliente Indeterminado' : $comprador->full_name}}</span></div>
</x-formCard>

{{-- Licitações --}}
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
      @foreach($licitacoes as $licitacao)
      <tr class="{{$comprador->id===$licitacao->bidder_id ? 'table-success' : '' }}">
        <td class="p-xtra-small text-center">{{$licitacao->bidder_id}}</td>
        <td class="p-xtra-small">{{$licitacao->full_name}}</td>
        <td class="p-xtra-small text-center">{{$licitacao->bid_time}}</td>
        <td class="p-xtra-small text-end">{{$licitacao->bid_price}} €</td>
        <td></td>
      </tr>
      @endforeach
    </x-slot:tableBody>

  </x-infoCard.infoTable>

</x-formCard>