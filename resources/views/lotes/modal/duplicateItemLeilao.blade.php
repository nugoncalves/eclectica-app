<!-- Modal Duplicar Lote -->
<x-modalActionConfirm title='Tem a certeza que quer duplicar o lote?' id='duplicateModal' class='text-warning'>
  <x-slot:icon><i class="fa-solid fa-copy"></i></x-slot:icon>
  <x-slot:body>
    <div class="alert alert-secondary m-3 p-4" role="alert">
      <p class="fw-bold">
        {{$lote->main_lang_name}}
      </p>

    </div>
  </x-slot:body>
  <x-slot:footer>
    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill mx-2 px-4" data-bs-dismiss="modal">Cancelar</button>
    <a href="/lotes/{{$lote->id}}/duplicate" class="btn btn-sm btn-warning rounded-pill mx-1 px-4">Duplicar</a>

  </x-slot:footer>
</x-modalActionConfirm>