<x-layout baseRoute="{{ $baseRoute }}">

    {{-- Title Menu --}}
    <x-mainHeader baseRoute="{{ $baseRoute }}" query="{{ $query }}" title="{{ $title }}">
        <li class="nav-item">
            <a href="" class="titleMenuButton btn btn-primary rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#novoLeilao">Novo</a>
        </li>
        <li class="nav-item">
            <a href="" data-bs-toggle="modal" data-bs-target="#leiloesHelp" class="titleMenuButton btn btn-outline-secondary rounded-circle ms-2"><i class="bi bi-question-lg"></i></a>
        </li>
    </x-mainHeader>


    {{-- FLASH MESSAGE --}}
    <x-flashMessage />

    <x-listGroup>

        <x-search baseRoute="{{ $baseRoute }}" />

        <x-listGroupHeader>
            <div class="col col-lg-1">Leilão</div>
            <div class="d-none d-lg-block col-7">Título</div>
            <div class="d-none d-lg-block col-2 text-center ">Estado</div>
            <div class="d-none d-lg-block col-2 text-center ">Data</div>
        </x-listGroupHeader>

        @if(count($leiloes) == 0)
        <x-listGroupItem href=''>Não foram encontrados Leilões</x-listGroupItem>
        @endif


        @foreach ($leiloes as $leilao)
        <x-listGroupItem href="/leiloes/{{ $leilao->id }}">
            <div class="col col-lg-1 text-secondary fw-bold">
                {{ $leilao->id }}
            </div>
            <div class="col">
                {{ $leilao->name }}
            </div>

            <div class="col col-lg-4 d-flex flex-row text-center align-items-center justify-content-between justify-content-lg-center mt-1 m-lg-0 p-0">
                <div class="col col-lg-6 rounded-pill px-3 py-1
            {{ $leilao->status == 'espera' ? 'bg-warning-subtle' : '' }}
            {{ $leilao->status == 'decorrer' ? 'bg-danger-subtle' : '' }}
            {{ $leilao->status == 'terminado' ? 'bg-primary-subtle' : '' }}
            {{ $leilao->status == 'processado' ? 'bg-success-subtle' : '' }}
          ">
                    {{ ucwords($leilao->status) }}
                    </span>
                </div>
                <div class="col col-lg-6 text-lg-center text-end">
                    {{ $leilao->end_date }}
                </div>
            </div>

        </x-listGroupItem>
        @endforeach

    </x-listGroup>

    <div class="container my-5">{!! $leiloes->withQueryString()->links('pagination::bootstrap-5') !!}</div>

</x-layout>

@include('leiloes.modal.create')

<!-- Modal Ajuda -->
<x-modalHelp class="modal-dialog-scrollable" title="Ajuda: Leilões" id="leiloesHelp">
    @include('manual.partials.leiloesManual')
</x-modalHelp>