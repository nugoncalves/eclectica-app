{{-- FLASH MESSAGE --}}
<x-flashMessage />


<!-- <form method="POST" action="/verbetes/modal/{{$verbete->id}}" target="_blank"> -->
<form hx-put="/verbetes/modal/{{ $verbete->id }}" hx-target="#verbeteContent" hx-swap="innerHTML" hx-trigger="submit delay:1s">
  @csrf
  @method('PUT')

  <div class="col-12 mb-3 text-end gap-3">
    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-4" data-bs-target="#verbetes_list" data-bs-toggle="modal">Cancelar</button>
    <button type="submit" class="btn btn-sm btn-primary rounded-pill px-4">Gravar</button>
  </div>

  {{-- Div de Conteúdo --}}
  <div class="row justify-content-center">
    <div class="col mb-4">

      <!-- Main Form -->
      <input type="hidden" name="id" value="{{$verbete->id}}">

      <div class="d-flex justify-content-between align-items-center">
        <label for="nome" class="form-label col-form-label-sm text-info-emphasis ms-2 mt-4">Sumário</label>
        <a class='link-secondary text-decoration-none p-xtra-small' onclick="nomeUpdate()" type="button">Refresh Sumário</a>
      </div>
      <div class="col-12 mb-4">
        <textarea type="text" class="form-control" id="nomeVerbete" name="name" style="height: 80px">{{$verbete->name}}</textarea>
      </div>

      <div class="col-12 form-label col-form-label-sm text-info-emphasis ms-2">Ficha Técnica</div>
      <div class="col-12 form-floating mb-4">
        <input type="text" autocomplete="off" class="form-control autocomplete" id="author" name="author" placeholder="Autor [eg. SARAMAGO (José)]" value="{{$verbete->author}}">
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
      <x-input.textArea field='title' fieldLabel='Título' :fieldValue="$verbete->title" />
      <x-input.textArea field='mentions' fieldLabel='Menções' :fieldValue="$verbete->mentions" />
      <div class="row">

        <x-input.input class="col-12 col-sm-3" type='text' field='place' fieldLabel='Lugar' :fieldValue="$verbete->place" />
        <x-input.input class="col-12 col-sm-6" type='text' field='printer' fieldLabel='Impressor [Editor]' :fieldValue="$verbete->printer" />
        <x-input.input class="col-12 col-sm-3" type='text' field='date' fieldLabel='Data' :fieldValue="$verbete->date" />
      </div>

      <x-input.input class="col-12" type='text' field='colaccao' fieldLabel='Colacção' :fieldValue="$verbete->colaccao" />

      <!-- DESCRIÇÕES RICH TEXT BILINGUE -->
      <div class="col-12 d-flex justify-content-between">
        <div class="col-form-label-sm text-info-emphasis ms-2 mt-4">Comentário</div>
        <div class="d-flex align-items-end me-3">
          <button class="btn btn-sm btn-secondary rounded-0 rounded-top" id="modal-btn-pt" onclick="modal_showPT()" type="button">PT</button>
          <button class="btn btn-sm btn-outline-secondary rounded-0 rounded-top" id="modal-btn-en" onclick="modal_showEN()" type="button">EN</button>
        </div>
      </div>

      <div class="col-12 mb-3" id="modal_descricao_pt">
        <textarea id="comment_modal" name="comment">{!!$verbete->comment!!}</textarea>
        <script>
          ClassicEditor
            .create(document.querySelector('#comment_modal'))
            .then(newEditor => {
              comment = newEditor;
            })
            .catch(error => {
              console.error(error);
            });
        </script>
      </div>

      <div class="col-12 mb-3 d-none" id="modal_descricao_en">
        <textarea id="comment_modal_en" name="comment_en">{!!$verbete->comment_en!!}</textarea>
        <script>
          ClassicEditor
            .create(document.querySelector('#comment_modal_en'))
            .then(newEditor => {
              comment_en = newEditor;
            })
            .catch(error => {
              console.error(error);
            });
        </script>
      </div>

      <script>
        function modal_showEN() {
          var mainLang = document.getElementById('modal_descricao_pt');
          var secondLang = document.getElementById('modal_descricao_en');
          mainLang.classList.add('d-none');
          secondLang.classList.remove('d-none');
          document.getElementById('modal-btn-pt').classList.replace('btn-secondary', 'btn-outline-secondary');
          document.getElementById('modal-btn-en').classList.replace('btn-outline-secondary', 'btn-secondary');
        }

        function modal_showPT() {
          var mainLang = document.getElementById('modal_descricao_pt');
          var secondLang = document.getElementById('modal_descricao_en');
          mainLang.classList.remove('d-none');
          secondLang.classList.add('d-none');
          document.getElementById('modal-btn-pt').classList.replace('btn-outline-secondary', 'btn-secondary');
          document.getElementById('modal-btn-en').classList.replace('btn-secondary', 'btn-outline-secondary');
        }
      </script>

      <x-input.input class="col-12" type='text' field='bibliography' fieldLabel='Bibliografia' :fieldValue="$verbete->bibliography" />
      <x-input.input class="col-12" type='text' field='tags' fieldLabel='Temas [tags]' :fieldValue="$verbete->tags" />
      <x-input.textArea field='notes' fieldLabel='Notas' :fieldValue="$verbete->notes" />

    </div>
  </div>
  <div class="row my-3"></div>
</form>