<x-layout>

  <div class="container mt-3">

    <div class="row justify-content-center">
      <!-- Main Form (Left Main Col) -->
      <div class="col-12 col-xl-8 mb-4">

        <x-formCard class="mb-3">

          {{-- TAB NAV BAR --}}
          <nav>
            <div class="nav nav-tabs nav-fill mb-3" id="nav-tab" role="tablist">
              <button @class(['nav-link', 'text-success'=> $leilao->pre_bids_import, 'active'])
                id="nav-pre-bids-tab"
                data-bs-toggle="tab"
                data-bs-target="#nav-pre-bids"
                type="button"
                role="tab"
                aria-controls="nav-pre-bids"
                aria-selected="true">
                <i @class(['fa-solid', 'fa-circle-check' , 'text-success'=> $leilao->pre_bids_import])></i>
                Licitações Ausentes
              </button>
              <button @class(['nav-link', 'text-success'=> $leilao->live_bids_import,])
                id="nav-live-bids-tab"
                data-bs-toggle="tab"
                data-bs-target="#nav-live-bids"
                type="button"
                role="tab"
                aria-controls="nav-live-bids"
                aria-selected="false">
                <i @class(['fa-solid', 'fa-circle-check' , 'text-success'=> $leilao->live_bids_import])></i>
                Licitações Live
              </button>
              <button @class(['nav-link', 'text-success'=> $leilao->resultados_import,])
                id="nav-resultados-tab"
                data-bs-toggle="tab"
                data-bs-target="#nav-resultados"
                type="button"
                role="tab"
                aria-controls="nav-resultados"
                aria-selected="false">
                <i @class(['fa-solid', 'fa-circle-check' , 'text-success'=> $leilao->resultados_import])></i>
                Resultados
              </button>
            </div>
          </nav> {{-- TAB NAV BAR END --}}

          {{-- TAB CONTENT --}}
          <div class="tab-content" id="nav-tabContent">

            {{-- PRE BIDS --}}
            <div class="tab-pane fade show active" id="nav-pre-bids" role="tabpanel" aria-labelledby="nav-pre-bids-tab" tabindex="0">
              <form hx-post="/leiloes/import/prebids/{{ $leilao->id }}" hx-encoding="multipart/form-data" hx-target="#prebidsimport" hx-swap="outerHTML">
                @csrf
                <div class="input-group my-4">
                  <input type="file" class="form-control" name="pre_bids_import" aria-describedby="pre_bids_import_label" aria-label="Upload" {{ ($leilao->pre_bids_import) ? 'disabled' : '' }}>
                  <button class="btn btn-outline-primary" type="submit" id="pre_bids_import_label" {{ ($leilao->pre_bids_import) ? 'disabled' : '' }}>Upload</button>
                </div>
              </form>

              @include('leiloes.importData.prebids_import')
            </div> {{-- END PRE-BIDS --}}

            {{-- LIVE BIDS --}}
            <div class="tab-pane fade" id="nav-live-bids" role="tabpanel" aria-labelledby="nav-live-bids-tab" tabindex="0">
              {{-- <div class="tab-pane fade show active" id="nav-live-bids" role="tabpanel" aria-labelledby="nav-live-bids-tab" tabindex="0">
                <form hx-post="/leiloes/import/livebids/{{ $leilao->id }}" hx-encoding="multipart/form-data" hx-target="#livebidsimport" hx-swap="innerHTML">
              @csrf
              <div class="input-group my-4">
                <input type="file" class="form-control" name="live_bids_import" aria-describedby="live_bids_import_label" aria-label="Upload" {{ ($leilao->live_bids_import) ? 'disabled' : '' }}>
                <button class="btn btn-outline-primary" type="submit" id="live_bids_import_label" {{ ($leilao->live_bids_import) ? 'disabled' : '' }}>Upload</button>
              </div>
              </form>

              <x-infoCard.title title="Licitações Live" />

              <div id="livebidsimport">

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
                    @foreach($liveBids as $lb)
                    <tr>
                      <td class="p-xtra-small text-center">{{ $lb->leilao_id }}</td>
                      <td class="p-xtra-small text-center">{{ $lb->lot_index }}</td>
                      <td class="p-xtra-small text-end">{{ $lb->bid_price }} €</td>
                      <td class="p-xtra-small text-end">{{ $lb->bid_time }}</td>
                      <td class="p-xtra-small text-end">{{ $lb->bid_type }}</td>
                      <td class="p-xtra-small text-end">{{ $lb->bidder_id }}</td>
                      <td></td>
                    </tr>
                    @endforeach
                  </x-slot:tableBody>

                </x-infoCard.infoTable>

              </div>

            </div> --}}
          </div> {{-- END LIVE BIDS --}}

          {{-- RESULTADOS --}}
          <div class="tab-pane fade" id="nav-resultados" role="tabpanel" aria-labelledby="nav-resultados-tab" tabindex="0">
            {{-- <div class="tab-pane fade show active" id="nav-resultados" role="tabpanel" aria-labelledby="nav-resultados-tab" tabindex="0">
                <form hx-post="/leiloes/import/resultados/{{ $leilao->id }}" hx-encoding="multipart/form-data" hx-target="#resultadosimport" hx-swap="innerHTML">
            @csrf
            <div class="input-group my-4">
              <input type="file" class="form-control" name="resultados_import" aria-describedby="resultados_import_label" aria-label="Upload" {{ ($leilao->resultados_import) ? 'disabled' : '' }}>
              <button class="btn btn-outline-primary" type="submit" id="resultados_import_label" {{ ($leilao->resultados_import) ? 'disabled' : '' }}>Upload</button>
            </div>
            </form>

            <x-infoCard.title title="Resultados" />

            <div id="resultadosimport">
              <div class="overflow-auto" style="max-height: 400px;">
                <x-infoCard.infoTable>

                  <x-slot:tableHeader>
                    <th class="p-xtra-small text-center">Leilão</th>
                    <th class="p-xtra-small text-center">Lote</th>
                    <th class="p-xtra-small text-end">Martelo</th>
                    <th class="p-xtra-small text-end">Comprador ID</th>
                  </x-slot:tableHeader>
                  <x-slot:tableBody>
                    @foreach($resultados as $resultado)
                    <tr>
                      <td class="p-xtra-small text-center">{{$resultado->leilao_id}}</td>
                      <td class="p-xtra-small text-center">{{$resultado->lot_index}}</td>
                      <td class="p-xtra-small text-end">{{$resultado->bid_price}} €</td>
                      <td class="p-xtra-small text-end">{{$resultado->bid_time}}</td>
                      <td class="p-xtra-small text-end">{{$resultado->bid_type}}</td>
                      <td class="p-xtra-small text-end">{{$resultado->bidder_id}}</td>
                      <td></td>
                    </tr>
                    @endforeach
                  </x-slot:tableBody>

                </x-infoCard.infoTable>
              </div>
            </div>

          </div> --}}
      </div> {{-- END RESULTADOS --}}

    </div>
    </x-formCard> {{-- END MAIN CARD --}}

  </div>

  <!-- Other Info (Left Col) -->
  <div class="col-12 col-xl-4">

    <x-formCard>
      <x-infoCard.title title="Informações Gerais" />

      <x-infoCard.infoData name="Leilão" :value='$leilao->id' />
      <x-infoCard.infoData name="Data do Leilão" :value='$leilao->data_fim' />
      <x-infoCard.infoData name="Título" :value='$leilao->name' />
      <x-infoCard.infoData name="Estado" :value='$leilao->estado' />
    </x-formCard>

  </div>



