<!-- Verbetes Search, Use, Create on other Modules [ Lotes, Livraria, &c.] -->
<x-modal class="modal-xl modal-dialog-scrollable" title="Atribuir Verbete" id="verbetes_list">

  <!-- PESQUISA DE LOTES -->
  <x-formCard>
    <div class="row d-flex justify-content-between">
      <div class="col-12 col-lg-7">
        <!-- LINHA PARA DEBUG APENAS -->
        <!-- <form action="/verbetes/modal" method="GET" target="_blank"> -->
        <form hx-get="/verbetes/modal" hx-target="#verbete" hx-sync="this:replace" hx-swap="innerHTML" hx-indicator="#verbete_indicator">
          <div class="input-group input-group-sm">
            <input id="search_verbete" type="search" class="form-control form-control-sm rounded-pill px-3" name="search" placeholder="Procurar" value="<?= ($_GET['search']) ?? ""; ?>" autofocus>
            <button class="btn btn-outline-secondary rounded-circle ms-2 btn-sm" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
          </div>
        </form>
      </div>
      <div class="col mt-3 mt-lg-0 ms-3 text-center text-lg-end">
        <a href="javascript:void(0)" class="btn btn-sm btn-primary rounded-pill px-4" data-bs-target="#verbetes_form" data-bs-toggle="modal" hx-get="/verbetes/modal/create" hx-target="#verbeteContent" hx-sync="this:replace" hx-swap="innerHTML" hx-indicator="#verbete_indicator">
          Novo
        </a>
      </div>
    </div>

    <!-- LISTA DE RESULTADOS -->
    <div id="verbete">
      <div class="d-flex justify-content-center mt-3 htmx-indicator" id="verbete_indicator"><img src="{{asset('assets/svg-loaders/stampede.gif')}}" height="20px"></div>
    </div>

  </x-formCard>
</x-modal>

<!-- Verbetes View -->
<x-modal class="modal-xl modal-dialog-scrollable" title="Atribuir Verbete" id="verbetes_form">
  <div class="d-flex justify-content-center htmx-indicator" id="verbete_indicator"><img src="{{asset('assets/svg-loaders/stampede.gif')}}" height="20px"></div>
  <x-formCard>
    <div id="verbeteContent">
    </div>
  </x-formCard>
</x-modal>


<!-- VERBETES JAVASCRIPT -->
<script src="{{asset('js/verbetes.js')}}"></script>

<script>
  $('#verbetes_list').on('shown.bs.modal', function() {
    $(this).find('input:first').focus();
  });
</script>