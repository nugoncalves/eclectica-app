<div {{ $attributes->merge(['class' => 'bg-white shadow rounded', 'id' => '', 'style' =>'']) }}>

        <div class="col-12 fs-5 fw-bold text-dark-emphasis pt-4 pb-2 ps-4 ps-lg-5 mb-3">
            {{ $title }}
        </div>

        <div class="col-12 py-2 px-4 px-lg-5 mb-4">
            {{$slot}}
        </div>

</div>
