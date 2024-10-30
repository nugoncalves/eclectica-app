<x-listGroup>

  <x-listGroupHeader>Sumário</x-listGroupHeader>

  @if(count($verbetes) == 0)
  <div class="list-group-item list-group-item-action px-5 py-4 d-flex justify-content-between align-items-center list-parent">
    Não foram encontrados registos
  </div>
  @endif

  @foreach ($verbetes as $v)
  <a href="javascript:void(0)" class="list-group-item list-group-item-action px-5 py-4 d-flex justify-content-between align-items-center list-parent" hx-get="/verbetes/modal/{{ $v->id }}" hx-target="#verbeteContent" hx-sync="this:replace" hx-swap="innerHTML" hx-indicator="#verbete_indicator" data-bs-toggle="modal" data-bs-target="#verbetes_form">
    <!-- LINK PARA DEBUG   -->
    <!-- <a href="/verbetes/modal/{{ $v->id }}" class="list-group-item list-group-item-action px-5 py-4 d-flex justify-content-between align-items-center list-parent"> -->
    <div class="d-flex flex-row align-items-center">
      <div>{{$v->name}}</div>
    </div>
  </a>
  @endforeach

</x-listGroup>