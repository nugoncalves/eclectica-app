<!-- Modal Apagar Lote -->

@if($lote->items_leilao_count)
<x-modalActionConfirm title='Não é possível apagar o lote!' id='deleteModal' class='text-danger'>
  <x-slot:icon><i class="bi bi-exclamation-diamond"></i></x-slot:icon>
  <x-slot:body>
    <div class="alert alert-secondary m-3 p-4" role="alert">
      <p>
        O lote <span class="fw-bold">{{$lote->main_lang_name}}</span> está inserido em {{$lote->items_leilao_count}} leilões.
      </p>
    </div>
    <p class="text-center text-secondary">Não é possível apagar o lote.</p>
  </x-slot:body>
  <x-slot:footer>
    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill mx-1 px-4" data-bs-dismiss="modal">Cancelar</button>
  </x-slot:footer>
</x-modalActionConfirm>
@else
<x-modalActionConfirm title='Tem a certeza que quer apagar o lote?' id='deleteModal' class='text-danger'>
  <x-slot:icon><i class="bi bi-file-earmark-x-fill"></i></i></x-slot:icon>
  <x-slot:body>
    <div class="alert alert-secondary m-3 p-4" role="alert">
      <p class="fw-bold">
        {{$lote->main_lang_name}}
      </p>
    </div>
    <p class="text-center text-secondary">Não será possível recuperar o registo depois de apagado.</p>
  </x-slot:body>
  <x-slot:footer>
    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill mx-1 px-4" data-bs-dismiss="modal">Cancelar</button>
    <form method="POST" action="/lotes/{{$lote->id}}">
      @csrf
      @method('DELETE')
      <button class="btn btn-sm btn-danger rounded-pill mx-1 px-4">Apagar</button>
    </form>
  </x-slot:footer>
</x-modalActionConfirm>
@endif