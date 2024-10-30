<x-layout baseRoute={{$baseRoute}}>

  <form method="POST" action="/clientes/{{$fornecedor->id}}">
    @csrf
    @method('PUT')

    <!-- TITLE MENU -->
    <x-mainHeader baseRoute={{$baseRoute}} query={{$query}} title={{$title}}>
      <li class="nav-item">
        <a href="/fornecedores{{$query}}" type="submit" class="titleMenuButton btn btn-outline-secondary rounded-pill ms-2 px-4">Voltar</a>
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
              <input type="hidden" class="form-control" id="id" name="id" placeholder="" value="{{$fornecedor->id}}" />
              <!-- MAIN DATA -->
              @include('fornecedores.partials.mainData')
            </div>
          </x-formCard>

        </div>

        <!-- Other Info (Left Col) -->
        <div class="col-12 col-xl-4">
          {{-- Estatísticas Gerais --}}
          <x-formCard class="mb-4">
            <x-infoCard.title title="Informações Gerais" />

            <x-infoCard.infoData name="Lotes" value="{{$items_contrato->count()}}" />
            <x-infoCard.infoData name="Colocações" value="{{$colocacoes->count()}}" />
            <x-infoCard.infoData name="Não Colocados" value="" />
            <x-infoCard.infoData name="Disponíveis" value="{{$disponiveis}}" />
            <x-infoCard.infoData name="Martelo" value="{{$total_martelo}}" />
            <x-infoCard.infoData name="Comissões" value="{{$total_comissao}}" />

          </x-formCard>

        </div>

      </div>
      <div class="col-12 mb-4">

        <ul class="nav nav-tabs mt-3 mx-3 justify-content-end" id="myTab" role="tablist">
          <li class="nav-item btn-primary" role="presentation">
            <button class="nav-link active" id="contratos-tab" data-bs-toggle="tab" data-bs-target="#contratos-tab-pane" type="button" role="tab" aria-controls="contratos-tab-pane" aria-selected="true">Contratos</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="leiloes-tab" data-bs-toggle="tab" data-bs-target="#leiloes-tab-pane" type="button" role="tab" aria-controls="leiloes-tab-pane" aria-selected="false">Leilões</button>
          </li>
          <!-- <li class="nav-item" role="presentation">
              <button class="nav-link" id="colocacoes-tab" data-bs-toggle="tab" data-bs-target="#colocacoes-tab-pane" type="button" role="tab" aria-controls="colocacoes-tab-pane" aria-selected="false">Colocações</button>
            </li> -->
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="lotes-tab" data-bs-toggle="tab" data-bs-target="#lotes-tab-pane" type="button" role="tab" aria-controls="lotes-tab-pane" aria-selected="false">Lotes</button>
          </li>
        </ul>
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="contratos-tab-pane" role="tabpanel" aria-labelledby="contratos-tab" tabindex="0">
            @include('fornecedores.partials.contratos')
          </div>
          <div class="tab-pane fade" id="leiloes-tab-pane" role="tabpanel" aria-labelledby="leiloes-tab" tabindex="0">
            @include('fornecedores.partials.leiloes')
          </div>
          <div class="tab-pane fade" id="lotes-tab-pane" role="tabpanel" aria-labelledby="lotes-tab" tabindex="0">
            @include('fornecedores.partials.lotes')
          </div>
        </div>
      </div>
      <div class="row my-3"></div>
    </div>
  </form>
</x-layout>




<!-- Modal Ajuda -->
<x-modalHelp class="modal-dialog-scrollable" title="Ajuda: Clientes" id="clientesHelp">
  @include('manual.partials.clientesManual')
</x-modalHelp>