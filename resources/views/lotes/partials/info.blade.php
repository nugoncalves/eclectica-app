<!-- INFORMAÇÕES GERAIS SOBRE O ITEM CONTRATO -->

<x-formCard class="my-3">

  <x-infoCard.title title="Informações Gerais" />

  <x-infoCard.infoData name="Referência" :value='$lote->id' />
  <x-infoCard.infoData name="Data de Entrada" :value='$lote->date_entry' />
  <x-infoCard.infoData name="Data de Saída" :value='$lote->date_out' />
  <div class='d-flex justify-content-between align-items-center pt-2 px-2'>
    <span class="d-block small text-secondary">Fornecedor</span>
    <span class="d-block small text-end">{{ $lote->seller_reference }} <span class="fw-bold">{{ $fornecedor->id}}</span></span>
  </div>
  <a href="javascript:void(0)" class="border-bottom p-xtra-small text-dark text-decoration-none text-end pb-2" data-bs-toggle="offcanvas" data-bs-target="#offcanvas_cliente" aria-controls="offcanvas_cliente" hx-get="/clientes/offCanvasView/{{ $fornecedor->id }}" hx-target="#htmx_cliente" hx-sync="this:replace" hx-swap="innerHTML">
    {{$fornecedor->all_name ?? ''}}
  </a>
  <div class='d-flex justify-content-between align-items-center pt-2 px-2'>
    <span class="d-block small text-secondary">Comissão</span>
    <span class="d-block small text-end">{{ ($contrato->commission_1000) ? 'Progressiva' : $contrato->commission_300 }}</span>
  </div>
  @if($contrato->commission_1000)
  <div class='d-flex justify-content-between align-items-center px-2'>
    <span class="d-block small text-end">{{$contrato->commission_300}}</span>
    <span class="d-block small text-end">{{$contrato->commission_1000}}</span>
    <span class="d-block small text-end">{{$contrato->commission_3000}}</span>
    <span class="d-block small text-end">{{$contrato->commission_more_3000}}</span>
  </div>
  <div class='d-flex justify-content-between align-items-center border-bottom px-2'>
    <span class="d-block p-xtra-small text-secondary">Até 300€</span>
    <span class="d-block p-xtra-small text-secondary">de 301 a 1.000€</span>
    <span class="d-block p-xtra-small text-secondary">de 1.001 a 3.000€</span>
    <span class="d-block p-xtra-small text-secondary">mais de3000€</span>
  </div>
  @endif

</x-formCard>

@if (!empty($ultimaColocacao))
<x-formCard class="mb-3">
  <x-infoCard.title title="Resultados" />
  <x-infoCard.infoData name="Martelo" value='{{$ultimaColocacao->price}} €' />
  <x-infoCard.infoData name="Comissão Cliente" value='{{$ultimaColocacao->commission_buyer}} €' />
  <x-infoCard.infoData name="Comissão Fornecedor" value='{{$ultimaColocacao->commission_seller}} €' />
</x-formCard>
@endif