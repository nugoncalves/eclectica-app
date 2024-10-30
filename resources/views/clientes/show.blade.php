<x-layout baseRoute={{$baseRoute}}>

  <form method="POST" action="/clientes/{{$cliente->id}}">
    @csrf
    @method('PUT')

    <!-- TITLE MENU -->
    <x-mainHeader baseRoute={{$baseRoute}} query={{$query}} title={{$title}}>
      @if($cliente->seller === 'true')
      <li class="nav-item">
        <a class="titleMenuButton btn btn-outline-secondary rounded-pill ms-2 px-4" href="/fornecedores/{{$cliente->id}}">
          Fornecedor</a>
      </li>
      @endif
      <li class="nav-item">
        <a class="titleMenuButton btn btn-outline-secondary rounded-pill ms-2 px-4" href="/clientes/{{$cliente->id}}/shippingLabel" target="_blank">
          Imprimir Etiqueta</a>
      </li>
      <li class="nav-item">
        <a href="/clientes{{$query}}" type="submit" class="titleMenuButton btn btn-outline-secondary rounded-pill ms-2 px-4">Voltar</a>
      </li>
      <li class="nav-item">
        <button type="submit" class="titleMenuButton btn btn-primary rounded-pill ms-2 px-4">Gravar</button>
      </li>
      <li class="nav-item">
        <a href="" data-bs-toggle="modal" data-bs-target="#clientesHelp" class="titleMenuButton btn btn-outline-secondary rounded-circle ms-2"><i class="bi bi-question-lg"></i></a>
      </li>
    </x-mainHeader>

    <!-- FLASH MESSAGE -->
    <x-flashMessage />

    <!-- CONTEÚDOS -->
    <div class="container mt-3">
      <div class="row justify-content-center">
        <!-- Main Form (Left Main Col) -->
        <div class="col-12 col-xl-8 mb-4">
          <x-formCard>
            <div class="row m-0 p-0">
              <!-- {{-- Campos Escondidos para Passar no POST e gravar dados --}} -->
              <input type="hidden" class="form-control" id="id" name="id" placeholder="" value="{{$cliente->id}}" />
              <!-- MAIN DATA -->
              @include('clientes.partials.mainData')
              @include('clientes.partials.mainAddress')
            </div>
          </x-formCard>
          <!-- SHIPPING ADDRESS -->
          @include('clientes.partials.shippingAddress')
        </div>

        <!-- Other Info (Left Col) -->
        <div class="col-12 col-xl-4">
          <x-formCard class="mb-4">

            <x-infoCard.title title="Info" />

            <x-infoCard.infoData name="Data de criação" :value='$cliente->added' />
            <x-infoCard.infoData name="Estado" :value='$cliente->status' />
            <x-infoCard.infoData name="Origem" :value='$cliente->origin' />
            <x-infoCard.infoData name="Soma Compras" :value='$total_compras' />
            <x-infoCard.infoData name="N.º Lotes Comprados" :value='$numero_lotes_comprados' />

          </x-formCard>

          {{-- Estatísticas Gerais de Clientes --}}
          @if(count($compras))
          <x-formCard>

            <x-infoCard.title title="Lotes Comprados" />

            <div class="overflow-auto mb-4" style="max-height: 400px;">

              <x-infoCard.infoTable>
                <x-slot:tableHeader>
                  <th class="p-xtra-small text-center">Leilão</th>
                  <th class="p-xtra-small text-center">Lote</th>
                  <th class="p-xtra-small text-end">Base</th>
                  <th class="p-xtra-small text-end">Martelo</th>
                </x-slot:tableHeader>
                <x-slot:tableBody>
                  @foreach ($compras as $compra)
                  <tr style="transform: rotate(0);">
                    <td class="p-xtra-small text-center">{{ $compra->leilao_id }}</td>
                    <td class="p-xtra-small text-center">{{ $compra->leilao_lote }}</td>
                    <td class="p-xtra-small text-end">{{ $compra->start_price }} €</td>
                    <td class="p-xtra-small text-end">{{ $compra->price }} €</td>
                    <td>
                      <a href="javascript:void(0)" class="stretched-link text-secondary" data-bs-toggle="offcanvas" data-bs-target="#offcanvas_colocacoes" aria-controls="offcanvas_colocacoes" hx-get="/historico/{{ $compra->id }}" hx-target="#htmx_colocacoes" hx-sync="this:replace" hx-swap="innerHTML"></a>
                    </td>
                  </tr>
                  @endforeach
                </x-slot:tableBody>
              </x-infoCard.infoTable>
            </div>
          </x-formCard>
          @endif
        </div>
      </div>
      <div class="row my-3"></div>
    </div>
  </form>
</x-layout>


<!-- OFF CANVAS ESTATÍSTICAS [NOT IN USE YET] -->
<x-offcanvas class="offcanvas-size-xxl" title="Estatísticas" name="clientes_estatisticas">

  <x-formCard>

    <x-infoCard.title title="Lotes Comprados" />

    <div class="overflow-auto mb-4" style="max-height: 400px;">
      <x-infoCard.infoTable>
        <x-slot:tableHeader>
          <th class="p-xtra-small text-center">Leilão</th>
          <!-- <th class="p-xtra-small text-center">Data</th> -->
          <th class="p-xtra-small text-center">Lote</th>
          <th class="p-xtra-small text-end">Base</th>
          <th class="p-xtra-small text-end">Martelo</th>
        </x-slot:tableHeader>
        <x-slot:tableBody>
          @foreach ($compras as $compra)
          <tr style="transform: rotate(0);">
            <td class="p-xtra-small text-center">{{ $compra->leilao_id }}</td>
            <!-- <td class="p-xtra-small text-center">{{ $compra->leilao->data_fim }}</td> -->
            <td class="p-xtra-small text-center">{{ $compra->leilao_lote }}</td>
            <td class="p-xtra-small text-end">{{ $compra->start_price }} €</td>
            <td class="p-xtra-small text-end">{{ $compra->price }} €</td>
            <td>
              <a href="javascript:void(0)" class="stretched-link text-secondary" data-bs-toggle="offcanvas" data-bs-target="#offcanvas_colocacoes" aria-controls="offcanvas_colocacoes" hx-get="/historico/{{ $compra->id }}" hx-target="#htmx_colocacoes" hx-sync="this:replace" hx-swap="innerHTML">
              </a>
            </td>
          </tr>
          @endforeach
        </x-slot:tableBody>
      </x-infoCard.infoTable>
    </div>
  </x-formCard>
</x-offcanvas>

<!-- Modal Ajuda -->
<x-modalHelp class="modal-dialog-scrollable" title="Ajuda: Clientes" id="clientesHelp">
  @include('manual.partials.clientesManual')
</x-modalHelp>