<!DOCTYPE html>
<html lang="pt">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Imprimir Ficha Bibliográfica Lote</title>

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

<body>
  <div class="sheet-outer A4">
    <section class="sheet padding-5mm">
      {{-- Header da Primeira Página --}}
      <div class="d-flex flex-row align-items-stretch bg-secondary-subtle" style="height: 180px;">
        <div class="d-flex align-items-center p-5 header-logo">
          <img src="{{asset('/assets/logo/ELeiloes_logo_print.png')}}" style="width: 100%; height:auto" ; />
        </div>
        <div class="header-text d-flex align-items-center justify-content-end p-4 ">
          <div class="d-flex flex-column w-100 ">
            <div class="text-xsmall text-end">
              <i class="bi bi-geo-alt-fill text-secondary me-2"></i> Rua Luisa Tody, 12G, 2925-568 Azeitão, Portugal
            </div>
            <div class="text-xsmall text-end">
              <i class="bi bi-telephone-fill text-secondary"></i> (+351) 93 4981100 <span class="fw-bold"> | </span><i class="text-secondary bi bi-envelope-at-fill my-4"></i> geral@eclecticaleiloes.com
            </div>
          </div>
        </div>
      </div>
      {{-- Conteúdo --}}
      <div class="sheet-content text-justify text-small">

        {!! $lote->main_lang_desc !!}

      </div>
    </section>
  </div>

</body>

</html>