<div class="col-12 mb-3">
  <label for="{{ $field }}" class="col-12 form-label col-form-label-sm text-info-emphasis ms-2 mt-4">{{ $fieldLabel }}</label>
  <div>
    <textarea class="form-control" id="richTextInput" name="{{ $field }}">
      {{ $fieldValue}}
    </textarea>
    <script>
      ClassicEditor
        .create(document.querySelector('#richTextInput'))
        .then( newEditor => {
            editor = newEditor;
        } )
        .catch(error => {
          console.error(error);
        });
    </script>
  </div>
</div>
