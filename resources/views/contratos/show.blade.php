<x-layout baseRoute="{{ $baseRoute }}">

    <x-flashMessage />

    {{-- Title Menu  --}}
    <x-mainHeader baseRoute="{{ $baseRoute }}" query="{{ $query }}" title="{{ $title }}">
        <li class="nav-item dropdown">
            <button class="titleMenuButton btn btn-outline-secondary rounded-pill dropdown-toggle ms-2 px-4"
                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Acções </i>
            </button>
            <ul class="dropdown-menu">
                @if ($contrato->seller_id)
                    <li>
                        <a href="javascript:void(0)" class="dropdown-item"
                            hx-get="/clientes/modal/{{ $contrato->seller_id }}" hx-target="#clienteContent"
                            hx-sync="this:replace" hx-swap="innerHTML" hx-indicator="#fornecedor_indicator"
                            data-bs-toggle="modal" data-bs-target="#cliente_form">
                            <!-- <a href="javascript:void(0)" data-bs-toggle="offcanvas" data-bs-target="#offcanvas_verbetes_list" class="dropdown-item"> -->
                            <i class="fa-solid fa-circle-user me-1"></i> Abrir Fornecedor
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                @endif
                <li>
                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#cliente_list"
                        class="dropdown-item">
                        <i class="fa-solid fa-circle-user me-1"></i> Atribuir Fornecedor
                    </a>
                </li>
                <li>
                    <a href="/contratos/addLotes/{{ $contrato->id }}" class="dropdown-item">
                        <i class="fa-solid fa-book me-1"></i> Adicionar Lotes
                    </a>
                </li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li>
                    <a class="dropdown-item link-danger" href="#" data-bs-toggle="modal"
                        data-bs-target="#deleteModal" aria-labelledby="deleteModal">
                        <i class="bi bi-trash3"></i> Apagar
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="/contratos{{ $query }}" type="submit"
                class="titleMenuButton btn btn-outline-secondary rounded-pill ms-2 px-4">Voltar</a>
        </li>
        <li class="nav-item">
            <button type="submit" form="contratoForm"
                class="titleMenuButton btn btn-primary rounded-pill ms-2 px-4">Gravar</button>
        </li>
    </x-mainHeader>

    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-12 col-xl-8 mb-4">

                <form id="contratoForm" method="POST" action="/contratos/{{ $contrato->id }}">
                    @csrf
                    @method('PUT')
                    <x-formCard>
                        <x-input.input class="col-6" type="text" field="id" fieldLabel="Contrato ID"
                            :fieldValue="$contrato->id" />
                        <x-input.input class="col-6" type="text" field="date" fieldLabel="Data"
                            :fieldValue="$contrato->date" />
                        <x-input.input class="col-6" type="text" field="seller_reference"
                            fieldLabel="Referência Fornecedor" :fieldValue="$contrato->seller_reference" />
                        <x-input.input class="col-6" type="text" field="seller_id" fieldLabel="Fornecedor ID"
                            :fieldValue="$contrato->seller_id" />
                        <label class="mt-3">Comissão</label>
                        <div class="form-floating mt-3">
                            <select class="form-select" id="commission_type" name="commission_type">
                                <option value=""></option>
                                <option value="Progressiva"
                                    {{ ucwords($contrato->commission_type) == 'Progressiva' ? 'selected' : '' }}>
                                    Progressiva
                                </option>
                                <option value="Fixa"
                                    {{ ucwords($contrato->commission_type) == 'Fixa' ? 'selected' : '' }}>
                                    Fixa
                                </option>
                            </select>
                            <label for="commission_type"
                                class="form-label col-form-label-sm text-info-emphasis ms-2">Tipo
                                de Comissão</label>
                            <x-input.error field="commission_type" />
                        </div>
                        <x-input.input class="col-6 col-lg-3" type="text" field="commission_300" fieldLabel="com300"
                            :fieldValue="$contrato->commission_300" />
                        <x-input.input class="col-6 col-lg-3" type="text" field="commission_1000"
                            fieldLabel="com1000" :fieldValue="$contrato->commission_1000" />
                        <x-input.input class="col-6 col-lg-3" type="text" field="commission_3000"
                            fieldLabel="com3000" :fieldValue="$contrato->commission_3000" />
                        <x-input.input class="col-6 col-lg-3" type="text" field="commission_more_3000"
                            fieldLabel="comMais3000" :fieldValue="$contrato->commission_more_3000" />
                    </x-formCard>

                </form>
                <x-listGroup>
                    @include('contratos.items_contrato_em_contrato')
                </x-listGroup>
            </div>

            @if ($cliente)
                <div class="col-12 col-xl-4">

                    <x-formCard class="mb-4">

                        <x-infoCard.title title="INFO Fornecedor" />
                        <x-infoCard.infoData name="Nome" :value="ucwords($cliente->full_name)" />
                        <x-infoCard.infoData name="Email" :value="$cliente->email" />
                        <x-infoCard.infoData name="Estado" :value="$cliente->status" />
                        <x-infoCard.infoData name="Origem" :value="$cliente->origin" />
                        <x-infoCard.infoData name="Data de Criação" :value="$cliente->added" />
                    </x-formCard>
                </div>
            @endif
        </div>
        <div class="row my-3"></div>
    </div>
</x-layout>

{{-- MODAL FORNECEDORES --}}
@include('clientes.modal.list')

{{-- MODAL PARA CRIAR NOVO LOTE --}}
@include('contratos.create_item_contrato', ['contrato' => $contrato])

{{-- OffCanvas ContratosLote --}}
<x-offcanvas class="offcanvas-size-xxl" title='Item de Contrato' name='itemcontrato'></x-offcanvas>

<script src="{{ asset('js/contratos.js') }}"></script>


<!-- MODAIS -->

<!-- Modal de confirmação para eliminação de registo -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteModal">Apagar Contrato</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div>
                    <p>
                        Tem a certeza que quer apagar o Contrato # <strong><?= $contrato['id'] ?></strong>
                    </p>
                    <p>
                        <strong><?= $cliente['all_name'] ?? '' ?></strong>
                    </p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary rounded-pill mx-1 px-4"
                    data-bs-dismiss="modal">Cancelar</button>
                <form method="POST" action="/contratos/{{ $contrato->id }}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger rounded-pill mx-1 px-4">Apagar</button>
                </form>
            </div>
        </div>
    </div>
</div>
