<!-- Campos Dados Pessoais -->
<x-input.input class="col12 col-sm-4" type="text" field="id" fieldLabel="N.º Cliente" :fieldValue="$fornecedor->id" />
<div class='col-6 col-sm-4 form-floating mt-3'>
  <select class="form-select" id="seller" name="seller" aria-label="Default select example">
    <option selected>{{$fornecedor->seller}}</option>
    <option value="true">true</option>
    <option value="false">false</option>
  </select>
  <label for="seller" class="form-label col-form-label-sm text-info-emphasis ms-2">Fornecedor</label>
</div>
<x-input.input class="col-6 col-sm-4" type="text" field="seller_reference" fieldLabel="Fornecedor ID" :fieldValue="$fornecedor->seller_reference" />

<x-input.input class="col-12 col-lg-6" type="text" field="first_name" fieldLabel="Primeiro Nome" :fieldValue="$fornecedor->first_name" />
<x-input.input class="col-12 col-lg-6" type="text" field="last_name" fieldLabel="Último Nome" :fieldValue="$fornecedor->last_name" />
<!-- <x-input.input class="col-12 col-lg-6" type="text" field="email" fieldLabel="Email" :fieldValue="$fornecedor->email" /> -->
<!-- <x-input.input class="col-12 col-lg-6" type="text" field="phone" fieldLabel="Telemóvel" :fieldValue="$fornecedor->phone" /> -->
<!-- <x-input.input class="col-12 col-lg-6" type="text" field="nif" fieldLabel="Contribuinte" :fieldValue="$fornecedor->nif" /> -->
<x-input.input class="col-12" type="text" field="iban" fieldLabel="IBAN" :fieldValue="$fornecedor->iban" />