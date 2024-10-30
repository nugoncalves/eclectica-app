<x-layout baseRoute={{$baseRoute}}>

  {{-- Title Menu--}}
  <x-mainHeader baseRoute={{$baseRoute}} query={{$query}} title={{$title}}>
    <li class="nav-item">
      <a href="/verbetes/create" class="titleMenuButton btn btn-primary rounded-pill mx-1 px-4">Novo</a>
    </li>
    <li class="nav-item">
      <a href="" data-bs-toggle="modal" data-bs-target="#verbetesHelp" class="titleMenuButton btn btn-outline-secondary rounded-circle ms-2"><i class="bi bi-question-lg"></i></a>
    </li>
  </x-mainHeader>

  {{-- FLASH MESSAGE --}}
  <x-flashMessage />

  <x-listGroup>

    <x-search baseRoute={{$baseRoute}} />

    <x-listGroupHeader>
      <div class="d-none d-lg-block col-2">Num.</div>
      <div class="d-none d-lg-block col-10">Sumário</div>
      <div class="d-block d-lg-none col-1">Sumário</div>
    </x-listGroupHeader>

    @if(count($verbetes) == 0)
    <x-listGroupItem href=''>Não foram encontrados Verbetes</x-listGroupItem>
    @endif

    @foreach ($verbetes as $v)
    <x-listGroupItem href='/verbetes/{{$v->id}}'>
      <div class="col col-lg-1 text-secondary fw-bold">{{$v->id}}</div>
      <div class="col col-lg-10">{{$v->name}}</div>
    </x-listGroupItem>
    @endforeach


  </x-listGroup>

  <div class="container my-5">{!! $verbetes->withQueryString()->links('pagination::bootstrap-5') !!}</div>

</x-layout>

<!-- Modal Ajuda -->
<x-modalHelp class="modal-dialog-scrollable" title="Ajuda: Lotes" id="verbetesHelp">
  @include('manual.partials.verbetesManual')
</x-modalHelp>

<!-- VERBETES JAVASCRIPT -->
<script src="{{asset('js/verbetes.js')}}"></script>