<!-- Modal para confirmar Acção de registo -->

<div class="modal fade" id="{{ $id }}" tabindex="-1" aria-labelledby="{{ $id }}" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body border border-0">
        <div>
          <p {{ $attributes->merge(['class' => 'fw-bold text-center']) }} style="font-size: 5rem;">
            {{ $icon }}
          </p>
          <h4 class="fw-bold text-secondary text-center px-5">
            {{ $title }}
          </h4>
          {{ $body  }}
        </div>
        <div class="modal-footer justify-content-center border border-0 mt-0">
          {{ $footer  }}
        </div>
      </div>
    </div>
  </div>
</div>