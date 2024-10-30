<x-modal class="modal-lg modal-dialog-scrollable" title="Nova Colocação em Leilão" id="modal_nova_colocacao">
  <form method="POST" action="/itemsLeilao">
    @csrf
    <div class="row justify-content-center">
      <x-formCard>
        <input type="hidden" class="form-control" name="items_contrato_id" placeholder="" value="{{$lote->id}}">
        <div class='col-6 form-floating mt-3'>
          <select class="form-select" id="leilao_id" name="leilao_id" placeholder="" hx-get="/itemsContrato/maxLoteLeilao" hx-target="#leilao_lote" hx-swap="outerHTML">
            <option selected></option>
            @foreach ( $leiloes as $option)
            <option value="{{ $option->id }}">{{ $option->id }}</option>
            @endforeach
          </select>
          <label for="leilao_id" class="form-label col-form-label-sm text-info-emphasis ms-2">Leilão</label>
        </div>
        <x-input.input class="col-6" type='number' field='leilao_lote' fieldLabel='Lote' fieldValue="" />
        <x-input.input class="col-6 col-lg" type='number' field='start_price' fieldLabel='Base' fieldValue="" :inputDesc='$lote->reserve' />
        <x-input.input class="col-6 col-lg" type='number' field='min_estimate' fieldLabel='Est. Min (€)' fieldValue="" />
        <x-input.input class="col-6 col-lg" type='number' field='max_estimate' fieldLabel='Est. Máx (€)' fieldValue="" />

        <div class="mt-5 d-flex flex-row justify-content-center">
          <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-sm btn-primary rounded-pill mx-2 px-4">Gravar</button>
        </div>
      </x-formCard>
    </div>
  </form>
</x-modal>