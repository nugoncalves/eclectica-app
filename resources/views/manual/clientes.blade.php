<x-layoutManual baseRoute={{$baseRoute}}>
  <!-- TITLE AND INDICE -->
  <x-mainHeader baseRoute='' query='' title='Manual do Utilizador: Clientes'>

    <li class="nav-item dropdown">
      <button class="titleMenuButton btn btn-primary rounded-pill dropdown-toggle ms-2 px-4" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        Índice
      </button>
      <ul class="dropdown-menu dropdown-menu-end">
        <li>
          <a class="dropdown-item fw-bold" href="#clientes">O Módulo de Clientes</a>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>
        <li>
          <a class="dropdown-item fw-bold" href="#lista">Lista de Clientes</a>
        </li>
        <li class="ps-3">
          <a class="dropdown-item text-secondary" href="#novo">Novo Cliente</a>
        </li>
        <li class="ps-3">
          <a class="dropdown-item text-secondary" href="#envio-generico">Envio Genérico</a>
        </li>
        <li class="ps-3">
          <a class="dropdown-item text-secondary" href="#importar">Importar</a>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>
        <li>
          <a class="dropdown-item fw-bold" href="#formulario">Formulário</a>
        </li>

      </ul>
    </li>

  </x-mainHeader>


  @include('manual.partials.clientesManual')

</x-layoutManual>