<!-- Dados de Envio -->
<div class="row m-0 p-0">
  <x-formCard class="mt-3">

    <div class="col-12 p-small text-info-emphasis ms-2">Dados de Envio</div>


    <div class='col-12 mt-3 form-floating'>
      <select class="form-select" id="shipping_saudacao" name="shipping_saudacao" aria-label="Default select example">
        <option selected>{{$cliente->shipping_saudacao}}</option>
        <option value="Ex.mo Sr.">Ex.mo Sr.,</option>
        <option value="Ex.ma Sra.">Ex.ma Sra.,</option>
        <option value="Ex.mos Srs.">Ex.mos Srs.,</option>
      </select>
      <label for="shipping_saudacao" class="form-label col-form-label-sm text-info-emphasis ms-2">Saudação</label>
    </div>

    <x-input.input class="col-12 mt-0" type="text" field="shipping_name" fieldLabel="Nome de Envio" :fieldValue="$cliente->shipping_name" />
    <x-input.input class="col-12" type="text" field="shipping_address" fieldLabel="Morada de Envio" :fieldValue="$cliente->shipping_address" />
    <x-input.input class="col-12 col-lg-5" type="text" field="shipping_zip" fieldLabel="Código Postal Envio" :fieldValue="$cliente->shipping_zip" />
    <x-input.input class="col-12 col-lg-7" type="text" field="shipping_city" fieldLabel="Cidade de Envio" :fieldValue="$cliente->shipping_city" />
    <x-input.input class="col-12 col-lg-5" type="text" field="shipping_state" fieldLabel="Concelho de Envio" :fieldValue="$cliente->shipping_state" />
    <x-input.input class="col-12 col-lg-7" type="text" field="shipping_country" fieldLabel="País de Envio" :fieldValue="$cliente->shipping_country" />

  </x-formCard>
</div>
