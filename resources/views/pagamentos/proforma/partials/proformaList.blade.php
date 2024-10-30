<!-- LISTA DE PREVISÃO DE PAGAMENTOS -->
<x-listGroup>

    <x-search baseRoute={{$baseRoute}} />

    <x-listGroupHeader>
        <div class="d-none d-lg-block col-2">Data Pagamento</div>
        <div class="d-none d-lg-block col-7">Descrição</div>
        <div class="d-none d-lg-block text-end col-3">Valor</div>
        <div class="d-block d-lg-none col">Sumário</div>
    </x-listGroupHeader>


    @foreach ($pagamentos as $p)


    <x-listGroupItem href='/pagamentos/proximos/{{$p->seller_id}}/{{$p->leilao_id}}'>
        <div class="col col-lg-2 text-secondary p-small fw-bold">
            {{ $p->due_date }}
        </div>

        <div class="col col-lg-7 d-flex flex-column flex-sm-row flex-lg-column text-start justify-content-between">
            <div class="col col-lg-12 p-xtra-small fw-bold text-secondary text-start">
                {{$p->leilao_id }}: {{$p->name }}
            </div>
            <div class="col col-lg-12 text-start">
                {{$p->seller_reference }}: {{ $p->full_name }}
            </div>
        </div>

        <div
            class="col col-lg-3 d-flex flex-column flex-sm-row flex-lg-column text-end justify-content-between justify-content-lg-end">
            <div class="col col-lg-12 fw-bold">
                {{Number::currency($p->martelo-$p->comissao-($p->comissao * .23), in: 'EUR', locale: 'pt')}}
            </div>
            <div class="col col-lg-12 p-xtra-small">
                [ {{Number::currency($p->martelo, in: 'EUR', locale: 'pt') }} - {{Number::currency($p->comissao,
                in:'EUR', locale: 'pt')}} - {{Number::currency($p->comissao * .23, in: 'EUR', locale: 'pt')}} ]
            </div>
        </div>
    </x-listGroupItem>
    @endforeach


</x-listGroup>

<div class="container my-3">{{ $pagamentos->withQueryString()->links() }}</div>