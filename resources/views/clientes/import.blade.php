<x-layout baseRoute=clientesImport>
  <x-mainHeader baseRoute={{ $baseRoute }} query={{ $query }} title={{ $title }}>

  </x-mainHeader>

  <div class="container">
    <div class="row justify-content-center">

      <!-- IMPORT FILES CARD -->
      <div class="col-12 ">

        <form method="post" action="/clientes/import/confirm" enctype="multipart/form-data">
          @csrf
          <x-formCard class="mb-3">
            <x-infoCard.title title="Ficheiros de Importação" />
            <div class="row ">

              <div class="col-12 col-xl-6 ">
                <input type="file" class="form-control" name="clientes_import" aria-describedby="clientes_import_label" aria-label="Upload">
                <div class="form-text">
                  <span class="fw-bold">CLIENTES</span><br>O ficheiro deve iniciar por Users.
                </div>
                <div class="alert alert-warning" role="alert">
                  <i class="bi bi-exclamation-diamond-fill"></i> Não se esqueça de apagar a primeira linha branca do ficheiro EXCEL antes de importar.
                </div>
              </div>

              <div class="col-12 py-2 text-end ">
                <a href="javascript:history.back()" class="btn btn-sm btn-outline-secondary rounded-pill px-4">Cancelar</button>
                  <button type="submit" class="btn btn-sm btn-primary rounded-pill px-4">Importar</button>
              </div>

            </div>
          </x-formCard>
        </form>

      </div> {{-- END IMPORT FILES CARD --}}

      <!-- DADOS DE IMPORTAÇÃO -->
      <div class="col-12" id="ClientesImportContent"></div>

    </div>
  </div>

</x-layout>
