{{-- Lista de Compradores --}}
<x-formCard class="mt-3">

  <x-infoCard.title title="Compradores" />

  <x-infoCard.infoTable>
    <x-slot:tableHeader>
      <th class="p-xtra-small">[Num]. Nome</th>
    </x-slot:tableHeader>

    <x-slot:tableBody>

      @foreach ($compradores as $comprador)
      <tr style="transform: rotate(0);">
        <td class="p-xtra-small">{{ $comprador->id }} | <strong>{{$comprador->full_name}}</strong></td>
        <td>
          <a href="javascript:void(0)" class="stretched-link text-secondary" data-bs-toggle="offcanvas" data-bs-target="#offcanvas_cliente" aria-controls="offcanvas_cliente" hx-get="/clientes/offCanvasView/{{ $comprador->id }}" hx-target="#htmx_cliente" hx-sync="this:replace" hx-swap="innerHTML">

          </a>
        </td>
      </tr>
      @endforeach
    </x-slot:tableBody>

  </x-infoCard.infoTable>



</x-formCard>