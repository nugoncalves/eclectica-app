<x-layout baseRoute="{{ $baseRoute }}">
    <x-flashMessage />

    <form method="POST" action="/lotes/{{ $lote->id }}">
        @csrf
        @method('PUT')

        {{-- Title Menu --}}
        <x-mainHeader baseRoute="{{ $baseRoute }}" query="{{ $query }}" title="{{ $title }}">
            <li class="nav-item">
                <a href="/lotes/{{ $lote->id }}"
                    class="titleMenuButton btn btn-outline-secondary rounded-pill ms-2 px-4">Cancelar</a>
            </li>
            <li class="nav-item">
                <button type="submit" class="titleMenuButton btn btn-primary rounded-pill ms-2 px-4">Gravar</button>
            </li>
            <li class="nav-item">
                <a href="" data-bs-toggle="modal" data-bs-target="#lotesHelp"
                    class="titleMenuButton btn btn-outline-secondary rounded-circle ms-2"><i
                        class="bi bi-question-lg"></i></a>
            </li>
        </x-mainHeader>

        <div class="container mt-3">

            <div class="row justify-content-center">
                <!-- Main Form (Left Main Col) -->

                <div class="col col-xl-8 mb-4">
                    <x-formCard>

                        {{-- Campos Escondidos para Passar no POST e gravar dados --}}
                        <input type="hidden" name="id" value="{{ $lote->id }}">
                        <input type="hidden" name="update" value="1">
                        <input type="hidden" name="verbete_id" value="{{ $lote->verbete_id }}">
                        <input type="hidden" name="status" value="{{ $lote->status }}">

                        <div class="container">

                            <div class="row">
                                <div class='col form-floating mt-3'>
                                    <select class="form-select" id="contrato_id" name="contrato_id" placeholder=""
                                        hx-sync="closest form:abort" hx-trigger="change" hx-sync="this.replace"
                                        hx-get="/lotes/dadosContrato" hx-trigger="changed" hx-target="#dados_contrato"
                                        hx-swap="innerHTML">
                                        <option selected>{{ $lote->contrato_id }}</option>
                                        @foreach ($contratos as $option)
                                            <option value="{{ $option->id }}">{{ $option->id }}</option>
                                        @endforeach
                                    </select>
                                    <label for="leilao_id"
                                        class="form-label col-form-label-sm text-info-emphasis ms-2">Contrato</label>
                                </div>
                            </div>
                            <div class="row" id="dados_contrato">

                                <x-input.input class="col-4" type='number' field='contrato_index'
                                    fieldLabel='Inventário' :fieldValue="$lote->contrato_index" />
                                <x-input.input class="col-4" type='text' field='seller_reference'
                                    fieldLabel='Forn.Referência' :fieldValue="$lote->seller_reference" />
                                <x-input.input class="col-4" type='text' field='seller_id' fieldLabel='Forn.ID'
                                    :fieldValue="$lote->seller_id" />
                                <x-input.input class="col-12" type='text' field=''
                                    fieldLabel='Nome do Fornecedor' :fieldValue="$fornecedor->full_name ?? ''" disabled=1 />

                                <h5
                                    class='col-12 fw-bold text-dark-emphasis border-bottom border-dark-subtle mx-3 mt-4 mb-2'>
                                    Comissões</h5>
                                <x-input.input class="col-6 col-lg" type='text' field='comission_seller_300'
                                    fieldLabel='Até 300€' :fieldValue="$lote->comission_seller_300" />
                                <x-input.input class="col-6 col-lg" type='text' field='comission_seller_1000'
                                    fieldLabel='De 301 a 1000€' :fieldValue="$lote->comission_seller_300" />
                                <x-input.input class="col-6 col-lg" type='text' field='comission_seller_300'
                                    fieldLabel='De 1001 a 3000€' :fieldValue="$lote->comission_seller_300" />
                                <x-input.input class="col-6 col-lg" type='text' field='comission_seller_300'
                                    fieldLabel='Mais de 3000€' :fieldValue="$lote->comission_seller_300" />
                            </div>

                        </div>
                        <x-input.textArea field='main_lang_name' fieldLabel='Nome' :fieldValue="$lote->main_lang_name" />
                        <!-- <x-input.richText field='main_lang_desc' fieldLabel='Comentário' fieldValue={!! $lote->main_lang_desc !!} />
                            <x-input.input class="col-12" type='text' field='tags' fieldLabel='TAGS [Temas]' :fieldValue="$lote->tags" />
                            <x-input.textArea field='notes' fieldLabel='Notas' :fieldValue="$lote->notes" /> -->

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
