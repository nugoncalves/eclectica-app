<!-- Upload de Anexos -->
<x-modal class="modal-lg modal-dialog-scrollable" title="Atribuir Anexos" id="anexos_list">

  <x-formCard>
    <div class="row d-flex justify-content-between">
      <div class="col-12 col-lg-12">
        <form action="/uploadAnexo/{{ $pagamento->id }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="input-group">
            <input type="file" class="form-control" id="fileInput" name="fileInput"
              aria-describedby="fileInputLabel" aria-label="Upload">
            <button class="btn btn-primary" type="submit" id="fileInputLabel">Guardar</button>
          </div>

          <div id="message" class="mt-2"></div>

        </form>
      </div>
    </div>

  </x-formCard>
</x-modal>

<style>
  .drop-zone {
    border: 2px dashed #007bff;
    padding: 20px;
    height: 300px;
    align-content: center;
    cursor: pointer;
  }

  .drop-zone p {
    text-align: center;
  }

  .drop-zone.dragover {
    background-color: #e9ecef;
  }
</style>
