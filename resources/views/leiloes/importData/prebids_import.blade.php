<x-layout>

<x-infoCard.title title="Licitações Antes do Leilão" />

  <div class="overflow-auto" style="max-height: 400px;" id="prebidslist">

    <x-infoCard.infoTable>
      <x-slot:tableHeader>
        <th class="p-xtra-small text-center">Leilão</th>
        <th class="p-xtra-small text-center">Lote</th>
        <th class="p-xtra-small text-end">Licitação</th>
        <th class="p-xtra-small text-end">Data & Hora</th>
        <th class="p-xtra-small text-end">Licitante ID</th>
      </x-slot:tableHeader>
      <x-slot:tableBody>
        @foreach($preBids as $bids)
        <tr>
          <td class="p-xtra-small text-center">{{$bids->leilao_id}}</td>
          <td class="p-xtra-small text-center">{{$bids->lot_index}}</td>
          <td class="p-xtra-small text-end">{{$bids->bid_price}} €</td>
          <td class="p-xtra-small text-end">{{$bids->bid_time}}</td>
          <td class="p-xtra-small text-end">{{$bids->bidder_id}}</td>
          <td></td>
        </tr>
        @endforeach
      </x-slot:tableBody>

    </x-infoCard.infoTable>

  </div>

</x-layout>