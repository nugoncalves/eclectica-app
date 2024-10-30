<!-- procurar, filtrar, ordernar, etc. -->
<div class="list-group-item px-5 py-3">
  <div class="row">
    <div class="col-12 col-lg-6">
      <form>
        {{ $slot }}
        <div class="input-group input-group-sm">
          <input type="search" class="form-control form-control-sm rounded-pill px-3" name="search" placeholder="Procurar texto..." value="{{ $_GET['search'] ?? "" }}">
          <button class="btn btn-outline-secondary rounded-circle ms-2 btn-sm" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
        </div>
      </form>
    </div>
    <div class="col-12 col-lg-6 mt-2 mt-lg-0 text-end">
      <?php if (!empty($_GET['search'])) : ?>
        <button onclick="location.href='<?= $baseRoute; ?>'" class=" btn btn-sm btn-outline-secondary rounded-pill ms-2" type="reset"><i class="bi bi-x-lg"></i> Remover Filtros</button>
      <?php endif; ?>

    </div>
  </div>
</div> <!-- Fim procurar, filtrar, ordernar, etc. -->