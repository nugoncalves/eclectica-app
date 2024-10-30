<x-layout>
  <form method="POST" action="/verbetes">
    @csrf

    {{-- Title Menu--}}
    <x-mainHeader baseRoute={{$baseRoute}} query={{$query}} title={{$title}}>
      <li class="nav-item">
        <a href="/verbetes{{$query}}" type="submit" class="titleMenuButton btn btn-outline-secondary rounded-pill mx-2 px-4">Cancelar</a>
      </li>
      <li class="nav-item">
        <button type="submit" class="titleMenuButton btn btn-primary rounded-pill px-4">Gravar</button>
      </li>
      <li class="nav-item">
        <a href="" data-bs-toggle="modal" data-bs-target="#verbetesHelp" class="titleMenuButton btn btn-outline-secondary rounded-circle ms-2"><i class="bi bi-question-lg"></i></a>
      </li>
    </x-mainHeader>

    @include('verbetes.partials.createForm')

  </form>
</x-layout>

<!-- Modal Ajuda -->
<x-modalHelp class="modal-dialog-scrollable" title="Ajuda: Lotes" id="verbetesHelp">
  @include('manual.partials.verbetesManual')
</x-modalHelp>

<!-- VERBETES JAVASCRIPT -->
<script src="{{asset('js/verbetes.js')}}"></script>