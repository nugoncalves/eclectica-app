<!-- Conteúdo com informações Gerais do Cliente para visualização em outros Módulos -->
<x-formCard class="mt-3">

    <div class="row">
        <div class="col-12 text-center text-secondary" style="font-size: 5rem;">
            <i class="bi bi-person-circle"></i>
            <h4 class="text-secondary fw-bold">
                {{ $cliente->full_name }} <a href="/clientes/{{ $cliente->id }}" class="text-secondary ms-2"><i
                        class="bi bi-pencil-square"></i></a>
            </h4>
            <p class="p-xtra-small">{{ $cliente->address }}, {{ $cliente->zip }} {{ $cliente->city }}
                {{ $cliente->state ? ', ' . $cliente->state : '' }}, {{ $cliente->country }}</p>
        </div>
        <div class="px-5 ">
            <div class="row my-3">
                <div class="col-12 col-lg-6 "><i class="bi bi-phone me-2"></i> Telefone</div>
                <div class="col-12 col-lg-6 text-primary text-start text-lg-end">{{ $cliente->phone }}</div>
            </div>
            <div class="row my-3">
                <div class="col-12 col-lg-6"><i class="bi bi-envelope-at me-2"></i> E-Mail</div>
                <div class="col-12 col-lg-6 text-primary text-start text-lg-end"><a href="mailto:{{ $cliente->email }}"
                        target="_blank">{{ $cliente->email }}</a></div>
            </div>
        </div>
        <div class="row px-5 justify-content-center text-center">
            <a href="/clientes/{{ $cliente->id }}/shippingLabel" target="_blank"
                class="col col-lg-5 px-3 btn btn-sm btn-primary rounded rounded-pill">Etiqueta Envio</a>
        </div>
    </div>

</x-formCard>
