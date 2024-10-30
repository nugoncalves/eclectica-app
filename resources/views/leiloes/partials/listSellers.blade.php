<!-- Lista de Fornecedores -->
<x-infoCard.infoCard class="mb-4 mh-100" title="Vendedores">
  <div class="overflow-auto" style="height: 200px;">
    <x-infoCard.infoTable>
      <x-slot:tableHeader>
        <th class="text-center p-xtra-small">ID</th>
        <th class="text-center p-xtra-small">Nome</th>
      </x-slot:tableHeader>
      <x-slot:tableBody>
        @if ($fornecedores->count() > 0)
        @foreach ($fornecedores as $fornecedor)
        <tr style="transform: rotate(0);">
          <td class="text-center p-xtra-small">{{ $fornecedor->id }}</td>
          <td class="p-xtra-small">{{ $fornecedor->full_name }}</td>
          <td>
            <a href="javascript:void(0)" class="stretched-link text-secondary" data-bs-toggle="offcanvas" data-bs-target="#offcanvas_cliente" aria-controls="offcanvas_cliente" hx-get="/clientes/offCanvasView/{{ $fornecedor->id }}" hx-target="#htmx_cliente" hx-sync="this:replace" hx-swap="innerHTML" hx-indicator="#clienteOffcanvasPlaceholder"></a>
          </td>
        </tr>
        @endforeach
        @endif
      </x-slot:tableBody>
    </x-infoCard.infoTable>
  </div>
</x-infoCard.infoCard>