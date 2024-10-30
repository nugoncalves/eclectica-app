<!-- EDITAR COLOCAÇÃO -->

<x-formCard id="itemLeilaoEdit" class=" {{ ($leilao->status != 'espera') ? 'd-none' : 'd-block' }}">

  <form method="POST" action="/itemsLeilao/{{$iL->id}}">
    @csrf
    @method('PUT')
    <div class="row">
      <div class="text-end mb-3">
        <a class="btn btn-sm btn-light rounded-pill px-4" href="/itemsLeilao/print/label/{{$iL->id}}" target="_blank"><i class="fa-solid fa-print"></i> Etiqueta Leilão</a>
      </div>

      <input type="hidden" class="form-control" name="id" placeholder="" value="{{ $iL->id }}">
      <input type="hidden" class="form-control" name="items_contrato_id" placeholder="" value="{{$iL->items_contrato_id}}">

      <div class='col-6 form-floating mt-3'>
        <select class="form-select" id="leilao_id" name="leilao_id" placeholder="">
          <option selected>{{ $iL->leilao_id }}</option>
          @foreach ( $leiloes as $option)
          <option value="{{ $option->id }}">{{ $option->id }}</option>
          @endforeach
        </select>
        <label for="leilao_id" class="form-label col-form-label-sm text-info-emphasis ms-2">Leilão</label>
      </div>
      <x-input.input class="col-6" type='number' field='leilao_lote' fieldLabel='Lote' fieldValue="{{ $iL->leilao_lote }}" />
      <x-input.input class="col-6 col-lg" type='number' field='start_price' fieldLabel='Base' fieldValue="{{ $iL->start_price }}" :inputDesc='$iC->reserve' />
      <x-input.input class="col-6 col-lg" type='number' field='min_estimate' fieldLabel='Est. Min (€)' fieldValue="{{ $iL->min_estimate }}" />
      <x-input.input class="col-6 col-lg" type='number' field='max_estimate' fieldLabel='Est. Máx (€)' fieldValue="{{ $iL->max_estimate }}" />

      <div class="mt-5 text-center">
        <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-4" data-bs-dismiss="offcanvas" aria-label="Close">Cancelar</button>
        <a class="btn btn-sm btn-danger rounded-pill px-4" href="#" onclick="getElementById('deleteItemLeilao').classList.remove('d-none'); getElementById('itemLeilaoEdit').classList.add('d-none')">
          <i class="bi bi-trash3"></i> Apagar
        </a>
        <button type="submit" class="btn btn-sm btn-primary rounded-pill px-4">Gravar</button>

      </div>
    </div>

  </form>

</x-formCard>