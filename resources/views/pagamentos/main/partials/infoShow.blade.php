<x-formCard>
    <x-infoCard.title title="Fornecedor" />
    <x-infoCard.infoData name="Referência" value="[{{$fornecedor->id}}] {{$fornecedor->seller_reference}}" />
    <x-infoCard.infoData name="Nome" value="{{$fornecedor->full_name}}" />
    <x-infoCard.infoData name="IBAN" value="{{$fornecedor->nib}}" />

    <x-infoCard.title title="Leilão" class="mt-3" />
    <x-infoCard.infoData name=" Leilão" value="{{$leilao->id}}" />
    <x-infoCard.infoData name="Título" value="{{$leilao->name}}" />
    <x-infoCard.infoData name="Data" value="{{$leilao->end_date}}" />

    <x-infoCard.title title="Anexos" class="mt-3" />
    @foreach($comprovativos as $comprovativo)
    <div class='d-flex justify-content-between align-items-center border-bottom p-2'>
        <a href="{{ asset($comprovativo->path) }}" target="_blank">
            <span class=" d-block small">{{ $comprovativo->name }}</span>
        </a>
        <form action="/deleteAnexo/{{ $comprovativo->id }}" method="post">
            @csrf
            @method('DELETE')

            <button type="submit" style="background: none;border:none;padding:0;margin:o;cursor:pointer;"
                class="link-danger"><i class="bi bi-trash3"></i></button>

        </form>
    </div>
    @endforeach
</x-formCard>
{{-- <x-formCard class="mt-3">

</x-formCard> --}}