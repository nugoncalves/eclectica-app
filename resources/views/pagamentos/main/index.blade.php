<x-layout baseRoute={{$baseRoute}}>

    {{-- Title Menu--}}
    <x-mainHeader baseRoute={{$baseRoute}} query={{$query}} title={{$title}} />


    {{-- FLASH MESSAGE --}}
    <x-flashMessage />

    <x-listGroup>

        <x-search baseRoute={{$baseRoute}} />

        <x-listGroupHeader>
            <div class="d-none d-lg-block col-2">#</div>
            <div class="d-none d-lg-block col-4">Leilão</div>
            <div class="d-none d-lg-block col-4">Fornecedor</div>
            <div class="d-none d-lg-block col-2 text-end">Valor</div>
            <div class="d-block d-lg-none col-1">Pagamentos</div>
        </x-listGroupHeader>

        @if(count($pagamentos) == 0)
        <x-listGroupItem href=''>Não foram encontrados Pagamentos</x-listGroupItem>
        @endif

        @foreach ($pagamentos as $p)
        <x-listGroupItem href='/pagamentos/{{$p->id}}'>
            <div class="col col-lg-2 d-flex flex-column flex-sm-row flex-lg-column text-start justify-content-between">
                <div class="col p-small text-secondary">
                    {{ $p->id }}
                </div>
                <div class="col p-small text-secondary">
                    {{ $p->date }}
                </div>
            </div>
            <div class="col col-lg-4 d-flex flex-column flex-sm-row flex-lg-column text-start justify-content-between">
                <div class="col p-small text-secondary">
                    {{ $p->leilao_id }}
                </div>
                <div class="col">
                    {{ $p->leilao->name }}
                </div>
            </div>
            <div class="col col-lg-4 d-flex flex-column flex-sm-row flex-lg-column text-start justify-content-between">
                <div class="col p-small text-secondary">
                    {{ $p->fornecedor->seller_reference }} | {{ $p->seller_id }}
                </div>
                <div class="col">
                    {{ $p->fornecedor->full_name ?? '' }}
                </div>
            </div>
            <div class="col col-lg-2 d-flex flex-column flex-sm-row flex-lg-column text-end justify-content-between">
                <div class="col fw-bold">
                    {{ Number::currency($p->pago, in:'EUR', locale:'pt') }}
                </div>
                <div class="col p-small text-secondary">
                    {{ Number::currency($p->martelo, in:'EUR', locale:'pt') }}
                </div>
            </div>

        </x-listGroupItem>
        @endforeach


    </x-listGroup>

    <div class="container my-5">{!! $pagamentos->withQueryString()->links('pagination::bootstrap-5') !!}</div>

</x-layout>