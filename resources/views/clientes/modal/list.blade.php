<x-modal class="modal-xl modal-dialog-scrollable" title="Atribuir Cliente" id="cliente_list">
    <x-formCard>
        <div class="row d-flex justify-content-between">

            <div class="col-12 col-lg-7">
                <form class="col" hx-get="/clientes/modal" hx-target="#cliente" hx-sync="this:replace" hx-swap="innerHTML" hx-indicator="#fornecedores_indicator">
                    <div class="input-group input-group-sm">
                        <input type="search" class="form-control form-control-sm rounded-pill px-3" name="search" placeholder="Procurar" value="<?= $_GET['search'] ?? '' ?>">
                        <button class="btn btn-outline-secondary rounded-circle ms-2 btn-sm" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </form>
            </div>

            <div class="col mt-3 mt-lg-0 ms-3 text-center text-lg-end">
                <button class="btn btn-sm btn-outline-primary rounded-pill px-4 mx-2" data-bs-target="#cliente_form" data-bs-toggle="modal" hx-get="/clientes/modal/create" hx-target="#clienteContent" hx-sync="this:replace" hx-swap="innerHTML" hx-indicator="#fornecedores_indicator">
                    Novo
                </button>
            </div>
        </div>
    </x-formCard>
    <!-- HTMX INDICATOR -->
    <div class="d-flex justify-content-center my-3 htmx-indicator" id="fornecedores_indicator"><img src="{{asset('assets/svg-loaders/stampede.gif')}}" height="20px"></div>

    <!-- LISTA DE RESULTADOS -->
    <div id="cliente"></div>
</x-modal>

<x-modal class="modal-xl modal-dialog-scrollable" title="Atribuir Cliente" id="cliente_form">
    <x-formCard>
        <div id="clienteContent">
            <!-- HTMX INDICATOR -->
            <div class="d-flex justify-content-center my-3 htmx-indicator" id="fornecedores_indicator"><img src="{{asset('assets/svg-loaders/stampede.gif')}}" height="20px"></div>
        </div>
    </x-formCard>
</x-modal>
