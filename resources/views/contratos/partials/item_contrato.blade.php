<form id="contratoForm" method="POST" action="/contratos/updateItemContrato/{{ $contrato->id }}" target="_blank" enctype="multipart/form-data">
  @csrf
  @method('PUT')
  <x-formCard>
    <div class="row g-1">
      <x-input.input class="col-12 col-lg-2" type='number' field='contrato_index' fieldLabel='Índice' fieldValue="{{ $contratoIndex }}" />
      <x-input.input class="col-12 col-lg-10" type='text' field='main_lang_name' fieldLabel='Nome' fieldValue="{{ old('main_lang_desc') }}" />
    </div>
    <div class="row mt-3 g-0">
      <div class="col-1 text-end">
        <button class="btn btn-sm btn-secondary rounded-end-0 rounded-start mt-2 p-3" type="button" id="openCameraButton"><i class="bi bi-camera-fill"></i></button>
      </div>
      <div class="col-11 m-0">
        <div class="form-control d-flex justify-content-center">
          <canvas class="img-fluid mt-3" style="height: auto; width:50%;" id="canvas"></canvas>
        </div>
      </div>

    </div>

    <div class="row mt-3">
      <div class="col text-end">
        <button type="button" class="btn btn-sm btn-outline-primary rounded-pill mx-2 px-4" data-bs-dismiss="offcanvas" onclick="clearPreview()">Cancelar</button>
        <button type="submit" class="btn btn-sm btn-primary rounded-pill mx-2 px-4">Gravar</button>

      </div>

      <input type="file" class="form-control" id="cameraInput" name="cameraInput" accept="image/*" capture="environment" style="display: none;">
    </div>

  </x-formCard>
</form>

<!-- Script Responsável pela abertura da Câmara em Dispositivos Mobile  -->
<script>
  document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('cameraInput').value = '';
    document.getElementById('main_lang_name').value = '';
    const canvas = document.getElementById('canvas');
    const ctx = canvas.getContext('2d');
    ctx.clearRect(0, 0, canvas.width, canvas.height);
  });

  document.getElementById('openCameraButton').addEventListener('click', function() {
    document.getElementById('cameraInput').click();
  });

  document.getElementById('cameraInput').addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file) {
      const img = document.createElement('img');
      img.src = URL.createObjectURL(file);
      img.onload = function() {
        const canvas = document.getElementById('canvas');
        const ctx = canvas.getContext('2d');
        canvas.width = img.width;
        canvas.height = img.height;
        ctx.drawImage(img, 0, 0, img.width, img.height);

        const base64Image = canvas.toDataURL('image/jpeg');
        document.getElementById('cameraInput').value = base64Image;
      };
    }
  });

  function clearPreview() {
    document.getElementById('cameraInput').value = '';
    document.getElementById('main_lang_name').value = '';
    const canvas = document.getElementById('canvas');
    const ctx = canvas.getContext('2d');
    ctx.clearRect(0, 0, canvas.width, canvas.height);
  }
</script>