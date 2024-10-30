<!-- CÁLCULOS -->
<div class="row d-flex justify-content-end">

  <div class="col-6" id="totais">

    <x-formCard>

      <x-infoCard.infoData name="Soma Martelo" :value='$totais["martelo"]' />
      <x-infoCard.infoData name="Comissão" :value='$totais["comissao"]' />
      <x-infoCard.infoData name="IVA" :value='$totais["iva"]' />
      <x-infoCard.infoData class="text-bg-secondary" name="Valor a Pagar" :value='$totais["pagar"]' />

    </x-formCard>
  </div>
</div>