<div {{ $attributes->merge(['class' => 'bg-white shadow rounded py-3 px-3 px-lg-5', 'id' => '', 'style' =>'']) }}>
  <div class="row my-4">
    {{$slot}}
  </div>
</div>