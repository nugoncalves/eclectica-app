<x-layout baseRoute="{{ $baseRoute }}">
    <form method="POST" action="/contratos">
        @csrf
        {{-- Title Menu --}}
        <x-mainHeader baseRoute="{{ $baseRoute }}" query="{{ $query }}" title="{{ $title }}">
            <li class="nav-item dropdown">
                <button class="titleMenuButton btn btn-outline-secondary rounded-pill dropdown-toggle ms-2 px-4"
                    role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Acções </i>
                </button>
                <ul class="dropdown-menu">
                    <li>
                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#cliente_list"
                            class="dropdown-item">
                            <i class="fa-solid fa-circle-user me-1"></i> Atribuir Fornecedor
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="/contratos{{ $query }}" type="submit"
                    class="titleMenuButton btn btn-outline-secondary rounded-pill ms-2 px-4">Voltar</a>
            </li>
            <li class="nav-item">
                <button type="submit" class="titleMenuButton btn btn-primary rounded-pill ms-2 px-4">Gravar</button>
            </li>
        </x-mainHeader>

        <div class="container mt-3">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-8">
                    <x-formCard>
                        <x-input.input class="col-12 col-lg-4" type="text" field="date" fieldLabel="Data"
                            value="" fieldValue="{{ $dateNow }}" readonly="{{ true }}" />
                        <x-input.input class="col-6 col-lg-4" type="text" field="seller_reference"
                            fieldLabel="Referência Fornecedor" :fieldValue="old('seller_reference')" readonly="true" />
                        <x-input.input class="col-6 col-lg-4" type="text" field="seller_id"
                            fieldLabel="Fornecedor ID" :fieldValue="old('seller_id')" readonly="true" />
                        <label class="mt-3">Comissão</label>
                        <div class='form-floating mt-3'>
                            <select class="form-select" id="commission_type" name="commission_type">
                                <option value=""></option>
                                <option value="Fixa" {{ old('commission_type') == 'Fixa' ? 'selected' : '' }}>Fixa
                                </option>
                                <option value="Progressiva"
                                    {{ old('commission_type') == 'Progressiva' ? 'selected' : '' }}>Progressiva</option>
                            </select>
                            <label for="commission_type"
                                class="form-label col-form-label-sm text-info-emphasis ms-2">Tipo
                                de Comissão</label>
                            <x-input.error field="commission_type" />
                        </div>
                        <x-input.input class="col-6 col-lg-3" type="text" field="commission_300" fieldLabel="até 300"
                            :fieldValue="old('commission_300')" />
                        <x-input.input class="col-6 col-lg-3" type="text" field="commission_1000"
                            fieldLabel="301 a 1000" :fieldValue="old('commission_1000')" />
                        <x-input.input class="col-6 col-lg-3" type="text" field="commission_3000"
                            fieldLabel="1001 a 3000" :fieldValue="old('commission_3000')" />
                        <x-input.input class="col-6 col-lg-3" type="text" field="commission_more_3000"
                            fieldLabel="mais 3000" :fieldValue="old('commission_more_3000')" />
                    </x-formCard>

                </div>

            </div>
            <div class="my-3 row"></div>
        </div>

    </form>
</x-layout>

{{-- Modal de Fornecedores --}}
@include('clientes.modal.list')

<!-- CONTRATOS JAVASCRIPT -->
<script src="{{ asset('js/contratos.js') }}"></script>
