<x-modal title='Novo Leilão' id="novoLeilao" class="modal-lg">
  <form method="POST" action="/leiloes">
    @csrf
    <div class="row justify-content-center">
      <x-formCard>

        <x-input.input class="col-4" type='date' field='start_date' fieldLabel='Data de Início' fieldValue="{{ old('start_date') }}" />
        <x-input.input class="col-4" type='date' field='end_date' fieldLabel='Data de Leilão' fieldValue="{{ old('end_date') }}" />
        <div class=' col-6 col-lg-3 form-floating mt-3'>
          <input type="number" step=".01" class="form-control" id="commission_client" name="commission_client" placeholder="" value="{{ ($leilao->commission_client) ?? '' }}">
          <label for="commission_client" class="form-label col-form-label-sm text-info-emphasis ms-2">Comissão Cliente</label>
        </div>
        <x-input.input class="col-6 col-lg-9" type='text' field='name' fieldLabel='Título' fieldValue="{{ old('name') }}" />
        <div class='col-6 col-lg-3 form-floating mt-3'>
          <select class="form-select" name="estado" id="estado">
            <option selected>espera</option>
            <option value="espera">espera</option>
            <option value="decorrer">decorrer</option>
            <option value="terminado">terminado</option>
            <option value="processado">processado</option>
          </select>
          <label for="estado" class="form-label col-form-label-sm text-info-emphasis ms-2">Estado</label>
        </div>



      </x-formCard>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-sm btn-outline-primary rounded-pill mx-2 px-4" data-bs-dismiss="modal">Cancelar</button>
      <button type="submit" class="btn btn-sm btn-primary rounded-pill mx-2 px-4">Gravar</button>
    </div>
  </form>
</x-modal>