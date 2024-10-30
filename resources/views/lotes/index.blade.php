<x-layout baseRoute="{{ $baseRoute }}">

    {{-- Title Menu --}}
    <x-mainHeader baseRoute="{{ $baseRoute }}" query="{{ $query }}" title="{{ $title }}">
        <li class="nav-item">
            <a href="javascript: void(0)" class="titleMenuButton btn btn-outline-secondary rounded-pill m-1 px-4" data-bs-toggle="modal" data-bs-target="#modal_codigos" aria-controls="modal_codigos">Pesquisa por
                Códigos</a>
        </li>
        <li class="nav-item">
            <a href="/lotes/create" class="titleMenuButton btn btn-primary rounded-pill m-1 px-4">Novo</a>
        </li>
        <li class="nav-item">
            <a href="" data-bs-toggle="modal" data-bs-target="#lotesHelp" class="titleMenuButton btn btn-outline-secondary rounded-circle ms-2"><i class="bi bi-question-lg"></i></a>
        </li>
    </x-mainHeader>

    {{-- FLASH MESSAGE --}}
    <x-flashMessage />

    <x-listGroup>

        <!-- procurar, filtrar, ordenar, etc. -->
        <div class="list-group-item px-5 py-3">
            <div class="row d-flex justify-content-between">
                <form class="col-12 col-lg-7 mb-3 mb-lg-0">
                    <div class="col input-group input-group-sm">
                        <input id="search" type="search" class="form-control form-control-sm rounded-pill px-3" name="search" placeholder="Procurar texto..." value="{{ $_GET['search'] ?? '' }}">
                        <button class="btn btn-outline-secondary rounded-circle ms-2 btn-sm" type="submit">
                            <i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </form>

                <div class="col-6 col-lg-2  text-end p-0">
                    @if ($filtered)
                    <button onclick="location.href='<?= $baseRoute ?>'" class="btn btn-sm btn-outline-secondary rounded-pill ms-auto px-4" type="reset">
                        <i class="bi bi-x-lg"></i> Remover Filtros
                    </button>
                    @endif
                </div>

            </div>
        </div> <!-- Fim procurar, filtrar, ordenar, etc. -->

        <x-listGroupHeader>
            <div class="d-none d-lg-block col-1">Contrato</div>
            <div class="d-none d-lg-block col-9">Sumário</div>
            <div class="d-none d-lg-block col-2 text-center">Estado</div>
            <div class="d-block d-lg-none col">Lote</div>
        </x-listGroupHeader>

        @if(count($lotes) == 0)
        <x-listGroupItem href=''>Não foram encontrados Lotes</x-listGroupItem>
        @endif

        @foreach ($lotes as $l)
        <x-listGroupItem href='/lotes/{{ $l->id }}'>
            <div class="col col-lg-1 text-secondary fw-bold">
                {{ $l->contrato_id }}-{{ $l->contrato_index }}
            </div>
            <div class="col">
                {{ $l->main_lang_name }}
            </div>
            <div class="col col-lg-2 mt-2 mt-lg-0 text-start text-lg-center">
                <span class="rounded-pill py-2 px-4
          {{ $l->status == 'disponível' ? 'text-bg-success' : '' }}
          {{ $l->status == 'colocado' ? 'text-bg-warning' : '' }}
          {{ $l->status == 'fechado' ? 'bg-secondary-subtle' : '' }}
          {{ $l->status == 'devolvido' ? 'bg-secondary-subtle' : '' }}
          {{ $l->status == 'pago' ? 'bg-warning-subtle' : '' }}
          {{ $l->status == 'não pago' ? 'text-bg-danger' : '' }}
        ">
                    {{ ucwords($l->status) }}
                </span>
            </div>
        </x-listGroupItem>
        @endforeach

    </x-listGroup>


    <div class="container my-5">{!! $lotes->withQueryString()->links('pagination::bootstrap-5') !!}</div>

</x-layout>

<!-- OffCanvas Filtro por Códigos -->
@include('lotes.partials.filtroCodigos')

<!-- Modal Ajuda -->
<x-modalHelp class="modal-dialog-scrollable" title="Ajuda: Lotes" id="lotesHelp">
    @include('manual.partials.lotesManual')
</x-modalHelp>

<!-- HOTKEYS -->
@include('lotes.partials.hotkeys')

<!-- LOTES JAVASCRIPT -->
<script src="{{ asset('js/lotes.js') }}"></script>
