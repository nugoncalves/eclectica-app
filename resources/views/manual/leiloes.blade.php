<x-layoutManual baseRoute={{$baseRoute}}>

  <x-mainHeader baseRoute='' query='' title='Manual do Utilizador: Leilões'>

    <li class="nav-item dropdown">
      <button class="titleMenuButton btn btn-primary rounded-pill dropdown-toggle ms-2 px-4" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        Índice
      </button>
      <ul class="dropdown-menu dropdown-menu-end">
        <li>
          <a class="dropdown-item fw-bold" href="#leiloes">O Módulo de Leilões</a>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>
        <li>
          <a class="dropdown-item fw-bold" href="#pesquisa">Pesquisa</a>
        </li>
        <li>
          <a class="dropdown-item fw-bold" href="#novo">Novo Leilão</a>
        </li>
        <li>
          <a class="dropdown-item fw-bold" href="#estados">Estados de Leilão</a>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>
        <li>
          <a class="dropdown-item fw-bold" href="#nao-processado">Leilão Não Processado</a>
        </li>
        <li class="ps-3">
          <a class="dropdown-item text-secondary" href="#exportar">Exportar</a>
        </li>
        <li class="ps-3">
          <a class="dropdown-item text-secondary" href="#importar">Importar</a>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>
        <li>
          <a class="dropdown-item fw-bold" href="#processado">Leilão Processado</a>
        </li>
      </ul>
    </li>
  </x-mainHeader>

  @include('manual.partials.leiloesManual')


</x-layoutManual>