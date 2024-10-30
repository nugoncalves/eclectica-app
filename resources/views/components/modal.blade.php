<!-- Modal -->
@props([
'title',
'id',
])

<div class="modal fade" id="{{ $id }}" data-bs-backdrop="static" tabindex="-1" aria-labelledby="addItemLeilaoLabel" aria-hidden="true">
  <div {{ $attributes->merge(['class' => 'modal-dialog']) }}>
    <div class="modal-content" style="background-color: var(--body-bg-color);">
      <div class="modal-header">
        <h1 class="modal-title fs-5 fw-bold">{{ $title }}</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body px-5 pt-3">
        {{ $slot }}
      </div>
    </div>
  </div>
</div>