@props(['field'])

@error($field)
    <p class="text-danger">{{ $message }}</p>
@enderror