<form hx-post="/clientes/modal" hx-target="#clienteContent" hx-swap="innerHTML">
  @csrf
  {{-- Title Menu --}}
  <div class="col-12 mb-3 text-end gap-3">
    <button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-4" data-bs-target="#cliente_list" data-bs-toggle="modal">
      Cancelar
    </button>
    <button type="submit" class="btn btn-sm btn-primary rounded-pill px-4">Gravar</button>
  </div>

  <div class="container mt-3">
    <div class="row justify-content-center">
      <div class="col-12">
        <x-formCard>
          <div class="row m-0 p-0">
            <!-- {{-- Campos Escondidos para Passar no POST e gravar dados --}} -->
            <input type="hidden" class="form-control" id="id" name="id" placeholder="" value="$lastClient" />

            <!-- Campos Dados Pessoais -->
            <x-input.input class="col12 col-sm-4" type="text" field="id" fieldLabel="N.º Cliente" :fieldValue="$lastClient" />
            <div class='col-6 col-sm-4 form-floating mt-3'>
              <select class="form-select" id="seller" name="Seller" aria-label="Default select example">
                <option selected></option>
                <option value="true">true</option>
                <option value="false">false</option>
              </select>
              <label for="seller" class="form-label col-form-label-sm text-info-emphasis ms-2">Fornecedor</label>
            </div>
            <x-input.input class="col-6 col-sm-4" type="text" field="SellerID" fieldLabel="Fornecedor ID" :fieldValue="old('seller_id')" />


            <div class='col-12 mt-3 form-floating'>
              <select class="form-select" name="saudacao" aria-label="Default select example">
                <option selected></option>
                <option value="Ex.mo Sr.">Ex.mo Sr.,</option>
                <option value="Ex.ma Sra.">Ex.ma Sra.,</option>
                <option value="Ex.mos Srs.">Ex.mos Srs.,</option>
              </select>
              <label for="saudacao" class="form-label col-form-label-sm text-info-emphasis ms-2">Saudação</label>
            </div>

            <x-input.input class="col-12 col-lg-6" type="text" field="firstName" fieldLabel="Primeiro Nome" :fieldValue="old('first_name')" />
            <x-input.input class="col-12 col-lg-6" type="text" field="lastName" fieldLabel="Último Nome" :fieldValue="old('last_name')" />
            <x-input.input class="col-12 col-lg-6" type="text" field="Email" fieldLabel="Email" :fieldValue="old('email')" />
            <x-input.input class="col-12 col-lg-6" type="text" field="Phone" fieldLabel="Telemóvel" :fieldValue="old('phone')" />


            <div class="col-12 p-small text-info-emphasis ms-2 mt-5">Morada Principal</div>

            <x-input.input class="col-12" type="text" field="Address" fieldLabel="Morada" :fieldValue="old('address')" />
            <x-input.input class="col-12 col-lg-5" type="text" field="Zip" fieldLabel="Código Postal" :fieldValue="old('zip')" />
            <x-input.input class="col-12 col-lg-7" type="text" field="City" fieldLabel="Localidade" :fieldValue="old('city')" />
            <x-input.input class="col-12 col-lg-5" type="text" field="State" fieldLabel="Estado" :fieldValue="old('state')" />
            <x-input.input class="col-12 col-lg-7" type="text" field="Country" fieldLabel="País" :fieldValue="old('country')" />


          </div>
        </x-formCard>

        <!-- Dados de Envio -->
        <div class="row m-0 p-0">
          <x-formCard class="mt-3">

            <div class="col-12 p-small text-info-emphasis ms-2">Dados de Envio</div>


            <div class='col-12 mt-3 form-floating'>
              <select class="form-select" id="shipping_saudacao" name="shipping_saudacao" aria-label="Default select example">
                <option selected></option>
                <option value="Ex.mo Sr.">Ex.mo Sr.,</option>
                <option value="Ex.ma Sra.">Ex.ma Sra.,</option>
                <option value="Ex.mos Srs.">Ex.mos Srs.,</option>
              </select>
              <label for="shipping_saudacao" class="form-label col-form-label-sm text-info-emphasis ms-2">Saudação</label>
            </div>

            <x-input.input class="col-12 mt-0" type="text" field="Shipping_name" fieldLabel="Nome de Envio" :fieldValue="old('shipping_name')" />
            <x-input.input class="col-12" type="text" field="Shipping_address" fieldLabel="Morada de Envio" :fieldValue="old('shipping_address')" />
            <x-input.input class="col-12 col-lg-5" type="text" field="Shipping_zip" fieldLabel="Código Postal Envio" :fieldValue="old('shipping_zip')" />
            <x-input.input class="col-12 col-lg-7" type="text" field="Shipping_city" fieldLabel="Cidade de Envio" :fieldValue="old('shipping_city')" />
            <x-input.input class="col-12 col-lg-5" type="text" field="Shipping_state" fieldLabel="Concelho de Envio" :fieldValue="old('shipping_state')" />
            <x-input.input class="col-12 col-lg-7" type="text" field="Shipping_country" fieldLabel="País de Envio" :fieldValue="old('shipping_country')" />

          </x-formCard>
        </div>

      </div>

    </div>
    <div class="row my-3"></div>
  </div>

  <div class="my-3 row"></div>


</form>