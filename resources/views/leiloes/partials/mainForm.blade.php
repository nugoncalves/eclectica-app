<!-- Main Form de Leilões -->

<form method="POST" action="/leiloes/{{ $leilao->id }}" id="main_form">
    @csrf
    @method('PUT')

    <x-formCard class="mb-4">
        <x-input.input class="col-6 col-lg-3" type='number' field='id' fieldLabel='Leilão' :fieldValue="$leilao->id" />
        <x-input.input class="col-6 col-lg-3" type='date' field='start_date' fieldLabel='Data de Início'
            :fieldValue="$leilao->start_date" />
        <x-input.input class="col-6 col-lg-3" type='date' field='end_date' fieldLabel='Data de Leilão'
            :fieldValue="$leilao->end_date" />
        <div class=' col-6 col-lg-3 form-floating mt-3'>
            <input type="number" step=".01" class="form-control" id="commission_client" name="commission_client"
                placeholder="" value="{{ $leilao->commission_client }}">
            <label for="commision_client" class="form-label col-form-label-sm text-info-emphasis ms-2">Comissão
                Cliente</label>
        </div>

        <!-- <x-input.input class="col-6 col-lg-3" type='number' field='commission_client' fieldLabel='Comissão Cliente' :fieldValue="$leilao->commission_client" /> -->
        <x-input.input class="col-12 col-lg-9" type='text' field='name' fieldLabel='Título' :fieldValue="$leilao->name" />
        <div class='col-6 col-lg-3 form-floating mt-3'>
            <select class="form-select" name="status" id="status" aria-label="Default select example">
                <option selected>{{ $leilao->status }}</option>
                <option value="espera">espera</option>
                <option value="decorrer">decorrer</option>
                <option value="terminado">terminado</option>
                <option value="processado">processado</option>
            </select>
            <label for="estado" class="form-label col-form-label-sm text-info-emphasis ms-2">Estado</label>
        </div>
    </x-formCard>

</form>
