<div class="list-group rounded shadow bg-white" id="items_de_contrato">

    <div class="row align-items-center justify-content-between py-3 px-5">
        <div class="col-12 col-lg-4 fw-bold fs-5 text-dark-emphasis">
            <div>Lista de Contratos</div>
            <div class="p-xtra-small p-0 m-0">[Contratos: {{ $totais['items_contrato'] }}]</div>
        </div>

        <form class='col-12 col-lg-7 mt-3 mt-lg-0' hx-target='#items_de_contrato'
            hx-get='/contratos/filter_items/{{ $contrato->id }}' hx-swap='outerHTML'>
            <div class="input-group input-group-sm align-items-center">
                <input type="search" class="px-3 form-control form-control-sm rounded-pill" name="search"
                    placeholder="Procurar texto..." value="{{ $_GET['search'] ?? '' }}">
                <button class="btn btn-outline-secondary rounded-circle mx-2 btn-sm" type="submit"><i
                        class="fa-solid fa-magnifying-glass"></i></button>
                @if ($_GET['search'] ?? false)
                    <button class="btn btn-outline-danger rounded-pill mx-2 btn-sm" type="submit"
                        hx-target='#items_de_contrato' hx-get='/contratos/filter_items/{{ $contrato->id }}'
                        hx-swap='outerHTML' hx-params='none'><i class="fa-solid fa-xmark"></i> Limpar</button>
                @endif
            </div>
        </form>
    </div>
    <x-listGroupHeader>
        <div class="d-none d-lg-block col col-lg-2">Indíce</div>
        <div class="d-none d-lg-block col col-lg-10">Descrição</div>
        <div class="d-block d-lg-none col">Lotes</div>
    </x-listGroupHeader>
    @if ($totais['items_contrato'] == 0)
        <div class="p-4">
            Não foram encontrados items de contrato com "{{ $_GET['search'] ?? '' }}."
        </div>
    @endif
    <div class="overflow-auto rounded-bottom" style="max-height: 600px;">
        @foreach ($itemsContrato as $itemContrato)
            <a href="javascript.void(0)" class="list-group-item list-group-item-action list-parent px-5 py-4"
                data-bs-toggle="offcanvas" data-bs-target="#offcanvas_itemcontrato"
                aria-controls="offcanvas_itemcontrato" hx-get="/offcanvas/{{ $itemContrato->id }}"
                hx-target="#htmx_itemcontrato" hx-sync="this:replace" hx-swap="innerHTML">

                <div class="row d-flex flex-column flex-lg-row align-items-center">
                    <div
                        class="col col-lg-2 d-flex flex-row flex-lg-column text-start text-lg-start justify-content-between justify-content-lg-end">

                        <div class="col-3 text-secondary fw-bold p-xtra-small">
                            {{ $itemContrato->contrato_index }}
                        </div>
                    </div>
                    <div
                        class="col col-lg-10 d-flex flex-row flex-lg-column text-start text-lg-start justify-content-between justify-content-lg-end">

                        <div class="col p-small">
                            {{ $itemContrato->main_lang_name }}
                        </div>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
</div>
