<div class="list-group rounded shadow bg-white mb-1 mt-3" id="lotes_de_leilao">
    {{-- CABEÇALHO --}}
    <div class="row align-items-center justify-content-between py-3 px-5">
        <div class="col-12 col-lg-4 fw-bold fs-5 text-dark-emphasis">
            <div>Lista de Lotes</div>
            <div class="p-xtra-small p-0 m-0">[Lotes: {{ count($lotes) }}]</div>
        </div>
    </div>

    <x-listGroupHeader>
        <div class="d-none d-lg-block col-2">Lote</div>
        <div class="d-none d-lg-block col-8">Descrição</div>
        <div class="d-none d-lg-block text-end col-2">Pago</div>
        <div class="d-block d-lg-none col">Sumário</div>
    </x-listGroupHeader>

    {{-- LOTES --}}
    <div class="overflow-auto rounded-bottom" style="max-height: 600px;" id="lotes_de_leilão">
        @foreach ($lotes as $l)
        <div class="py-4 ps-5 pe-3 list-group-item list-group-item-action list-parent">
            <div class="row d-flex flex-column flex-lg-row align-items-center">
                <div class="col col-lg-2 text-secondary fw-bold p-small">
                    {{$l->itemsLeilaoLast->leilao_id}}.
                    {{$l->itemsLeilaoLast->leilao_lote}}
                </div>
                <div class="col col-lg-8 p-small">
                    {{$l->main_lang_name }}
                </div>
                <div
                    class="col col-lg-2 p-small d-flex flex-column flex-sm-row flex-lg-column justify-content-between justify-content-lg-end">
                    <div class="col col-lg-12 fw-bold text-end">
                        {{ Number::currency($l->itemsLeilaoLast->price - $l->itemsLeilaoLast->commission_seller -
                        ($l->itemsLeilaoLast->commission_seller * .23), in:'EUR', locale:'pt') }}
                    </div>
                    <div class="col col-lg-12 p-xtra-small text-secondary text-end">
                        <i class="fa-solid fa-gavel"></i> {{Number::currency($l->itemsLeilaoLast->price, in:'EUR',
                        locale:'pt')}}
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-end mt-3 me-5 mb-3" id="totais">
        <div class="col-7 border-top border-secondary">

            <x-infoCard.infoData name="Soma Martelo" :value='$totais["martelo"]' />
            <x-infoCard.infoData name="Comissão" :value='$totais["comissao"]' />
            <x-infoCard.infoData name="IVA" :value='$totais["iva"]' />
            <x-infoCard.infoData class="text-bg-secondary" name="Valor Pago" :value='$totais["pagar"]' />
        </div>
    </div>
</div>