<!-- LISTA DE LEILÕES COM LOTES DE FORNECEDOR -->


<div class="list-group rounded shadow bg-white mb-4" id="lista_contratos">
  <div class="row align-items-center justify-content-between py-3 px-5">
    <div class="col-12 col-lg-4 fw-bold fs-5 text-dark-emphasis">
      <div>Lista de Leilões</div>
    </div>
  </div>
  <x-listGroupHeader>
    <div class="col col-lg-1">#</div>
    <div class="d-none d-lg-block col col-lg-2">Data</div>
    <div class="d-none d-lg-block col">Título</div>
  </x-listGroupHeader>
  <div class="overflow-auto rounded-bottom" style="max-height: 600px;">
    @foreach ($leiloes as $l)
    <a href="" class="py-4 px-5 list-group-item list-group-item-action list-parent">
      <div class="row d-flex flex-column flex-lg-row align-items-center">
        <div class="col col-lg-1 text-secondary fw-bold p-xtra-small">
          {{ $l->id }}
        </div>
        <div class="col col-lg-2 p-small">
          {{ $l->end_date }}
        </div>
        <div class="col">
          {{ $l->name }}
        </div>
      </div>
    </a>
    @endforeach
  </div>

</div>