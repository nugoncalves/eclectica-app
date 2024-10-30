<!DOCTYPE html>
<html lang="pt">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecléctica App: Add Imagens</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('assets/logo/ELeiloes-simbolo-cor.png') }}">

    <!-- STYLES CSS -->

    <!-- BOOTSTRAP CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- BOOTSTRAP ICONS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

    <!-- BOOTSTRAP JAVASCRIPT -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

  </head>

  <body>

    {{-- Title Menu --}}
    <x-mainHeader baseRoute="" query="" title="{{ $title }}">
      <li class="nav-item">
        <a href="javascript:window. close();" type="submit" class="titleMenuButton btn btn-outline-secondary rounded-pill ms-2 px-4">Fechar</a>
      </li>
    </x-mainHeader>

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

  </body>

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

</html>
