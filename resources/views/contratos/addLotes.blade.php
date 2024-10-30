<x-layout baseRoute="{{ $baseRoute }}">

    @php

        $contratoIndex = '';
        $contratoIndex = '';

        if ($contrato != null) {
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

    <x-flashMessage />

    <x-mainHeader baseRoute="{{ $baseRoute }}" query="{{ $query }}" title="{{ $title }}">
        <li class="nav-item">
            <a href="/contratos/{{ $contrato->id }}" type="submit"
                class="titleMenuButton btn btn-primary rounded-pill ms-2 px-4">Terminar</a>
        </li>
    </x-mainHeader>

    {{-- Main Content --}}
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-12 col-xl-8 mb-4">

                <form id="contratoForm" method="POST" action="/contratos/createItemContrato/{{ $contrato->id }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <x-formCard>
                        <div class="row g-1">
                            <x-input.input class="col-12 col-lg-2" type='number' field='contrato_index'
                                fieldLabel='Índice' fieldValue="{{ $contratoIndex }}" />
                            <x-input.input class="col-12 col-lg-10" type='text' field='main_lang_name'
                                fieldLabel='Nome' fieldValue="{{ old('main_lang_desc') }}" />
                        </div>
                        <div class="row mt-3 g-0">
                            <div class="col-1 text-end">
                                <button class="btn btn-sm btn-secondary rounded-end-0 rounded-start mt-2 p-3"
                                    type="button" id="openCameraButton"><i class="bi bi-camera-fill"></i></button>
                            </div>
                            <div class="col-11 m-0">
                                <div class="form-control d-flex justify-content-center">
                                    <canvas class="img-fluid mt-3" style="height: auto; width:50%;"
                                        id="canvas"></canvas>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col text-end">
                                <a href="/contratos/{{ $contrato->id }}" type="submit"
                                    class="btn btn-sm btn-outline-primary rounded-pill mx-2 px-4">Cancelar</a>
                                <button type="submit"
                                    class="btn btn-sm btn-primary rounded-pill mx-2 px-4">Gravar</button>

                            </div>
                            <input type="file" id="cameraInput" name="cameraInput" accept="image/*"
                                style="display: none;">

                        </div>

                    </x-formCard>
                </form>

                <x-listGroup>
                    @include('contratos.items_contrato_em_contrato')
                </x-listGroup>
            </div>

            <!-- Other Info (Left Col) -->
            <div class="col-12 col-xl-4">
                {{-- Info Contrato --}}
                <x-formCard class="mb-4">

                    <x-infoCard.title title="INFO Contrato" />
                    <x-infoCard.infoData name="Contrato" :value="$contrato->id" />
                    <x-infoCard.infoData name="Data" :value="$contrato->date" />
                    <x-infoCard.infoData name="Fornecedor"
                        value="{{ $contrato->seller_id }} | {{ $contrato->seller_reference }}" />
                    <x-infoCard.infoData name="Nome" :value="ucwords($cliente->full_name)" />
                    <x-infoCard.infoData name="Email" :value="$cliente->email" />
                    <x-infoCard.infoData name="Telefone" :value="$cliente->phone" />
                    <div class='d-flex justify-content-between align-items-center pt-2 px-2'>
                        <span class="d-block small text-secondary">Comissão</span>
                        <span
                            class="d-block small text-end">{{ $contrato->commission_1000 ? 'Progressiva' : $contrato->commission_300 }}</span>
                    </div>
                    @if ($contrato->commission_1000)
                        <div class='d-flex justify-content-between align-items-center px-2'>
                            <span class="d-block small text-end">{{ $contrato->commission_300 }}</span>
                            <span class="d-block small text-end">{{ $contrato->commission_1000 }}</span>
                            <span class="d-block small text-end">{{ $contrato->commission_3000 }}</span>
                            <span class="d-block small text-end">{{ $contrato->commission_more_3000 }}</span>
                        </div>
                        <div class='d-flex justify-content-between align-items-center border-bottom px-2'>
                            <span class="d-block p-xtra-small text-secondary">Até 300€</span>
                            <span class="d-block p-xtra-small text-secondary">de 301 a 1.000€</span>
                            <span class="d-block p-xtra-small text-secondary">de 1.001 a 3.000€</span>
                            <span class="d-block p-xtra-small text-secondary">mais de3000€</span>
                        </div>
                    @endif
                </x-formCard>
                <x-formCard class="mb-4">
                    <x-infoCard.title title="QrCode" />
                    {!! $qrcode !!}

                </x-formCard>
            </div>


        </div>
    </div>


</x-layout>

{{-- Script Responsável pela abertura da Câmera em Dispositiviso Mobile --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('cameraInput').value = '';
        document.getElementById('main_lang_name').value = '';
        const canvas = document.getElementById('canvas');
        const ctx = canvas.getContext('2d');
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        canvasContainer.innerHTML = '';
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
