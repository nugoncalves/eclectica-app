@props(['inputDesc' =>'', 'type', 'field', 'fieldValue', 'fieldLabel', 'disabled' =>0, 'readonly'=>0, 'required' =>0])

<div {{ $attributes->merge(['class' => 'form-floating mt-3']) }}>
  <input type="{{ $type }}" class="form-control" id="{{ $field }}" name="{{ $field }}" placeholder="" value="{{ $fieldValue}}" {{($required) ? 'required' : ''  }} {{($disabled) ? 'disabled' : ''  }} {{($readonly) ? 'readonly' : ''  }}>
  <label for="{{ $field }}" class="form-label col-form-label-sm text-info-emphasis ms-2">{{ $fieldLabel }}</label>
  <div class="form-text {{ (empty($inputDesc)) ? 'd-none' : '' }}">{{ $inputDesc }}</div>
</div>