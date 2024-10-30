<form method="POST"
  {{-- action="/historico/{{ $iL->id }}" target="_blank"> --}}
  hx-post="/historico/{{ $iL->id }}"
  hx-target="#lote_status"
  hx-swap="innerHTML">
  @csrf
  @method('PUT')
  <div class="col-12 d-flex justify-content-between align-items-center gap-2">
    <div class='col-3 form-floating'>
      <select class="form-select text-capitalize" id="status" name="status" placeholder=""
        hx-trigger="change"
        hx-post="/historico/{{ $iL->id }}"
        hx-target="#lote_status"
        hx-swap="innerHTML">
        <option selected>{{ ucwords($iL->status) }}</option>
        <option value="decorrer">Decorrer</option>
        <option value="vendido">Vendido</option>
        <option value="retirado">Retirado</option>
        <option value="não pago">Não pago</option>
        <option value="anulado">Anulado</option>

      </select>
      <label for="leilao_id" class="form-label col-form-label-sm text-info-emphasis">Estado</label>
    </div>

    <div class="col-9">
      <div class='form-floating'>
        <input type="text" class="form-control" id="notes" name="notes" placeholder="" value="{{ $iL->notes }}">
        <label for="notes" class="form-label col-form-label-sm text-info-emphasis ms-2">Notas</label>
      </div>
    </div>
  </div>
  <div class="text-end">
    <button class="btn btn-sm rounded-pill btn-primary px-3 mt-2" type="submit">Gravar</button>
  </div>
</form>
