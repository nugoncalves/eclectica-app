<!-- HTMX Update Dados de Contrato -->

<x-input.input class="col-4" type='number' field='contrato_index' fieldLabel='Inventário' :fieldValue="$itemContratoIndex" />
<x-input.input class="col-4" type='text' field='seller_reference' fieldLabel='Forn.Referência' :fieldValue="$contrato->seller_reference" />
<x-input.input class="col-4" type='text' field='seller_id' fieldLabel='Forn.ID' :fieldValue="$contrato->seller_id" />
<x-input.input class="col-12" type='text' field='' fieldLabel='Nome do Fornecedor' :fieldValue="$fornecedor->full_name ?? ''" disabled=1 />


<h5 class='col-12 fw-bold text-dark-emphasis border-bottom border-dark-subtle mx-3 mt-4 mb-2'>Comissões</h5>
<x-input.input class="col-6 col-lg" type='text' field='commission_seller_300' fieldLabel='Até 300€' :fieldValue="$contrato->commission_300" />
<x-input.input class="col-6 col-lg" type='text' field='commission_seller_1000' fieldLabel='De 301 a 1000€' :fieldValue="$contrato->commission_1000" />
<x-input.input class="col-6 col-lg" type='text' field='commission_seller_300' fieldLabel='De 1001 a 3000€' :fieldValue="$contrato->commission_3000" />
<x-input.input class="col-6 col-lg" type='text' field='commission_seller_300' fieldLabel='Mais de 3000€' :fieldValue="$contrato->commission_more_3000" />