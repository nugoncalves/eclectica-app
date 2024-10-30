<!-- Campos Dados Pessoais -->
<x-input.input class="col12 col-sm-4" type="text" field="id" fieldLabel="N.º Cliente" :fieldValue="$cliente->id" />
<div class='col-6 col-sm-4 form-floating mt-3'>
  <select class="form-select" id="seller" name="seller" aria-label="Default select example">
    <option selected>{{$cliente->seller}}</option>
    <option value="true">true</option>
    <option value="false">false</option>
  </select>
  <label for="seller" class="form-label col-form-label-sm text-info-emphasis ms-2">Fornecedor</label>
</div>
<x-input.input class="col-6 col-sm-4" type="text" field="seller_reference" fieldLabel="Fornecedor ID" :fieldValue="$cliente->seller_reference" />


<div class='col-12 mt-3 form-floating'>
  <select class="form-select" name="saudacao" aria-label="Default select example">
    <option selected>{{$cliente->saudacao}}</option>
    <option value="Ex.mo Sr.">Ex.mo Sr.,</option>
    <option value="Ex.ma Sra.">Ex.ma Sra.,</option>
    <option value="Ex.mos Srs.">Ex.mos Srs.,</option>
  </select>
  <label for="saudacao" class="form-label col-form-label-sm text-info-emphasis ms-2">Saudação</label>
</div>

<x-input.input class="col-12 col-lg-6" type="text" field="first_name" fieldLabel="Primeiro Nome" :fieldValue="$cliente->first_name" />
<x-input.input class="col-12 col-lg-6" type="text" field="last_name" fieldLabel="Último Nome" :fieldValue="$cliente->last_name" />
<x-input.input class="col-12 col-lg-6" type="text" field="email" fieldLabel="Email" :fieldValue="$cliente->email" />
<x-input.input class="col-12 col-lg-6" type="text" field="phone" fieldLabel="Telemóvel" :fieldValue="$cliente->phone" />
