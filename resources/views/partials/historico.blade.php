{{-- Histórico de Colocações em Leilões --}}
<x-formCard>

  <x-infoCard.title title="Histórico" />

  <x-infoCard.infoTable>

    <x-slot:tableHeader>
      <th class="p-xtra-small text-center">Leilão</th>
      <th class="p-xtra-small text-center">Lote</th>
      <th class="p-xtra-small text-end">Base</th>
      <th class="p-xtra-small text-end">Martelo</th>
    </x-slot:tableHeader>
    <x-slot:tableBody>
      @foreach ($itemsLeilao as $item)
        <tr style="transform: rotate(0);" data-bs-toggle="tooltip" data-bs-title="{{ $item->sold == 1 ? 'Vendido | ' : 'Retirado' }} {{ $item->buyer_id }}" data-bs-placement="left" class="{{ $item->sold == 1 ? 'table-success' : '' }}">
          <td class="p-xtra-small text-center">{{ $item->leilao_id }}</td>
          <td class="p-xtra-small text-center">{{ $item->leilao_lote }}</td>
          <td class="p-xtra-small text-end">{{ $item->start_price }} €</td>
          <td class="p-xtra-small text-end">{{ $item->price }} €</td>
          <td>
            <a href="javascript:void(0)" class="stretched-link text-secondary"
              hx-get="/historico/{{ $item->id }}"
              hx-target="#htmx_colocacoes"
              hx-sync="this:replace"
              hx-swap="innerHTML"
              hx-indicator="#colocacoes_indicator"
              data-bs-toggle="offcanvas"
              data-bs-target="#offcanvas_colocacoes"
              aria-controls="offcanvas_colocacoes">

            </a>
          </td>
        </tr>
      @endforeach
    </x-slot:tableBody>

  </x-infoCard.infoTable>

</x-formCard>
