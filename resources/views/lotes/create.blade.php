<x-layout baseRoute={{$baseRoute}}>
  <x-flashMessage />

  <form method="POST" action="/lotes" id="main_form">
    @csrf

    {{-- Title Menu--}}
    <x-mainHeader baseRoute={{$baseRoute}} query={{$query}} title={{$title}}>
      <li class="nav-item">
        <a href="/lotes" class="titleMenuButton btn btn-outline-secondary rounded-pill ms-2 px-4">Cancelar</a>
      </li>
      <li class="nav-item">
        <button type="submit" class="titleMenuButton btn btn-primary rounded-pill ms-2 px-4">Gravar</button>
      </li>
      <li class="nav-item">
        <a href="" data-bs-toggle="modal" data-bs-target="#lotesHelp" class="titleMenuButton btn btn-outline-secondary rounded-circle ms-2"><i class="bi bi-question-lg"></i></a>
      </li>
    </x-mainHeader>

    <div class="container mt-3">

      <div class="row justify-content-center">
        <!-- Main Form (Left Main Col) -->

        <div class="col col-xl-8 mb-4">
          <x-formCard>

            <div class="container">

              <div class="row">
                <div class='col form-floating mt-3'>
                  <select class="form-select" id="contrato_id" name="contrato_id" placeholder="" hx-sync="closest form:abort" hx-trigger="change" hx-sync="this.replace" hx-get="/lotes/dadosContrato" hx-trigger="changed" hx-target="#dados_contrato" hx-swap="innerHTML">
                    <option selected>{{old('contrato_id')}}</option>
                    @foreach ( $contratos as $option)
                    <option value="{{ $option->id }}">{{ $option->id }}</option>
                    @endforeach
                  </select>
                  <label for="leilao_id" class="form-label col-form-label-sm text-info-emphasis ms-2">Contrato</label>
                </div>
              </div>
              <div class="row" id="dados_contrato">

                <x-input.input class="col-4" type='number' field='contrato_index' fieldLabel='Inventário' fieldValue="{{old('contrato_index')  }}" />
                <x-input.input class="col-4" type='text' field='seller_reference' fieldLabel='Forn.Referência' fieldValue="{{old('seller_reference')}}" />
                <x-input.input class="col-4" type='text' field='seller_id' fieldLabel='Forn.ID' fieldValue="{{old('seller_id')}}" />
                <x-input.input class="col-12" type='text' field='' fieldLabel='Nome do Fornecedor' :fieldValue="$fornecedor->full_name ?? ''" disabled=1 />

                <h5 class='col-12 fw-bold text-dark-emphasis border-bottom border-dark-subtle mx-3 mt-4 mb-2'>Comissões</h5>
                <x-input.input class="col-6 col-lg" type='text' field='comission_seller_300' fieldLabel='Até 300€' fieldValue="" />
                <x-input.input class="col-6 col-lg" type='text' field='comission_seller_1000' fieldLabel='De 301 a 1000€' fieldValue="" />
                <x-input.input class="col-6 col-lg" type='text' field='comission_seller_300' fieldLabel='De 1001 a 3000€' fieldValue="" />
                <x-input.input class="col-6 col-lg" type='text' field='comission_seller_300' fieldLabel='Mais de 3000€' fieldValue="" />
              </div>

            </div>
            <x-input.input class="col-12" type='text' field='main_lang_name' fieldLabel='Nome' fieldValue="" />

          </x-formCard>
        </div>


      </div>

    </div>
    <div class="row my-3"></div>
    </div>
  </form>
</x-layout>

<!-- Modal Ajuda -->
<x-modalHelp class="modal-dialog-scrollable" title="Ajuda: Lotes" id="lotesHelp">
  @include('manual.partials.lotesManual')
</x-modalHelp>


<!-- LOTES JAVASCRIPT -->
<script src="{{ asset('js/lotes.js') }}"></script>