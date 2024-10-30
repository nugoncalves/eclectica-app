<x-layoutManual baseRoute={{$baseRoute}}>

  <x-mainHeader baseRoute='' query='' title='Manual do Utilizador: Lotes'>

    <li class="nav-item dropdown">
      <button class="titleMenuButton btn btn-primary rounded-pill dropdown-toggle ms-2 px-4" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        Índice
      </button>
      <ul class="dropdown-menu dropdown-menu-end">
        <li>
          <a class="dropdown-item fw-bold" href="#lotes">O Módulo de Lotes</a>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>
        <li>
          <a class="dropdown-item fw-bold" href="#pesquisa">Pesquisa</a>
        </li>
        <li>
          <a class="dropdown-item fw-bold" href="#novo">Novo Lote</a>
        </li>
        <li>
          <a class="dropdown-item fw-bold" href="#formulario">Formulário</a>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>
        <li>
          <a class="dropdown-item fw-bold" href="#estado">Estado dos Lotes</a>
        </li>
        <li>
          <a class="dropdown-item fw-bold" href="#verbetes">Verbetes</a>
        </li>
        <li>
          <a class="dropdown-item fw-bold" href="#colocacoes">Colocações</a>
        </li>
        <li>
          <a class="dropdown-item fw-bold" href="#etiqueta">Imprimir Etiqueta</a>
        </li>
        <li>
          <a class="dropdown-item fw-bold" href="#ficha">Imprimir Ficha Bibliográfica</a>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>
        <li>
          <a class="dropdown-item fw-bold" href="#contrato">Editar Dados do Contrato</a>
        </li>
        <li>
          <a class="dropdown-item fw-bold" href="#apagar">Apagar</a>
        </li>
      </ul>
    </li>
  </x-mainHeader>

  @include('manual.partials.lotesManual')
</x-layoutManual>