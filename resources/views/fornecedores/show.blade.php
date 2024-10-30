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
        <a href="/fornecedores/exportLotes/{{$fornecedor->id}}" target="_blank" class="titleMenuButton btn btn-primary rounded-pill ms-2 px-4">Exportar</a>
      </li>
      <li class="nav-item">
        <a href="" data-bs-toggle="modal" data-bs-target="#clientesHelp" class="titleMenuButton btn btn-outline-secondary rounded-circle ms-2"><i class="bi bi-question-lg"></i></a>
      </li>
    </x-mainHeader>

    <!-- FLASH MESSAGE -->
    <x-flashMessage />

    <!-- CONTEÚDOS -->
    <div class="container mt-3">
      <div class="row justify-content-center align-items-stretch">
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
        <div class="col-12 col-xl-4 align-items-stretch">
          {{-- Estatísticas Gerais --}}
          <x-formCard class="mb-4">
            <x-infoCard.title title="Informações Gerais" />

            <x-infoCard.infoData name="Email" value="{{$fornecedor->email}}" />
            <x-infoCard.infoData name="Telemóvel" value="{{$fornecedor->phone}}" />
            <x-infoCard.infoData name="Iban" value="{{$fornecedor->iban}}" />
            <x-infoCard.infoData name="Contribuinte" value="{{$fornecedor->nif}}" />
            <!-- <x-infoCard.infoData name="Martelo" value="" /> -->
            <!-- <x-infoCard.infoData name="Comissões" value="" /> -->

          </x-formCard>

        </div>

      </div>
    </div>
    <div class="container">

      <div class="row">
        <div class="col-12 mt-3" id="fornecedores_content" hx-get="/fornecedores/lotes/{{$fornecedor->id}}" hx-trigger="load" hx-target="#fornecedores_content" hx-swap="innerHTML">
          <a href="/fornecedores/lotes/{{$fornecedor->id}}" target="_blank">Teste</a>
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