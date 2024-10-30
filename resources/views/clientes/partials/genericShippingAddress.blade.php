<div class="modal-dialog modal-lg modal-dialog-centered">
  <div class="modal-content">
    <form action="/printLabel" method="get" target="_blank">
      <div class="modal-header border border-0">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body border border-0">
        <div class="row">


          <div class="col-12 p-small text-info-emphasis ms-2">Dados de Envio</div>
          <div class='col-12 mt-3 form-floating'>
            <select class="form-select" id="shipping_saudacao" name="shipping_saudacao" aria-label="Default select example">
              <option selected>{{old('shipping_saudacao')}}</option>
              <option value="Ex.mo Sr.">Ex.mo Sr.,</option>
              <option value="Ex.ma Sra.">Ex.ma Sra.,</option>
              <option value="Ex.mos Srs.">Ex.mos Srs.,</option>
            </select>
            <label for="shipping_saudacao" class="form-label col-form-label-sm text-info-emphasis ms-2">Saudação</label>
          </div>
          <x-input.input class="col-12 mt-0" type="text" field="shipping_name" fieldLabel="Nome de Envio" fieldValue="{{old('shipping_name')}}" />
          <x-input.input class="col-12" type="text" field="shipping_address" fieldLabel="Morada de Envio" fieldValue="{{old('shipping_address')}}" />
          <x-input.input class="col-12 col-lg-5" type="text" field="shipping_zip" fieldLabel="Código Postal Envio" fieldValue="{{old('shipping_zip')}}" />
          <x-input.input class="col-12 col-lg-7" type="text" field="shipping_city" fieldLabel="Cidade de Envio" fieldValue="{{old('shipping_city')}}" />
          <x-input.input class="col-12 col-lg-5" type="text" field="shipping_state" fieldLabel="Concelho de Envio" fieldValue="{{old('shipping_state')}}" />
          <x-input.input class="col-12 col-lg-7" type="text" field="shipping_country" fieldLabel="País de Envio" fieldValue="{{old('shipping_country')}}" />
        </div>
      </div>

      <div class="modal-footer border border-0 justify-content-center">
        <button type="button" class="btn btn-outline-secondary rounded-pill" data-bs-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary rounded-pill">Imprimir Etiqueta</button>
      </div>
    </form>

  </div>
</div>