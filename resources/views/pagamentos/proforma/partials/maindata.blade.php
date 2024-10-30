<div class="col-12">
  <x-formCard class="mb-4">
    <x-input.input class="col-6 col-lg-2" type='number' field='id' fieldLabel='Leilão' :fieldValue="$leilao->id" readonly=1/>
    <x-input.input class="col-6 col-lg-3" type='date' field='end_date' fieldLabel='Data de Leilão' :fieldValue="$leilao->end_date" readonly=1/>
    <x-input.input class="col-12 col-lg-7" type='text' field='name' fieldLabel='Título' :fieldValue="$leilao->name" readonly=1/>
    <x-input.input class="col-6 col-lg-2" type='number' field='seller_id' fieldLabel='# Cliente' :fieldValue="$fornecedor->id" readonly=1/>
    <x-input.input class="col-6 col-lg-3" type='text' field='seller_reference' fieldLabel='Referência' :fieldValue="$fornecedor->seller_reference" readonly=1/>
    <x-input.input class="col-12 col-lg-7" type='text' field='fornecedor_name' fieldLabel='Nome' :fieldValue="$fornecedor->full_name" readonly=1/>
    <x-input.input class="col-12" type='text' field='seller_nib' fieldLabel='IBAN' :fieldValue="$fornecedor->seller_nib" readonly=1/>
  </x-formCard>
</div>
