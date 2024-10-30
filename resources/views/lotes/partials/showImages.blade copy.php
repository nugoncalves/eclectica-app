<x-layout>
  {{-- Title Menu --}}
  <x-mainHeader baseRoute="" query="" title="{{ $title }}" />
  <x-flashMessage />

  <div class="container mt-3">

    <div class="row justify-content-center">
      <div class="col col-xl-8 mb-4">
        <!-- Campos de Informação do Lote -->
        <x-formCard>
          <x-input.input class="col-6 col-lg" type='number' field='contrato_id' fieldLabel='Contrato' :fieldValue="$lote->contrato_id" disabled=1 />
          <x-input.input class="col-6 col-lg" type='number' field='contrato_index' fieldLabel='Inventário' :fieldValue="$lote->contrato_index" disabled=1 />
          <div class='col-12 form-floating mt-3'>
            <textarea class="form-control" id="main_lang_name" name="main_lang_name" placeholder="Título" style="height: 100px" disabled>{{ $lote->main_lang_name }}</textarea>
            <label for="main_lang_name" class="form-label col-form-label-sm text-info-emphasis ms-2">Nome</label>
          </div>
        </x-formCard>

        <x-formCard class="mt-3">
          <div class='col-12 d-flex justify-content-between align-items-center fw-bold border-bottom border-dark-subtle ps-2 pe-0 mb-4'>
            <div>Imagens</div>
            <div>
              <button class="btn btn-sm btn-secondary rounded rounded-bottom-0" type="button" id="openCameraButton"><i class="bi bi-camera-fill"></i></button>
            </div>
          </div>

          <!-- Campos do Formulário para Adicionar Imagens -->
          <div class="row mt-3 g-0">
            <form method="POST" action="/lotes/imagens/{{ $lote->id }}" id="main_form_imagens" enctype="multipart/form-data">
              @csrf
              <input type="hidden" class="form-control" id="id" name="id" placeholder="" value="{{ $lote->id }}">
              <input type="file" id="cameraInput" accept="image/*" capture="environment" name="cameraInput" style="display:none">
            </form>

            <div class="col-11 m-0">
              @foreach ($imagens as $img)
                <div class="position-relative d-inline-block text-center mx-2">
                  @php
                    $imageName = basename($img->path); // Extrai apenas o nome do arquivo
                  @endphp
                  <img src="{{ asset($img->path) }}" alt="{{ $lote->id }}" class="img-fluid img-thumbnail m-1" style="max-height: 150px;" />
                  <p class="small text-muted">{{ $imageName }}</p>
                  <button type="button" class="btn btn-sm btn-danger position-absolute top-0 start-100 rounded-circle translate-middle"
                    data-bs-toggle="modal" data-bs-target="#confirm-image-deletion-modal"
                    data-image-id="{{ $img->id }}" data-image-name="{{ $imageName }}">
                    <i class="bi bi-x-lg"></i>
                  </button>
                </div>
              @endforeach
            </div>
          </div>
        </x-formCard>

</x-layout>

<!-- Modal de Confirmação -->
<x-modal title="Eliminar Imagem" id="confirm-image-deletion-modal" ariaLabel="confirm-image-deletionLabel" focusable>
  <form method="POST" action="" class="p-6" id="delete-image-form">
    @csrf
    @method('delete')
    {{-- <h5 class="modal-title" id="confirm-image-deletionLabel">
            {{ __('Tem a certeza que deseja excluir permanentemente esta imagem?') }}
        </h5> --}}
    <p class="mt-1 text-sm" id="delete-image-message">
      {{ __('Tem a certeza que deseja excluir permanentemente esta imagem?') }}
    </p>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
        aria-label="Close">Cancelar</button>
      <button type="submit" class="btn btn-danger ms-3">
        {{ __('Eliminar') }}
      </button>
    </div>
  </form>
</x-modal>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('cameraInput').value = '';
  });

  document.getElementById('confirm-image-deletion-modal').addEventListener('show.bs.modal', function(event) {
    var button = event.relatedTarget; // Botão que acionou o modal
    var imageId = button.getAttribute('data-image-id');
    var imageName = button.getAttribute('data-image-name');

    // Obtém o modal e seus elementos
    var modal = document.getElementById('confirm-image-deletion-modal');
    var form = modal.querySelector('#delete-image-form');
    var message = modal.querySelector('#delete-image-message');

    // Atualiza a ação do formulário com o ID correto
    form.action = '/imagens/' + imageId;

    // Atualiza a mensagem no modal
    message.textContent = 'Tem a certeza que deseja excluir permanentemente a imagem ' + imageName + '?';
  });

  document.getElementById('openCameraButton').addEventListener('click', function() {
    document.getElementById('cameraInput').click();
  });

  document.getElementById('cameraInput').addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file) {
      // Submeter o formulário automaticamente quando o arquivo for selecionado
      document.getElementById('main_form_imagens').submit();
      console.log('Formulário enviado automaticamente com a imagem.');
    }
  });
</script>
