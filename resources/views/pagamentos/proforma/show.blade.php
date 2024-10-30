<x-layout baseRoute={{$baseRoute}}>

    {{-- FLASH MESSAGE --}}
    <x-flashMessage />

    {{-- Title Menu --}}
    <x-mainHeader baseRoute={{$baseRoute}} query={{$query}} title={{$title}}>

        <li class="nav-item">
            <a href="/pagamentos/proximos{{ $query }}" type="submit"
                class="titleMenuButton btn btn-outline-secondary rounded-pill mx-2 px-4">Voltar</a>
        </li>
        <li class="nav-item">
            <button type="submit" form="lista_lotes" class="titleMenuButton btn btn-primary rounded-pill px-4">Criar
                Pagamento</button>
        </li>
        {{-- <li class="nav-item">
            <button type="submit" form="lista_lotes" class="titleMenuButton btn btn-primary rounded-pill px-4">Criar
                Pagamento</button>
        </li> --}}
        <!-- <li class="nav-item">
      <a href="" data-bs-toggle="modal" data-bs-target="#verbetesHelp" class="titleMenuButton btn btn-outline-secondary rounded-circle ms-2"><i class="bi bi-question-lg"></i></a>
    </li> -->
    </x-mainHeader>

    {{-- Div de Conteúdo --}}
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col col-xl-8 mb-4">
                <!-- Main Form (Left Main Col) -->
                @include('pagamentos.proforma.partials.lotes')
            </div>

            <!-- Other Info (Left Col) -->
            <div class="col-12 col-xl-4">
                <x-formCard>
                    <x-infoCard.title title="Fornecedor" />
                    <x-infoCard.infoData name="Fornecedor ID" value="{{ $fornecedor->id }}" />
                    <x-infoCard.infoData name="Referência" value="{{ $fornecedor->seller_reference }}" />
                    <x-infoCard.infoData name="Nome" value="{{ $fornecedor->full_name }}" />
                    <x-infoCard.infoData name="IBAN" value="{{ $fornecedor->seller_nib }}" />
                    {{--
                </x-formCard> --}}
                {{-- <x-formCard class="mt-3"> --}}
                    <x-infoCard.title title="Leilão" class="mt-3 py-1" />
                    <x-infoCard.infoData name="Leilão" value="{{ $leilao->id }}" />
                    <x-infoCard.infoData name="Título" value="{{ $leilao->name }}" />
                    <x-infoCard.infoData name="Data" value="{{ $leilao->end_date }}" />
                </x-formCard>
            </div>

        </div>
    </div>

</x-layout>

{{-- OffCanvas Lotes --}}
<x-offcanvas class="offcanvas-size-xxl" title='Lote' name='lotes'></x-offcanvas>