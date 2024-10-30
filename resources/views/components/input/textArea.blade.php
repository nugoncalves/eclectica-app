<div {{ $attributes->merge(['class'=>'col-12 form-floating mt-3']) }}>
  <textarea class="form-control" id="{{ $field }}" name="{{ $field }}" placeholder="Título" style="height: 100px">{{ $fieldValue}}</textarea>
  <label for="{{ $field }}" class="form-label col-form-label-sm text-info-emphasis ms-2">{{ $fieldLabel }}</label>
</div>