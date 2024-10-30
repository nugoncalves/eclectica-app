<!-- LISTA DE CONTRATOS DE FORNECEDOR -->
<div class="list-group rounded shadow bg-white mb-4" id="lista_contratos">
  <div class="row align-items-center justify-content-between py-3 px-5">
    <div class="col-12 col-lg-4 fw-bold fs-5 text-dark-emphasis">
      <div>Lista de Contratos</div>
    </div>
  </div>
  <x-listGroupHeader>
    <div class="col col-lg-1">#</div>
    <div class="d-none d-lg-block col">Data</div>
    <div class="d-none d-lg-block col-4 text-end">Comissão</div>
  </x-listGroupHeader>
  <div class="overflow-auto rounded-bottom" style="max-height: 600px;">
    @foreach ($contratos as $c)

    <a href="" class="py-4 px-5 list-group-item list-group-item-action list-parent">
      <div class="row d-flex flex-column flex-lg-row align-items-center">
        <div class="col col-lg-1 text-secondary fw-bold p-xtra-small">
          {{ $c->id }}
        </div>
        <div class="col p-small">
          {{ $c->date }}
        </div>

        <div class="flex-row col col-lg-4 d-flex flex-lg-column text-start text-lg-end justify-content-between justify-content-lg-end">
          <div class="p-small d-lg-block text-end fw-bolder">
            <i class="fa-solid fa-gavel"></i> {{ $c->commission_type }}
          </div>
          <div class="p-small text-end">
            <i class="bi bi-tag"></i> {{ $c->commission_300 }}
          </div>
        </div>
      </div>
    </a>
    @endforeach
  </div>

</div>