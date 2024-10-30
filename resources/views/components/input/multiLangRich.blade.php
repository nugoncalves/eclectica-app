<div class="col-12 d-flex justify-content-between">
  <div class="col-form-label-sm text-info-emphasis ms-2 mt-4">{{$title}}</div>
  <div class="d-flex align-items-end me-3">
    <button class="btn btn-sm btn-secondary rounded-0 rounded-top" id="btn-pt" onclick="showPT()" type="button">PT</button>
    <button class="btn btn-sm btn-outline-secondary rounded-0 rounded-top" id="btn-en" onclick="showEN()" type="button">EN</button>
  </div>
</div>

<div class="col-12 mb-3" id="descricao-pt">
  <textarea id="richTextInputPT" name="{{$fieldNamePT}}">
  {!! $fieldPT !!}
  </textarea>
  <script>
    ClassicEditor
      .create(document.querySelector('#richTextInputPT'))
      .then(newEditor => {
        editor = newEditor;
      })
      .catch(error => {
        console.error(error);
      });
  </script>
</div>
<div id="descricao-en" class="col-12 mb-3 d-none">
  <textarea id="richTextInputEN" name="{{$fieldNameEN}}">
  {!!$fieldEN  !!} 
  </textarea>
  <script>
    ClassicEditor
      .create(document.querySelector('#richTextInputEN'))
      .then(newEditor => {
        editorEN = newEditor;
      })
      .catch(error => {
        console.error(error);
      });
  </script>
</div>


<script>
  function showEN() {
    var mainLang = document.getElementById('descricao-pt');
    var secondLang = document.getElementById('descricao-en');
    mainLang.classList.add('d-none');
    secondLang.classList.remove('d-none');
    document.getElementById('btn-pt').classList.replace('btn-secondary', 'btn-outline-secondary');
    document.getElementById('btn-en').classList.replace('btn-outline-secondary', 'btn-secondary');
  }

  function showPT() {
    var mainLang = document.getElementById('descricao-pt');
    var secondLang = document.getElementById('descricao-en');
    mainLang.classList.remove('d-none');
    secondLang.classList.add('d-none');
    document.getElementById('btn-pt').classList.replace('btn-outline-secondary', 'btn-secondary');
    document.getElementById('btn-en').classList.replace('btn-secondary', 'btn-outline-secondary');
  }
</script>