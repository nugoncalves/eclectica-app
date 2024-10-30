        <div class="list-group listOnForm col">
          <div class="list-group-item d-flex flex-row align-items-center px-5 py-3">
            <div class="col-12 col-lg-3 fw-bold fs-5 text-dark-emphasis">Lista de Lotes</div>
            <form class='col-12 col-lg-6'>
              <div class="input-group input-group-sm">
                <input type="search" class="form-control form-control-sm rounded-pill px-3" name="search" placeholder="Procurar texto..." value="{{ $_GET['search'] ?? "" }}">
                <button class="btn btn-outline-secondary rounded-circle ms-2 btn-sm" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
              </div>
            </form>

          </div>
          <x-listGroupHeader>
            <div class="col col-lg-1">Lote</div>
            <div class="d-none d-lg-block col">Descrição</div>
            <div class="d-none d-lg-block col-2 text-end">Valor</div>
          </x-listGroupHeader>
          <div class="overflow-auto mb-4" style="max-height: 600px;">

            @if($totais['lotes']==0)
            <div class="list-group-item list-parent px-5 py-4">
              Não existem lotes atribuídos a este leilão.
            </div>
            @endif
            @foreach ($itemsLeilao as $item)
            <a href="" class="list-group-item list-group-item-action list-parent px-5 py-4" data-bs-toggle="offcanvas" data-bs-target="#offcanvas_lotes" aria-controls="offcanvas_lotes" hx-get="/historico/{{$item->id}}" hx-target="#htmx_lotes" hx-sync="this:replace" hx-swap="innerHTML">

              <div class="row d-flex flex-column flex-lg-row align-items-center">
                <div class="col col-lg-1 text-secondary fw-bold p-xtra-small">
                  {{$item->leilao_lote}}
                </div>
                <div class="col p-small">
                  {{$item->main_lang_name}}
                </div>

                <div class="col col-lg-2 d-flex flex-row flex-lg-column text-start text-lg-end justify-content-between justify-content-lg-end">
                  <div class="p-small d-lg-block text-end fw-bolder">
                    <i class="fa-solid fa-gavel"></i> {{$item->price}} €
                  </div>
                  <div class="p-small text-end">
                    <i class="bi bi-tag"></i> {{$item->start_price}} €
                  </div>
                </div>
              </div>
            </a>
            @endforeach

          </div>

        </div>