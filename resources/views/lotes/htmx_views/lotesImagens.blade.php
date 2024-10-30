{{-- VIEW DE IMAGENS DO LOTE --}}
<div class='col-12 d-flex justify-content-between align-items-center fw-bold border-bottom border-dark-subtle ps-2 pe-0 mb-4'>
  <div>Imagens</div>
  <div>
    <button class="btn btn-sm btn-secondary rounded rounded-bottom-0" type="button" id="openCameraButton"><i class="bi bi-camera-fill"></i></button>
  </div>
</div>

<div class="row mt-3 g-0">
  <div class="col-12">
    <form method="POST" id="imagem_form" action="/imagens/{{ $lote->id }}" enctype="multipart/form-data">
      {{-- hx-post="/imagens/{{ $lote->id }}"
      hx-target="#lote_imagens"
      hx-swap="innerHTML"
      hx-encoding="multipart/form-data" --}}
      @csrf
      @method('POST')
      <input type="file" id="cameraInput" accept="image/*" capture="environment" name="cameraInput">
      <button type="submit" id="submitImagemForm">Submit</button>
    </form>

  </div>
  <div class="col-12 m-0">
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
