<form hx-post="/verbetes/modal" hx-target="#verbeteContent" hx-swap="innerHTML" hx-trigger="submit delay:1s">
  @csrf

  <div class="col-12 mb-3 text-end gap-3">
    <button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-4" data-bs-target="#verbetes_list" data-bs-toggle="modal">
      Cancelar
    </button>
    <button type="submit" class="btn btn-sm btn-primary rounded-pill px-4">Gravar</button>
  </div>

  <div class="row">
    <div class="col">
      <div class="d-flex justify-content-between align-items-center">
        <label for="name" class="mt-4 form-label col-form-label-sm text-info-emphasis ms-2">SUMÁRIO</label>
        <a class='link-secondary text-decoration-none p-xtra-small' onclick="nomeUpdate()" type="button">Refresh Sumário</a>
      </div>
      <div class="mb-4 col-12">
        <textarea type="text" class="form-control" id="nomeVerbete" name="name" style="height: 80px" required>{{ old('name') }}</textarea>

      </div>

      <div class="col-12 form-floating mb-4">
        <input type="text" autocomplete="off" class="form-control autocomplete" id="author" name="author" placeholder="Autor [eg. SARAMAGO (José)]" value="{{old('author')}}" />
        <label id="authorLabel" for="author" class="form-label col-form-label-sm text-info-emphasis ms-2">Autor</label>
        <script>
          var auto_complete = new Autocomplete(document.getElementById('author'), {
            data: <?php echo json_encode($lista_autores); ?>,
            maximumItems: 10,
            highlightTyped: true,
            highlightClass: 'fw-bold text-success'
          });
          console.log(auto_complete);
        </script>
      </div>

      <div class='col-12 form-floating mt-3'>
        <textarea class="form-control" id="title" name="title" placeholder="Título" style="height: 100px" required>{{ old('title')}}</textarea>
        <label for="title" class="form-label col-form-label-sm text-info-emphasis ms-2">Título</label>
      </div>

      <x-input.textArea field='mentions' fieldLabel='Menções' :fieldValue="old('mentions')" />
      <div class="row">
        <x-input.input class="col-6 col-lg" type='text' field='place' fieldLabel='Lugar' :fieldValue="old('place')" />
        <x-input.input class="col-6 col-lg-7" type='text' field='printer' fieldLabel='Impressor [Editor]' :fieldValue="old('printer')" />
        <div class='col-6 col-lg-2 form-floating mt-3'>
          <input type="text" class="form-control" id="date" name="date" onfocusout="newNomeUpdate()" placeholder="" value="{{old('date')}}">
          <label for="date" class="form-label col-form-label-sm text-info-emphasis ms-2">Data</label>
        </div>
      </div>

      <x-input.input class="col-12" type='text' field='colaccao' fieldLabel='Colacção' :fieldValue="old('colaccao')" />

      <!-- DESCRIÇÕES RICH TEXT BILINGUE -->
      <div class="col-12 d-flex justify-content-between">
        <div class="col-form-label-sm text-info-emphasis ms-2 mt-4">Comentário</div>
        <div class="d-flex align-items-end me-3">
          <button class="btn btn-sm btn-secondary rounded-0 rounded-top" id="modal-btn-pt" onclick="modal_showPT()" type="button">PT</button>
          <button class="btn btn-sm btn-outline-secondary rounded-0 rounded-top" id="modal-btn-en" onclick="modal_showEN()" type="button">EN</button>
        </div>
      </div>
      <div class="col-12 mb-3" id="modal_descricao-pt">
        <textarea id="comentarioVerbetePT" name="comment">{{old('comment')}}</textarea>
        <script>
          ClassicEditor
            .create(document.querySelector('#comentarioVerbetePT'))
            .then(newEditor => {
              comentarioVerbetePT = newEditor;
            })
            .catch(error => {
              console.error(error);
            });
        </script>
      </div>

      <div class="col-12 mb-3 d-none" id="modal_descricao-en">
        <textarea id="comentarioVerbeteEN" name="comment_en">{{old('comment_en')}}</textarea>
        <script>
          ClassicEditor
            .create(document.querySelector('#comentarioVerbeteEN'))
            .then(newEditor => {
              comentarioVerbeteEN = newEditor;
            })
            .catch(error => {
              console.error(error);
            });
        </script>
      </div>
      <script>
        function modal_showEN() {
          var mainLang = document.getElementById('modal_descricao-pt');
          var secondLang = document.getElementById('modal_descricao-en');
          mainLang.classList.add('d-none');
          secondLang.classList.remove('d-none');
          document.getElementById('modal-btn-pt').classList.replace('btn-secondary', 'btn-outline-secondary');
          document.getElementById('modal-btn-en').classList.replace('btn-outline-secondary', 'btn-secondary');
        }

        function modal_showPT() {
          var mainLang = document.getElementById('modal_descricao-pt');
          var secondLang = document.getElementById('modal_descricao-en');
          mainLang.classList.remove('d-none');
          secondLang.classList.add('d-none');
          document.getElementById('modal-btn-pt').classList.replace('btn-outline-secondary', 'btn-secondary');
          document.getElementById('modal-btn-en').classList.replace('btn-secondary', 'btn-outline-secondary');
        }
      </script>

      <x-input.input class="col-12" type='text' field='bibliography' fieldLabel='Bibliografia' :fieldValue="old('bibliography')" />
      <x-input.input class="col-12" type='text' field='tags' fieldLabel='Temas [tags]' :fieldValue="old('theme')" />
      <x-input.textArea field='notes' fieldLabel='Notas' :fieldValue="old('notes')" />
    </div>
  </div>
</form>

<!-- VERBETES JAVASCRIPT -->
<script src="{{asset('js/verbetes.js')}}"></script>