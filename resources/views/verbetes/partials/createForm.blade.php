<!-- CREATE VERBETE MAIN FORM -->
<div class="container mt-3">
  <div class="row justify-content-center">
    <div class="col-8">
      <x-formCard>
        <div class="d-flex justify-content-between align-items-center">
          <label for="nome" class="mt-4 form-label col-form-label-sm text-info-emphasis ms-2">SUMÁRIO</label>
          <a class='link-secondary text-decoration-none p-xtra-small' onclick="nomeUpdate()" type="button">Refresh Sumário</a>
        </div>
        <div class="mb-4 col-12">
          <textarea type="text" class="form-control" id="nomeVerbete" name="name" style="height: 80px">{{ old('name') }}</textarea>
          <x-input.error field='name' />
        </div>

        <div class="mt-3 col-12 form-label col-form-label-sm text-info-emphasis ms-2">Ficha Técnica</div>
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
          </script>
        </div>

        <x-input.textArea field='title' fieldLabel='Título' :fieldValue="old('title')" />
        <x-input.textArea field='mentions' fieldLabel='Menções' :fieldValue="old('mentions')" />
        <x-input.input class="col-6 col-lg" type='text' field='place' fieldLabel='Lugar' :fieldValue="old('place')" />
        <x-input.input class="col-6 col-lg-7" type='text' field='printer' fieldLabel='Impressor [Editor]' :fieldValue="old('printer')" />
        <div class='col-6 col-lg-2 form-floating mt-3'>
          <input type="text" class="form-control" id="date" name="date" onfocusout="newNomeUpdate()" placeholder="" value="{{old('date')}}">
          <label for="date" class="form-label col-form-label-sm text-info-emphasis ms-2">Data</label>
        </div>
        <x-input.input class="col-12" type='text' field='colaccao' fieldLabel='Colacção' :fieldValue="old('colaccao')" />

        <x-input.multiLangRich title="Comentário" fieldPT="{{old('comment')}}" fieldNamePT="comment" fieldEN="{{old('comment_en')}}" fieldNameEN="comment_en" />

        <x-input.input class="col-12" type='text' field='bibliography' fieldLabel='Bibliografia' :fieldValue="old('bibliography')" />
        <x-input.input class="col-12" type='text' field='tags' fieldLabel='Temas [tags]' :fieldValue="old('tags')" />
        <x-input.textArea field='notes' fieldLabel='Notas' :fieldValue="old('notes')" />

      </x-formCard>
    </div>
  </div>
  <div class="my-3 row"></div>
</div>