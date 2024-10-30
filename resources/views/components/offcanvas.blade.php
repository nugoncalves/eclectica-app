<div {{ $attributes->merge(['class' => 'offcanvas offcanvas-end p-3']) }} data-bs-backdrop="static" tabindex="-1" id="{{ 'offcanvas_'.$name }}" aria-labelledby="offcanvasRightLabel" style="background-color: var(--body-bg-color);">

  <div class="offcanvas-header">
    <h4 class="offcanvas-title fw-bold" id="offcanvasLabel">{{ $title }}</h4>
    <button type="button" class="btn" data-bs-dismiss="offcanvas" aria-label="Close"><i class="fa-solid fa-arrow-right-to-bracket"></i></button>
  </div>

  <div class="offcanvas-body" id="{{ 'htmx_'.$name }}">

    {{ $slot }}

  </div>

</div>