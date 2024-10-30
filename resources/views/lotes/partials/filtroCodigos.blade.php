<!-- OFF CANVAS DE FILTRO POR CÓDIGOS -->

<x-modal class="modal-lg modal-dialog-scrollable" title="Procurar por Códigos" id="modal_codigos">
  <form action="/lotes">
    @csrf
    <div class="row justify-content-center">
      <x-formCard>

        <x-infoCard.title title="Contrato" />
        <x-input.input class="col-6 col-lg" type='number' field='idContrato' fieldLabel='Contrato' fieldValue="{{$_GET['idContrato'] ?? ''}}" />
        <x-input.input class="col-6 col-lg" type='number' field='contratoIndex' fieldLabel='Inventário' fieldValue="{{$_GET['contratoIndex'] ?? ''}}" />

      </x-formCard>
      <x-formCard class="mt-3">
        <x-infoCard.title title="Leilão" />
        <x-input.input class="col-6 col-lg" type='number' field='leilao_id' fieldLabel='Leilão' fieldValue="{{$_GET['leilao_id'] ?? ''}}" />
        <x-input.input class="col-6 col-lg" type='number' field='leilao_lote' fieldLabel='Lote' fieldValue="{{$_GET['leilao_lote'] ?? ''}}" />
      </x-formCard>

    </div>
    <div class="mt-3 d-flex flex-row justify-content-end gap-3">
      <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">Fechar</button>
      <?php if ($filtered) : ?>
        <button onclick="location.href='<?= $baseRoute; ?>'" class="btn btn-sm btn-outline-secondary rounded-pill px-4" type="reset"><i class="bi bi-x-lg"></i> Remover Filtros</button>
      <?php endif; ?>
      <button type="submit" class="btn btn-sm btn-primary rounded-pill px-4">Procurar</button>
    </div>
  </form>

</x-modal>