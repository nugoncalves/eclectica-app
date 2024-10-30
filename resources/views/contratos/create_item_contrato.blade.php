@props(['cliente' => '', 'contratos' => ''])

@php

    $contratoIndex = '';

    if ($contratos == null) {
        $latestItemContrato = \App\Models\ItemsContrato::where('contrato_id', $contrato->id)
            ->orderByDesc('id')
            ->first();
        if ($latestItemContrato != null) {
            $contratoIndex = $latestItemContrato->contrato_index ?? 0;
            $contratoIndex += 1;
        } else {
            $contratoIndex = 1;
        }
    } else {
        $contratoIndex = old('contrato_index');
    }

@endphp

<x-offcanvas title='Novo Lote' name="addItemContrato" class="offcanvas-size-xxl">
    <form method="POST" action="/contratos/createItemContrato" enctype="multipart/form-data">
        @csrf
        <div class="row justify-content-center">
            <x-formCard>
                <div class="mt-3 col-6 col-lg form-floating">
                    @if ($contratos && count($contratos) > 0)
                        <input type="text" class="form-control" id="contrato_id" name="contrato_id"
                            list="listContratos" value="{{ old('contrato_id') }}" hx-get="/contratos/seller/{value}"
                            hx-trigger="change" hx-target="#seller_number, #seller_reference" />
                        <label for="contrato_id"
                            class="form-label col-form-label-sm text-info-emphasis ms-2">Contrato</label>
                        <datalist id="listContratos" class="border border-danger">
                            @foreach ($contratos as $contrato)
                                <option value="{{ $contrato->id }}">
                            @endforeach
                        </datalist>
                    @else
                        <input type="text" class="form-control" id="contrato_id" name="contrato_id"
                            value="{{ $contrato->id }}" readonly />
                        <label for="contrato_id"
                            class="form-label col-form-label-sm text-info-emphasis ms-2">Contrato</label>
                    @endif
                </div>
                <x-input.input class="col-6 col-lg" type='number' field='contrato_index' fieldLabel='Inventário'
                    fieldValue="{{ $contratoIndex }}" />
                <x-input.input class="col-6 col-lg" type='text' field='seller_id' fieldLabel='Fornecedor ID'
                    fieldValue="{{ old('seller_id', $contratos == null ? $contrato->seller_id : '') }}" readonly="true"
                    id="seller_number" />
                <x-input.input class="col-6 col-lg" type='text' field='seller_reference' fieldLabel='Fornecedor'
                    fieldValue="{{ old('seller_reference', $contratos == null ? $contrato->seller_reference : '') }}"
                    readonly="true" id="seller_reference" />
                <x-input.textArea field='main_lang_name' fieldLabel='Nome' :fieldValue="old('main_lang_name')" />
            </x-formCard>
        </div>
        <div class="offcanvas-footer mt-3">
            <button type="button" class="btn btn-sm btn-outline-primary rounded-pill mx-2 px-4"
                data-bs-dismiss="offcanvas" onclick="clearPreview()">Cancelar</button>
            <button type="submit" class="btn btn-sm btn-primary rounded-pill mx-2 px-4">Gravar</button>
            <button class="btn btn-sm btn-secondary rounded-pill mx-2 px-4" type="button"
                id="openCameraButton">Fotografia</button>
            <input type="file" class="form-control" id="cameraInput" name="cameraInput" accept="image/*"
                capture="environment" style="display: none;">
            <div class="mt-3">
                <canvas class="img-fluid" style="width: 50%" id="canvas"></canvas>
            </div>
        </div>

    </form>
</x-offcanvas>

{{-- Script Responsável pela abertura da Câmera em Dispositiviso Mobile --}}
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
