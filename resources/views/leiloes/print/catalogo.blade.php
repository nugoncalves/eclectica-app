<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecléctica App</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('assets/logo/ELeiloes-simbolo-cor.png') }}">

    <!-- STYLES CSS -->

    <!-- BOOTSTRAP CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- BOOTSTRAP ICONS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- FONT AWESOME ICONS -->
    <script src="https://kit.fontawesome.com/075e68d52a.js" crossorigin="anonymous"></script>

    <!-- MATERIAL ICONS -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

  </head>

  <body>

    {{-- BODY --}}

    <div class="row mt-4">
      @foreach ($lotes as $lote)
        <div class="col-12 mb-4">
          <span class="fw-bold">{{ $lote->leilao_lote }}</span>. {!! $lote->itemsContrato->main_lang_desc !!}
          <br>
          <span class="fw-bold text-end">{{ Number::currency($lote->start_price, in: 'EUR', locale: 'pt') }} - {{ Number::currency($lote->max_estimate, in: 'EUR', locale: 'pt') }} </span>
        </div>
      @endforeach
    </div>

    <!-- ABRE O DIALOG DE IMPRESSÃO FECHA A TAB DE IMPRESSÃO DEPOIS DE IMPRIMIR OU CANCELAR -->
    {{-- <script type="text/javascript">
    window.onafterprint = window.close;
    window.print();
  </script> --}}
  </body>

</html>
