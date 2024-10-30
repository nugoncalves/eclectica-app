<!DOCTYPE html>
<html lang="pt">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Imprimir Contrato</title>

  <link rel="icon" type="image/x-icon" href="{{ asset('assets/logo/ELeiloes-simbolo-cor.png') }}">

  {{-- STYLES CSS --}}
  <!-- BOOTSTRAP CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

  <!-- PRINT CSS -->
  <link rel="stylesheet" href="{{asset('/css/print.css')}}">

  <!-- BOOTSTRAP ICONS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

  <!-- FONT AWESOME ICONS -->
  <script src="https://kit.fontawesome.com/075e68d52a.js" crossorigin="anonymous"></script>

</head>

<body class="text-sans-serif">
  <div class="sheet-outer A4">
    <section class="sheet padding-5mm">
      <!-- Header da Primeira Página -->
      <div class="d-flex flex-row align-items-stretch border border-warning">
        <div class="d-flex align-items-center p-5 header-logo">
          <img src="{{asset('/assets/logo/eclectica_simbolo.png')}}" style="width: 40%; height:auto" ; />
        </div>
      </div>

      <!-- Dados da Empresa & Cliente -->
      <div class="sheet-header text-small">
        <div class="d-flex justify-content-between">
          <div class="border border-primary">
            <p class="fw-bold">Ecléctica Leilões</p>
            <p>
              Rua Luisa Tody, 12G
              <br>
              2925-568 Azeitão, Portugal
            </p>
          </div>


        </div>

      </div>

      <!-- Conteúdo -->
      <div class="sheet-content text-small">

        <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Descricao</th>
              <th scope="col">Reserva</th>
            </tr>
          </thead>
          <tbody>
            @foreach($itemsContrato as $item)
            <tr class="text-xsmall">
              <td class="fw-bold">{{$item->contrato_index}}</td>
              <td>{{$item->main_lang_name}}</td>
              <td class="text-end">{{$item->reserve}}</td>
            </tr>
            @endforeach
          </tbody>
        </table>



      </div>
    </section>
  </div>

</body>

</html>