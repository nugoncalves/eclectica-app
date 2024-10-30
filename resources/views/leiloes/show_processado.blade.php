<x-layout baseRoute="{{ $baseRoute }}">

  <!-- TITLE MENU -->
  <x-mainHeader baseRoute="{{ $baseRoute }}" query="{{ $query }}" title="{{ $title }}">
    <li class="nav-item">
      <a href="/leiloes{{ $query }}" type="submit"
        class="px-4 mx-2 titleMenuButton btn btn-outline-secondary rounded-pill">Voltar</a>
    </li>
    <li class="nav-item">
      <a href="/leiloes/retirados/{{ $leilao->id }}" target="_blank" type="submit" class="titleMenuButton btn btn-outline-secondary rounded-pill mx-2 px-4">Retirados</a>
    </li>
    <li class="nav-item">
      <button type="submit" form="main_form"
        class="titleMenuButton btn btn-primary rounded-pill px-4">Gravar</button>
    </li>
    <li class="nav-item">
      <a href="" data-bs-toggle="modal" data-bs-target="#leiloesHelp"
        class="titleMenuButton btn btn-outline-secondary rounded-circle ms-2"><i
          class="bi bi-question-lg"></i></a>
    </li>
  </x-mainHeader>

  <!-- FLASH MESSAGE -->
  <x-flashMessage />

  <!-- CONTENT -->
  <div class="container mt-3">
    <div class="row justify-content-center">
      <!-- MAIN CONTENT -->
      <div class="col col-xl-8">
        @include('leiloes.partials.mainForm')
        @include('leiloes.partials.lotes_de_leilao')
      </div>

      <!-- Other Info (Left Col) -->
      <div class="col-12 col-xl-4">
        <!-- Lista de Fornecedores -->
        @include('leiloes.partials.listSellers')
        <!-- Lista de Compradores  -->
        @include('leiloes.partials.listBuyers')
      </div>
    </div>

    <!-- Apresentação de Resultados -->
    <div class="mb-4 row"> <!-- Números Globais -->
      <!-- Relação Lotes Vendidos/Retirados -->
      <div class="col-12 col-lg-4 mb-3 mb-lg-0">
        <div class="rounded shadow bg-success-subtle d-flex justify-content-between align-items-center">
          <div class="p-4">
            <div class="p-0 m-0 h5 fw-bold text-success-emphasis"><i class="fa-solid fa-book me-1"></i>
              Lotes Vendidos
            </div>
          </div>
          <div class="p-4">
            <div class="fw-bold h3 text-success-emphasis">
              {{ $totais['percentagem_vendidos'] }}
            </div>
            <div class="p-0 m-0 text-secondary-secondary-emphasis p-xtra-small text-end">
              {{ $totais['lotes_vendidos'] }} de {{ $totais['lotes'] }}
            </div>
          </div>
        </div>
      </div>
      <!-- Valor das Vendas e Comissões -->
      <div class="col12 col-lg-4 mb-3 mb-lg-0">
        <div class="rounded shadow bg-primary-subtle d-flex justify-content-between align-items-center">
          <div class="p-4">
            <div class="p-0 m-0 h5 fw-bold text-primary-emphasis"><i class="fa-solid fa-cart-shopping"></i>
              Vendas</div>
          </div>
          <div class="p-4">
            <div class="fw-bold text-primary-emphasis h3">{{ $totais['martelo'] }}</div>
            <div class="p-0 m-0 text-secondary-emphasis p-xtra-small text-end">Comissões:
              {{ $totais['total_comissoes'] }}
            </div>
          </div>
        </div>
      </div>
      <!-- Número de Licitantes e Compradores -->
      <div class="col-12 col-lg-4">
        <div class="rounded shadow bg-warning-subtle d-flex justify-content-between align-items-center">
          <div class="p-4">
            <div class="p-0 m-0 h5 fw-bold text-warning-emphasis"><i class="fa-solid fa-gavel"></i>
              Licitantes</div>
          </div>
          <div class="p-4">
            <div class="fw-bold text-warning-emphasis h3 text-end">{{ $totais['numero_licitantes'] }}
            </div>
            <div class="p-0 m-0 text-secondary-emphasis p-xtra-small text-end">Compradores:
              {{ $totais['numero_compradores'] }}
            </div>
          </div>
        </div>
      </div>
    </div> <!-- Fim de Números Globais -->

    <div class="mb-4 row"> <!-- Resumo Geral de Vendas -->
      <div class="col">
        <div class="rounded shadow" style="background-color: var(--bs-tertiary-bg);">
          <div class="p-4">
            <div class="p-0 mb-3 h5 fw-bold text-success-emphasis">
              <i class="fa-solid fa-chart-simple"></i> Resumo Geral de Vendas
            </div>
            <div class="px-2 px-lg-5">
              <table class="table table-sm table-striped p-xtra-small">
                <thead>
                  <tr>
                    <th scope="col"></th>
                    <th class="text-center" scope="col">Pre Bids</th>
                    <th class="text-center" scope="col">Live Bids</th>
                    <th class="text-center" scope="col">Totais</th>
                  </tr>
                </thead>
                <tbody class="table-group-divider">
                  <tr>
                    <th scope="row">Licitantes</th>
                    <td class="text-center">{{ $totais['numero_licitantes_ordens_de_compra'] }}
                    </td>
                    <td class="text-center">{{ $totais['numero_licitantes_live'] }}</td>
                    <td class="text-center">{{ $totais['numero_licitantes'] }}</td>
                  </tr>
                  <tr>
                    <th scope="row">Compradores</th>
                    <td class="text-center">{{ $totais['numero_compradores_ordens_de_compra'] }}
                    </td>
                    <td class="text-center">{{ $totais['numero_compradores_live'] }}</td>
                    <td class="text-center">{{ $totais['numero_compradores'] }}</td>
                  </tr>
                  <tr>
                    <th scope="row">Licitações</th>
                    <td class="text-center">{{ $totais['ordens_compra'] }}</td>
                    <td class="text-center">{{ $totais['licitacoes_live'] }}</td>
                    <td class="text-center">{{ $totais['licitacoes'] }}</td>
                  </tr>
                  <tr>
                    <th scope="row">Compras</th>
                    <td class="text-center">{{ $totais['ordens_compra_win'] }}
                      ({{ $totais['ordens_compra_win_percentagem'] }})</td>
                    <td class="text-center">{{ $totais['licitacoes_live_win'] }}
                      ({{ $totais['licitacoes_live_win_percentagem'] }})</td>
                    <td class="text-center">{{ $totais['lotes_vendidos'] }}
                      ({{ $totais['percentagem_vendidos'] }})</td>
                  </tr>
                  <tr>
                    <th scope="row">Valor</th>
                    <td class="text-center">{{ $totais['martelo_ordens_compra'] }}
                      ({{ $totais['martelo_ordens_compra_percentagem'] }})</td>
                    <td class="text-center">{{ $totais['martelo_live'] }}
                      ({{ $totais['martelo_live_percentagem'] }})</td>
                    <td class="text-center">{{ $totais['martelo'] }}
                      ({{ $totais['estimativas_vendidos'] }})</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div> <!-- Fim de Resumo Geral de Vendas -->
  </div> <!-- Fim DE CONTENT -->

</x-layout>

<!-- OffCanvas Lotes -->
<x-offcanvas class="offcanvas-size-xxl" title='Lote' name='lotes'>
  <div class="d-flex justify-content-center htmx-indicator" id="colocacoes_indicator"><img
      src="{{ asset('assets/svg-loaders/stampede.gif') }}" height="20px"></div>
</x-offcanvas>

<!-- Modal: Importação de Resultados -->
@include('leiloes.modal.import')

<!-- OffCanvas: Cliente OverView -->
<x-offcanvas class="offcanvas-size-xl" title='Cliente' name='cliente'>
  @include('partials.clienteOffCanvasPlaceholder')
</x-offcanvas>

<!-- Modal Ajuda -->
<x-modalHelp class="modal-dialog-scrollable" title="Ajuda: Leilões" id="leiloesHelp">
  @include('manual.partials.leiloesManual')
</x-modalHelp>
