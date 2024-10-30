<!-- APAGAR COLOCAÇÃO -->

<x-formCard class="mb-3 d-none" id="deleteItemLeilao">

  <x-infoCard.title title="Apagar Item de Leilão" />


  <div>
    <p class='fw-bold text-center text-danger' style="font-size: 5rem;">
      <i class="bi bi-exclamation-diamond"></i>
    </p>
    <h4 class="fw-bold text-secondary text-center px-5">
      Tem a certeza que quer remover a colocação em Leilão?
    </h4>
    <div class="alert alert-secondary m-3 p-4 text-center" role="alert">

      <p class="fw-bold">
        <span class="text-secondary">Leilão: </span>{{ $iL->leilao_id  }} <span class="text-secondary">| Lote: </span>{{ $iL->leilao_lote  }}
      </p>
      <span class="text-secondary">{{ $iC->main_lang_name  }}</span>
    </div>
    <p class="text-center text-secondary">Não será possível recuperar o registo depois de apagado.</p>

    <div class="mt-3 d-flex flex-row justify-content-center">
      <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill mx-1 px-4" onclick="getElementById('deleteItemLeilao').classList.add('d-none'); getElementById('itemLeilaoEdit').classList.remove('d-none')">Cancelar</button>
      <form method="POST" action="/itemsLeilao/{{$iL->id}}">
        @csrf
        @method('DELETE')
        <button class="btn btn-sm btn-danger rounded-pill mx-1 px-4">Apagar</button>
      </form>
    </div>
  </div>

</x-formCard>