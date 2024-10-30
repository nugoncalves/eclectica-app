<!-- Main Form de Pagamentos -->

<form method="POST" action="/pagamentos/{{ $pagamento->id }}" id="main_form">
  @csrf
  @method('PUT')
  <!-- Main Form (Left Main Col) -->
  <x-formCard>
    <x-input.input class="col-12 col-lg-2" type='number' field='id' fieldLabel='#' :fieldValue="$pagamento->id" readonly />
    <x-input.input class="col-6 col-lg-3" type='date' field='date' fieldLabel='Data' :fieldValue="$pagamento->date" />
    <div class='col-6 col-lg-3 form-floating mt-3'>
      <select class="form-select" id="modo" name="modo" placeholder="">
        <option selected>{{$pagamento->modo}}</option>
        <option value="transferência">Transferência</option>
        <option value="dinheiro">Dinheiro</option>
        <option value="acerto">Acerto</option>
        <option value="misto">Misto</option>
      </select>
      <label for="modo" class="form-label col-form-label-sm text-info-emphasis ms-2">Modo</label>
    </div>
    <x-input.input class="col-6 col-lg-2" type='text' field='seller_id' fieldLabel='Fornecedor' :fieldValue="$pagamento->seller_id" readonly />
    <x-input.input class="col-6 col-lg-2" type='text' field='leilao_id' fieldLabel='Leilão' :fieldValue="$pagamento->leilao_id" readonly />
    <x-input.textArea field='notes' fieldLabel='Notas' :fieldValue="$pagamento->notes" />
  </x-formCard>

</form>