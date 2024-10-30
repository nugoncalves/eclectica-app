<!-- OUTROS EXEMPLARES COLOCADOS EM LEILÃO -->

<x-formCard class="mt-3">

  <x-infoCard.title title="Outros Exemplares em Leilão" />

  <x-infoCard.infoTable>
    <x-slot:tableHeader>
      <th class="p-xtra-small text-center">Leilão</th>
      <th class="p-xtra-small text-center">Lote</th>
      <th class="p-xtra-small text-end">Base</th>
      <th class="p-xtra-small text-end">Martelo</th>
    </x-slot:tableHeader>
    <x-slot:tableBody>
      @foreach($outros as $item)
      <tr style="transform: rotate(0);" data-bs-toggle="tooltip" data-bs-title="{{$item->sold==1 ? 'Vendido | ' : 'Retirado' }}{{$item->buyer_id}}" data-bs-placement="left" class="{{$item->sold==1 ? 'table-success' : '' }}">
        <td class="p-xtra-small text-center">{{$item->leilao_id}}</td>
        <td class="p-xtra-small text-center">{{$item->leilao_lote}}</td>
        <td class="p-xtra-small text-end">{{$item->start_price}} €</td>
        <td class="p-xtra-small text-end">{{$item->price}} €</td>
        <td>
          <a href="javascript:void(0)" class="stretched-link text-secondary" data-bs-toggle="offcanvas" data-bs-target="#offcanvas_colocacoes" aria-controls="offcanvas_colocacoes" hx-get="/historico/{{ $item->id }}" hx-target="#htmx_colocacoes" hx-sync="this:replace" hx-swap="innerHTML">

          </a>
        </td>
      </tr>
      @endforeach
    </x-slot:tableBody>
  </x-infoCard.infoTable>
</x-formCard>