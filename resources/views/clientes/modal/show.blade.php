<div class="col-12 d-flex flex-row justify-content-end mb-3 text-end gap-1">
  <button class="btn btn-sm btn-outline-primary rounded-pill px-4 d-block" data-bs-target="#cliente_list" data-bs-toggle="modal">Voltar</button>
  <div class="dropdown">
    <button class="btn btn-sm btn-outline-primary rounded-pill dropdown-toggle px-4" role="button" data-bs-toggle="dropdown" aria-expanded="false">
      Acções </i>
    </button>
    <ul class="dropdown-menu">
      <li>
        <a class="dropdown-item" href="javascript:void(0)" href="javascript:void(0)" hx-get="/clientes/modal/{{ $cliente->id }}/edit" hx-target="#clienteContent" hx-sync="this:replace" hx-swap="innerHTML">
          <i class="fa-solid fa-pen"></i> Alterar
        </a>
      </li>
      <li>
        <a class="dropdown-item" data-bs-toggle="collapse" href="#collapseDuplicate" role="button" aria-expanded="false" aria-controls="collapseExample">
          <i class="fa-solid fa-clone"></i> Duplicar
        </a>
      </li>
    </ul>
  </div>

  @if ($cliente->seller == 'true')
  <button onclick="clienteTo()" class="btn btn-sm btn-primary rounded-pill px-4 d-block" data-bs-toggle="modal">Usar Cliente</button>
  @endif
</div>

<div class="collapse" id="collapseDuplicate">
  <div class="alert alert-warning alert-dismissible fade show my-2" role="alert">
    <p>Tem a certeza que quer duplicar o Cliente?</p>
    <hr>
    <a class="alert-link px-3" data-bs-toggle="collapse" href="#collapseDuplicate" role="button" aria-expanded="false">Cancelar</a> |
    <a class="alert-link px-3" href="javascript:void(0)" hx-get="/clientes/modal/{{ $cliente->id }}/duplicate" hx-target="#clienteContent" hx-sync="this:replace" hx-swap="innerHTML">
      Confirmar</a>
    <button role="button" class="btn-close" data-bs-toggle="collapse" href="#collapseDuplicate" role="button" aria-expanded="false"></button>
  </div>
</div>

<div class="row justify-content-center">
  <div class="col-12">
    <div class="row m-0 p-0">
      <!-- Campos Dados Pessoais -->
      <div class='col-12 col-sm-4 form-floating mt-3'>
        <input type="number" class="form-control" id="modal_cliente_id" name="id" placeholder="" value="{{ $cliente->id }}" disabled>
        <label for="id" class="form-label col-form-label-sm text-info-emphasis ms-2">N.º Cliente</label>
      </div>
      <div class='col-6 col-sm-4 form-floating mt-3'>
        <input type="text" class="form-control" id="modal_cliente_seller" name="seller" placeholder="" value="{{ $cliente->seller }}" disabled>
        <label for="seller" class="form-label col-form-label-sm text-info-emphasis ms-2">Fornecedor</label>
      </div>
      <div class='col-6 col-sm-4 form-floating mt-3'>
        <input type="text" class="form-control" id="modal_cliente_seller_reference" name="seller_reference" placeholder="" value="{{ $cliente->seller_reference }}" disabled>
        <label for="seller_reference" class="form-label col-form-label-sm text-info-emphasis ms-2">Ref.ª Fornecedor</label>
      </div>
      <div class='col-12 col-sm-6 form-floating mt-3'>
        <input type="text" class="form-control" id="modal_cliente_first_name" name="first_name" placeholder="" value="{{ $cliente->first_name }}" disabled>
        <label for="first_name" class="form-label col-form-label-sm text-info-emphasis ms-2">Primeiro Nome</label>
      </div>
      <div class='col-12 col-sm-6 form-floating mt-3'>
        <input type="text" class="form-control" id="modal_cliente_last_name" name="last_name" placeholder="" value="{{ $cliente->last_name }}" disabled>
        <label for="last_name" class="form-label col-form-label-sm text-info-emphasis ms-2">Apelido</label>
      </div>
      <div class='col-12 col-sm-6 form-floating mt-3'>
        <input type="text" class="form-control" id="modal_cliente_email" name="email" placeholder="" value="{{ $cliente->email }}" disabled>
        <label for="email" class="form-label col-form-label-sm text-info-emphasis ms-2">Email</label>
      </div>
      <div class='col-12 col-sm-6 form-floating mt-3'>
        <input type="text" class="form-control" id="modal_cliente_phone" name="phone" placeholder="" value="{{ $cliente->phone }}" disabled>
        <label for="email" class="form-label col-form-label-sm text-info-emphasis ms-2">Telefone</label>
      </div>

      <div class="col-12 p-small text-info-emphasis ms-2 mt-5">Morada Principal</div>
      <div class='col-12 form-floating mt-3'>
        <input type="text" class="form-control" id="modal_cliente_address" name="address" placeholder="" value="{{ $cliente->address }}" disabled>
        <label for="address" class="form-label col-form-label-sm text-info-emphasis ms-2">Morada</label>
      </div>
      <div class='col-12 col-lg-5 form-floating mt-3'>
        <input type="text" class="form-control" id="modal_cliente_zip" name="zip" placeholder="" value="{{ $cliente->zip}}" disabled>
        <label for="zip" class="form-label col-form-label-sm text-info-emphasis ms-2">Código Postal</label>
      </div>
      <div class='col-12 col-lg-7 form-floating mt-3'>
        <input type="text" class="form-control" id="modal_cliente_city" name="city" placeholder="" value="{{ $cliente->city}}" disabled>
        <label for="city" class="form-label col-form-label-sm text-info-emphasis ms-2">Localidade</label>
      </div>
      <div class='col-12 col-lg-5 form-floating mt-3'>
        <input type="text" class="form-control" id="modal_cliente_state" name="state" placeholder="" value="{{ $cliente->state}}" disabled>
        <label for="state" class="form-label col-form-label-sm text-info-emphasis ms-2">Estado</label>
      </div>
      <div class='col-12 col-lg-7 form-floating mt-3'>
        <input type="text" class="form-control" id="modal_cliente_country" name="country" placeholder="" value="{{ $cliente->country}}" disabled>
        <label for="country" class="form-label col-form-label-sm text-info-emphasis ms-2">País</label>
      </div>

    </div>

  </div>

</div>