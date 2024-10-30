<!-- CÁLCULOS -->
<div class="d-flex justify-content-end me-5 mb-3" id="totais">
    <div class="col-7">
        <x-infoCard.infoData name="Soma Martelo" :value='$totais["martelo"]' />
        <x-infoCard.infoData name="Comissão" :value='$totais["comissao"]' />
        <x-infoCard.infoData name="IVA" :value='$totais["iva"]' />
        <x-infoCard.infoData class="bg-primary-subtle fw-gold fs-5" name="Valor a Pagar" :value='$totais["pagar"]' />
    </div>
</div>
