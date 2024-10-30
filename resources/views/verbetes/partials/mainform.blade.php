<!-- Main Form (Left Main Col) -->
<x-formCard>

  <input type="hidden" name="id" value="{{$verbete->id}}">

  <div class="d-flex justify-content-between align-items-center">
    <label for="nome" class="form-label col-form-label-sm text-info-emphasis ms-2 mt-4">SUMÁRIO</label>
    <a class='link-secondary text-decoration-none p-xtra-small' onclick="nomeUpdate()" type="button">Refresh Sumário</a>
  </div>
  <div class="col-12 mb-4">
    <textarea type="text" class="form-control" id="nomeVerbete" name="name" style="height: 80px">{{$verbete->name}}</textarea>
  </div>

  <div class="col-12 form-label col-form-label-sm text-info-emphasis ms-2">FICHA TÉCNICA</div>

  <div class="col-12 form-floating">
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
  <x-input.input class="col-6 col-lg-3" type='text' field='place' fieldLabel='Lugar' :fieldValue="$verbete->place" />
  <x-input.input class="col-6" type='text' field='printer' fieldLabel='Impressor [Editor]' :fieldValue="$verbete->printer" />
  <x-input.input class="col-6 col-lg-3" type='text' field='date' fieldLabel='Data' :fieldValue="$verbete->date" />
  <x-input.input class="col-12" type='text' field='colaccao' fieldLabel='Colacção' :fieldValue="$verbete->colaccao" />

  <x-input.multiLangRich title="Comentário" fieldPT="{{$verbete->comment}}" fieldNamePT="comment" fieldEN="{{$verbete->comment_en}}" fieldNameEN="comment_en" />

  <x-input.input class="col-12" type='text' field='bibliography' fieldLabel='Bibliografia' :fieldValue="$verbete->bibliography" />
  <x-input.input class="col-12" type='text' field='theme' fieldLabel='Temas [tags]' :fieldValue="$verbete->theme" />
  <x-input.textArea field='notes' fieldLabel='Notas' :fieldValue="$verbete->notes" />
</x-formCard>