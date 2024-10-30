<x-layout baseRoute="{{ $baseRoute }}">
    <x-mainHeader baseRoute="{{ $baseRoute }}" query="{{ $query }}" title="{{ $title }}">
        <li class="nav-item">
            <a href="/contratos/create" class="titleMenuButton btn btn-primary rounded-pill m-1 px-4">Novo</a>
        </li>
    </x-mainHeader>

    {{-- Flash Message --}}
    <x-flashMessage class="alert-success" />

    <x-listGroup>
        <x-search baseRoute="{{ $baseRoute }}" />

        <x-listGroupHeader>

            <div class="d-none d-lg-block col-1">#</div>
            <div class="d-none d-lg-block col-2">Data</div>
            <div class="d-none d-lg-block col-7">Fornecedor</div>
            <div class="d-block d-lg-none col-12">Contrato</div>

        </x-listGroupHeader>

        @if(count($contratos) == 0)
        <x-listGroupItem href=''>Não foram encontrados Contratos</x-listGroupItem>
        @endif

        @foreach ($contratos as $c)
        <x-listGroupItem href="/contratos/{{ $c->id }}">
            <div class="col col-lg-1 text-secondary fw-bold">
                {{ $c->id }}
            </div>
            <div class="col col-lg-2">
                {{ $c->date }}
            </div>
            <div class="col col-lg-7 d-flex flex-column flex-sm-row flex-lg-column text-start justify-content-between">
                <div class="col">
                    {{ $c->cliente->full_name ?? '' }}
                </div>
                <div class="col p-small text-secondary">
                    {{ $c->seller_reference }} | {{ $c->seller_id }}
                </div>
            </div>

        </x-listGroupItem>
        @endforeach

    </x-listGroup>
    <div class="container my-5">{!! $contratos->withQueryString()->links('pagination::bootstrap-5') !!}</div>
</x-layout>