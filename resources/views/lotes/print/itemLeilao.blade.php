<!DOCTYPE html>
<html lang="pt">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Imprimir Etiqueta de Lote</title>
  <link rel="icon" type="image/x-icon" href="/storage/logo/ELeiloes-simbolo-cor.png">

  {{-- STYLES CSS --}}
  <!-- BOOTSTRAP CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

  <link rel="stylesheet" href="{{asset('/css/print_lot_label.css')}}">

  <!-- BOOTSTRAP ICONS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

  <!-- FONT AWESOME ICONS -->
  <script src="https://kit.fontawesome.com/075e68d52a.js" crossorigin="anonymous"></script>

</head>

<body>
  <div class="sheet-outer smallLabel">
    <section class="sheet padding-5mm">
      <div class="sheet-content">
        <div id="circle"></div>
        <div class="ms-4 text-center">
          <div class="fw-bold fs-6 text-secondary">{{ $lote->leilao_id }}</div>
          <div class="h2 fw-bold">{{ $lote->leilao_lote }}</div>
        </div>
        <div class="mt-5 p-0 text-small text-left">
          {{ $descricao[0]->main_lang_name }}
        </div>
      </div>
    </section>
  </div>

</body>

</html>

<!-- ABRE O DIALOG DE IMPRESSÃO FECHA A TAB DE IMPRESSÃO DEPOIS DE IMPRIMIR OU CANCELAR -->
<script type="text/javascript">
  window.onafterprint = window.close;
  window.print();
</script>