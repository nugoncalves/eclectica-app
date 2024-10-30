{{-- Lista de Licitações Pré-Leilão para Importar --}}
<div class="row justify-content-center">

  <div class="col-12 h3 mt-3 px-3">Dados de Importação</div>

  <!-- Main Form (Left Main Col) -->
  <div class="col-12 col-xl-8 mb-4">

    <x-formCard>

      <x-infoCard.title title="Licitações" />

      <div class="overflow-auto" style="max-height: 400px;" id="bidslist">

        <x-infoCard.infoTable>
          <x-slot:tableHeader>
            <th class="p-xtra-small text-center">Tipo</th>
            <th class="p-xtra-small text-center">Leilão</th>
            <th class="p-xtra-small text-center">Lote</th>
            <th class="p-xtra-small text-end">Licitação</th>
            <th class="p-xtra-small text-end">Data & Hora</th>
            <th class="p-xtra-small text-end">Licitante ID</th>
          </x-slot:tableHeader>
          <x-slot:tableBody>
            @foreach($bidsImport as $bids)
            <tr>
              <td class="p-xtra-small text-center">{{$bids->type}}</td>
              <td class="p-xtra-small text-center">{{$bids->leilao_id}}</td>
              <td class="p-xtra-small text-center">{{$bids->lot_index}}</td>
              <td class="p-xtra-small text-end">{{$bids->bid_price}} €</td>
              <td class="p-xtra-small text-end">{{$bids->bid_time}}</td>
              <td class="p-xtra-small text-end">{{$bids->bidder_id}} @if($bids->sold_bid)<i class="fa-solid fa-trophy"></i>@endif</td>
              <td></td>
            </tr>
            @endforeach
          </x-slot:tableBody>

        </x-infoCard.infoTable>
      </div>
    </x-formCard>

  </div>

  <!-- Other Info (Left Col) -->
  <div class="col-12 col-xl-4">


    <x-formCard class="mb-3">

      <x-infoCard.title title="Verificações" />
      <form 
        method="POST" action="/leiloes/import/confirm/{{ $leilao->id }}">
        @csrf
      <div class="row align-items-center mb-3 gap-3">

        <div class="form-check">
          <input class="form-check-input" type="checkbox" name="verificacoes[]" value="1">
          <label class="form-check-label" for="totalMartelo">
            Valor total obtido: <span class="fw-bold">{{ $totalMartelo }}</span>
          </label>
          <div class="p-xtra-small">
            Certifique-se que o total de Martelo corresponde na Plataforma BidSpirit.
          </div>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" name="verificacoes[]" value="1">
          <label class="form-check-label" for="numeroCompradores">
            Número de Compradores: <span class="fw-bold">{{ $numeroCompradores }}</span>
          </label>
          <div class="p-xtra-small">
          Certifique-se que o número total de compradores corresponde na Plataforma BidSpirit. Caso seja diferente, verifique se a lista de clientes está actualizada.
          </div>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" name="verificacoes[]" value="1">
          <label class="form-check-label" for="maxLotes">
            Maior Lote no ficheiro de importação: <span class="fw-bold">{{ $maxLoteIndex }}</span>
          </label>
          <div class="p-xtra-small">
          Certifique-se que o número máximo no index de lotes não é superior ao número de lotes existentes.
          </div>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" name="verificacoes[]" value="1">
          <label class="form-check-label" for="lotesVendidos">
            Lotes Vendidos: <span class="fw-bold">{{ $lotesVendidos }}</span>
          </label>
          <div class="p-xtra-small">
          Certifique-se que o número de lotes vendidos corresponde aos dados na plataforma BidSpirit.
          </div>
        </div>
        <div class="text-end">
          <button class="btn btn-sm btn-primary rounded-pill px-4" type="submit">Confirmar</button>
        </div>
      </div>
      </form>
    </x-formCard>
  </div>

</div>