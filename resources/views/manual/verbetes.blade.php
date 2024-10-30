<x-layoutManual baseRoute={{$baseRoute}}>

  <x-mainHeader baseRoute='' query='' title='Manual do Utilizador: Verbetes'>

    <li class="nav-item dropdown">
      <button class="titleMenuButton btn btn-primary rounded-pill dropdown-toggle ms-2 px-4" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        Índice
      </button>
      <ul class="dropdown-menu dropdown-menu-end">
        <li>
          <a class="dropdown-item fw-bold" href="#verbetes">O Módulo de Verbetes</a>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>
        <li>
          <a class="dropdown-item fw-bold" href="#pesquisa">Pesquisa</a>
        </li>
        <li>
          <a class="dropdown-item fw-bold" href="#novo">Novo Verbete</a>
        </li>
        <li>
          <a class="dropdown-item fw-bold" href="#formulario">Formulário</a>
        </li>
        <li>
          <a class="dropdown-item fw-bold" href="#imprimir">Imprimir</a>
        </li>

        <li>
          <a class="dropdown-item fw-bold" href="#apagar">Apagar</a>
        </li>
      </ul>
    </li>
  </x-mainHeader>

  @include('manual.partials.verbetesManual')
</x-layoutManual>