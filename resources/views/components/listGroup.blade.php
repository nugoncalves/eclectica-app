<!-- Início Lista-->
<div class="container mt-3">
  <div class="row ">
    <div class="col shadow p-0">
      <div {{ $attributes->merge(['class' => 'list-group', 'style' => '']) }}>

        {{ $slot }}

      </div>
    </div>
  </div>
</div> <!-- Fim Lista -->
