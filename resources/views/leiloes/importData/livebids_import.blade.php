{{-- Lista de Licitações Durante o Leilão --}}
<div id="livebidsimport">

  @if(!$liveBidsStatus)
  <form hx-post="/leiloes/import/livebids/{{ $leilao->id }}" hx-encoding="multipart/form-data" hx-target="#livebidsimport" hx-swap="outerHTML">
    @csrf
    <div class="input-group my-4">
      <input type="file" class="form-control" name="live_bids_import" aria-describedby="live_bids_import_label" aria-label="Upload">
      <button class="btn btn-outline-primary" type="submit" id="live_bids_import_label">Upload</button>
    </div>
  </form>
  @endif

  <x-infoCard.title title="Licitações Durante o Leilão" />

  <div class="overflow-auto" style="max-height: 400px;">

    <x-infoCard.infoTable>

      <x-slot:tableHeader>
        <th class="p-xtra-small text-center">Leilão</th>
        <th class="p-xtra-small text-center">Lote</th>
        <th class="p-xtra-small text-end">Licitação</th>
        <th class="p-xtra-small text-end">Data & Hora</th>
        <th class="p-xtra-small text-end">Origem</th>
        <th class="p-xtra-small text-end">Licitante ID</th>
      </x-slot:tableHeader>
      <x-slot:tableBody>
        @foreach($liveBids as $bids)
        <tr>
          <td class="p-xtra-small text-center">{{$bids->leilao_id}}</td>
          <td class="p-xtra-small text-center">{{$bids->lot_index}}</td>
          <td class="p-xtra-small text-end">{{$bids->bid_price}} €</td>
          <td class="p-xtra-small text-end">{{$bids->bid_time}}</td>
          <td class="p-xtra-small text-end">{{$bids->bid_type}}</td>
          <td class="p-xtra-small text-end">{{$bids->bidder_id}} @if($bids->sold_bid)<i class="fa-solid fa-trophy"></i>@endif</td>
          <td></td>
        </tr>
        @endforeach
      </x-slot:tableBody>

    </x-infoCard.infoTable>
  </div>
  <div>
    @if(!$liveBidsStatus)
    <form class="hstack gap-3 mt-3">
      @csrf
      <button type="button" class="ms-auto btn btn-sm btn-outline-primary rounded-pill px-4" hx-delete="/leiloes/import/livebids/cancel/{{ $leilao->id }}" hx-target="#livebidsimport" hx-swap="outerHTML">Cancelar Importação</button>
      <button type="submit" class="btn btn-sm btn-primary rounded-pill px-4" hx-post="/leiloes/import/livebids/confirm/{{ $leilao->id }}" hx-target="#livebidsimport" hx-swap="outerHTML">Importar</button>
    </form>
    @endif
  </div>
</div>
