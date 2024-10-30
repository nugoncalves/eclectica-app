<div class="col-12 p-small text-info-emphasis ms-2 mt-5">Morada Principal</div>

<x-input.input class="col-12" type="text" field="address" fieldLabel="Morada" :fieldValue="$cliente->address" />
<x-input.input class="col-12 col-lg-5" type="text" field="zip" fieldLabel="Código Postal" :fieldValue="$cliente->zip" />
<x-input.input class="col-12 col-lg-7" type="text" field="city" fieldLabel="Localidade" :fieldValue="$cliente->city" />
<x-input.input class="col-12 col-lg-5" type="text" field="state" fieldLabel="Estado" :fieldValue="$cliente->state" />
<x-input.input class="col-12 col-lg-7" type="text" field="country" fieldLabel="País" :fieldValue="$cliente->country" />
