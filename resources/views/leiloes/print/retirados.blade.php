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

    {{-- HEADER --}}

    <div class="row d-flex align-items-center py-3">
      <div class="col-6">
        <img src="{{ asset('assets/logo/ELeiloes_logo_print.png') }}" alt="" width="60%">
      </div>
      <div class="col-6 h3 fw-bold text-end">
        Retirados <span class="fw-bold">{{ $leilao->id }}</span>
      </div>
    </div>

    {{-- BODY --}}

    <div class="row mt-4">
      <div class="col-12">
        <table class="table table-sm table-borderless p-xtra-small">
          <thead class="border-bottom">
            <tr>
              <th>Lote</th>
              <th>Descricão</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($lotes as $lote)
              <tr>
                <td>{{ $lote->leilao_lote }}</td>
                <td>{{ $lote->itemsContrato->main_lang_name }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

  </body>
  <!-- ABRE O DIALOG DE IMPRESSÃO FECHA A TAB DE IMPRESSÃO DEPOIS DE IMPRIMIR OU CANCELAR -->
  <script type="text/javascript">
    window.onafterprint = window.close;
    window.print();
  </script>

</html>
