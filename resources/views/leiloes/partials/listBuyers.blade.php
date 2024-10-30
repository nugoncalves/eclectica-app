<!-- Lista de Compradores  -->
<x-infoCard.infoCard class="mb-4 mh-100" title="Clientes">
    <div class="overflow-auto mb-4" style="max-height: 500px;">
        <x-infoCard.infoTable>
            <x-slot:tableHeader>
                <th class="text-center p-xtra-small">ID</th>
                <th class="text-center p-xtra-small">Nome</th>
            </x-slot:tableHeader>
            <x-slot:tableBody>
                @if ($licitantes->count() > 0)
                    @foreach ($licitantes as $licitante)
                        <tr style="transform: rotate(0);">
                            <td class="text-center p-xtra-small">{{ $licitante->id }}</td>
                            <td class="p-xtra-small">
                                @if ($licitante->sold_bid)
                                    <i class="fa-solid fa-trophy"></i>
                                @endif{{ $licitante->full_name }}
                            </td>
                            <td>
                                <a href="javascript:void(0)" class="stretched-link text-secondary"
                                    data-bs-toggle="offcanvas" data-bs-target="#offcanvas_cliente"
                                    aria-controls="offcanvas_cliente"
                                    hx-get="/clientes/offCanvasView/{{ $licitante->id }}" hx-target="#htmx_cliente"
                                    hx-sync="this:replace" hx-swap="innerHTML"
                                    hx-indicator="#clienteOffcanvasPlaceholder"></a>
                                <!-- LINK PARA DEBUG EM CASO DE ERRO HTMX -->
                                <!-- <a href="/clientes/offCanvasView/{{ $licitante->id }}" class="stretched-link text-secondary"></a> -->
                            </td>
                        </tr>
                    @endforeach
                @endif
            </x-slot:tableBody>
        </x-infoCard.infoTable>
    </div>
</x-infoCard.infoCard>
