<x-listGroup>

    <x-listGroupHeader>
        <div class="d-none d-lg-block col-1">#</div>
        <div class="d-none d-lg-block col-7">Nome Completo</div>
        <div class="d-none d-lg-block col-4">Contactos</div>
        <div class="d-lg-none d-block col-12">Cliente</div>
    </x-listGroupHeader>
    <div class="overflow-auto rounded-bottom align-items-center">
        @if ($clientes->count() > 0)
        @foreach ($clientes as $c)

        <a href="javascript:void(0)" class="list-group-item list-group-item-action list-parent px-5 py-4 d-flex flex-column flex-lg-row" hx-get="/clientes/modal/{{ $c->id }}" hx-target="#clienteContent" hx-sync="this:replace" hx-swap="innerHTML" hx-indicator="#fornecedores_indicator" data-bs-toggle="modal" data-bs-target="#cliente_form">
            <div class="col col-lg-1 text-secondary fw-bold d-flex flex-column flex-sm-row">
                {{ $c->id }}
            </div>
            <div class="col-12 col-lg d-flex flex-column flex-sm-row flex-lg-column text-start justify-content-between">
                <div>
                    {{ $c->full_name }}
                </div>
                <div class="p-small text-secondary">
                    {{ $c->city }}
                </div>
            </div>

            <div class="col col-lg-4 d-flex flex-column flex-sm-row flex-lg-column text-start text-lg-end justify-content-between justify-content-lg-end">
                <div class="p-small text-dark fw-bolder">
                    <i class="fa-regular fa-envelope"></i> {{ $c->email }}
                </div>

                <div class="p-small">
                    <i class="fa-solid fa-mobile-screen-button"></i> {{ $c->phone }}
                </div>
            </div>
        </a>
        @endforeach
        @else
        <div class="p-4 list-group-item list-group-item-action px-5 py-4 d-flex justify-content-between align-items-center list-parent">
            Não foram encontrados clientes com "{{ $_GET['search'] ?? '' }}."
        </div>
        @endif
    </div>

</x-listGroup>
