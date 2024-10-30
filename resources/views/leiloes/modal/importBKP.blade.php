<!-- Modal para importar resultados de Leilão -->
<div class="modal fade" id="leilaoImport" tabindex="-1" aria-labelledby="leilaoImport" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content" style="background-color: var(--body-bg-color);">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Resultados do Leilão {{ $leilao->id }}</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="container">

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
              </div>
            </nav> {{-- TAB NAV BAR END --}}

            {{-- TAB CONTENT --}}
            <div class="tab-content" id="nav-tabContent">

              {{-- PRE BIDS --}}
              <div class="tab-pane fade show active" id="nav-pre-bids" role="tabpanel" aria-labelledby="nav-pre-bids-tab" tabindex="0">
                @include('leiloes.importData.prebids_import')
              </div> {{-- END PRE-BIDS --}}

              {{-- LIVE BIDS --}}
              <div class="tab-pane fade" id="nav-live-bids" role="tabpanel" aria-labelledby="nav-live-bids-tab" tabindex="0">
                @include('leiloes.importData.livebids_import')
              </div> {{-- END LIVE BIDS --}}

          </x-formCard> {{-- END MAIN CARD --}}

        </div>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
