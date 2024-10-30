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

  <link rel="stylesheet" href="{{asset('/css/print_client_label.css')}}">

  <!-- BOOTSTRAP ICONS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

  <!-- FONT AWESOME ICONS -->
  <script src="https://kit.fontawesome.com/075e68d52a.js" crossorigin="anonymous"></script>

</head>

<body>
  <div class="sheet-outer smallLabel">
    <section class="sheet padding-5mm">
      <div class="sheet-content">
        <div class="position-relative" style="height: 95mm;">
          <div class="position-absolute top-0 start-0 ms-2">
            <img src="{{asset('assets/logo/ELeiloes_logo_print.png')}}" alt="" height="30px">
          </div>
          <div class="position-absolute bottom-0 start-0 ms-2">
            <p class="text-small text-secondary">
              Att: Catarina Gonçalves
              <br>
              Rua Luísa Tody, 12G
              <br>
              2925-568 Azeitão (Portugal)
            </p>
          </div>
          <div class="position-absolute top-0 end-0 mt-2 me-5 text-end text-label text-secondary fw-bold">
            CONTÉM LIVROS
          </div>
          <div class="position-absolute bottom-0 end-0 text-label me-5 mb-5">
            {{($cliente->shipping_saudacao) ? $cliente->shipping_saudacao : $cliente->saudacao }}
            <br>
            {{($cliente->shipping_name) ? $cliente->shipping_name : $cliente->full_name }}
            <br>
            {{($cliente->shipping_address) ? $cliente->shipping_address : $cliente->address }}
            <br>
            {{($cliente->shipping_zip) ? $cliente->shipping_zip : $cliente->zip }}
            {{($cliente->shipping_city) ? $cliente->shipping_city : $cliente->city }}
            . {{($cliente->shipping_state) ? $cliente->shipping_state : $cliente->state }}
            <br>
            {{($cliente->shipping_country) ? $cliente->shipping_country : $cliente->country }}
          </div>
        </div>
      </div>
    </section>
  </div>

</body>

</html>