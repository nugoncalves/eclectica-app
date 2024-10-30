<!-- HTMX LOAD INDICATOR -->

<div class="col-12 d-flex flex-row justify-content-end mb-3 text-end gap-1">
  <button class="btn btn-sm btn-outline-secondary rounded-pill px-4 d-block" data-bs-target="#verbetes_list" data-bs-toggle="modal">Voltar</button>
  <div class="dropdown">
    <button class="btn btn-sm btn-outline-secondary rounded-pill dropdown-toggle px-4" role="button" data-bs-toggle="dropdown" aria-expanded="false">
      Acções </i>
    </button>
    <ul class="dropdown-menu">
      <li>
        <a class="dropdown-item" href="javascript:void(0)" hx-get="/verbetes/modal/{{$verbete->id}}/edit" hx-target="#verbeteContent" hx-sync="this:replace" hx-swap="innerHTML" hx-indicator="#verbete_indicator">
          <!-- LINK PARA DEBUG   -->
          <!-- <a class="dropdown-item" href="/verbetes/modal/{{$verbete->id}}/edit"> -->
          <i class="fa-solid fa-print"></i> Alterar
        </a>
      </li>
      <li>
        <a class="dropdown-item" data-bs-toggle="collapse" href="#collapseDuplicate" role="button" aria-expanded="false" aria-controls="collapseExample">
          <i class="fa-solid fa-clone"></i> Duplicar
        </a>
      </li>
    </ul>
  </div>
  <button class="btn btn-sm btn-outline-secondary rounded-pill px-4 d-block" hx-get="/verbetes/modal/create" hx-target="#verbeteContent" hx-sync="this:replace" hx-swap="innerHTML">
    Novo
  </button>
  <button onclick="verbeteToLote()" class="btn btn-sm btn-primary rounded-pill px-4 d-block" data-bs-dismiss="modal">Usar Verbete</button>
</div>

<div class="collapse" id="collapseDuplicate">
  <div class="alert alert-warning alert-dismissible fade show my-2" role="alert">
    <p>Tem a certeza que quer duplicar o Verbete?</p>
    <hr>
    <a class="alert-link px-3" data-bs-toggle="collapse" href="#collapseDuplicate" role="button" aria-expanded="false">Cancelar</a> |
    <a class="alert-link px-3" href="javascript:void(0)" hx-get="/verbetes/modal/{{$verbete->id}}/duplicate" hx-target="#verbeteContent" hx-sync="this:replace" hx-swap="innerHTML">
      Confirmar</a>
    <button role="button" class="btn-close" data-bs-toggle="collapse" href="#collapseDuplicate" role="button" aria-expanded="false"></button>
  </div>
</div>


<input type="hidden" id="idVerbete" name="idVerbete" value="{{$verbete->id}}">


<div class='col-12 form-floating mt-3'>
  <textarea class="form-control" id="nomeVerbete" name="name" placeholder="Título" style="height: 100px">{{$verbete->name}}</textarea>
  <label for="nome" class="form-label col-form-label-sm text-info-emphasis ms-2">Nome</label>
</div>

<!-- DESCRICAO BILINGUE EDITOR -->
<dib class="col-12 d-flex justify-content-between">
  <div class="col-form-label-sm text-info-emphasis ms-2 mt-4">Descrição</div>
  <div class="d-flex align-items-end me-3">
    <button class="btn btn-sm btn-secondary rounded-0 rounded-top" id="modal-btn-pt" onclick="modal_showPT()" type="button">PT</button>
    <button class="btn btn-sm btn-outline-secondary rounded-0 rounded-top" id="modal-btn-en" onclick="modal_showEN()" type="button">EN</button>
  </div>
</dib>

<div class="col-12 mb-3" id="modal_descricao-pt">
  <textarea id="descricaoVerbetePT" name="descricaoVerbetePT">
    <p>
      <strong><?= ($verbete->author) ? $verbete->author . "<br>" : ''; ?></strong>
      <em>{{ $verbete->title }}</em>. 
      <?= ($verbete->mentions) ? $verbete->mentions . ". " : ''; ?>
      <?= ($verbete->place) ? $verbete->place . ": " : ''; ?>
      <?= ($verbete->printer) ? $verbete->printer . ", " : ''; ?>
      <?= ($verbete->date) ? $verbete->date : ''; ?>.
    </p>
    <p><?= $verbete->colaccao; ?></p>
    <?= $verbete->comment; ?>
    <?= ($verbete->bibliography) ? "<p>&para; " . $verbete->bibliography : "" ?>
  </textarea>
  <script>
    ClassicEditor
      .create(document.querySelector('#descricaoVerbetePT'))
      .then(newEditor => {
        descricaoVerbetePT = newEditor;
      })
      .catch(error => {
        console.error(error);
      });
  </script>
</div>

<div class="col-12 mb-3 d-none" id="modal_descricao-en">
  <textarea id="descricaoVerbeteEN" name="descricaoVerbeteEN">
  <p>
          <strong><?= ($verbete->author) ? $verbete->author . "<br>" : ''; ?></strong>
          <em>{{ $verbete->title }}</em>. 
          <?= ($verbete->mentions) ? $verbete->mentions . ". " : ''; ?>
          <?= ($verbete->place) ? $verbete->place . ": " : ''; ?>
          <?= ($verbete->printer) ? $verbete->printer . ", " : ''; ?>
          <?= ($verbete->date) ? $verbete->date : ''; ?>.
        </p>
        <p><?= $verbete->colaccao; ?></p>
        <?= $verbete->comment_en; ?>
  </textarea>
  <script>
    ClassicEditor
      .create(document.querySelector('#descricaoVerbeteEN'))
      .then(newEditor => {
        descricaoVerbeteEN = newEditor;
      })
      .catch(error => {
        console.error(error);
      });
  </script>
</div>

<div class='form-floating mt-3'>
  <input type="text" class="form-control" id="tags_verbete" name="tags" placeholder="" value="{{ $verbete->tags}}">
  <label for="tags" class="form-label col-form-label-sm text-info-emphasis ms-2">Tags</label>
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