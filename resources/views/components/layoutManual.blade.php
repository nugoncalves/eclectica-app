<!-- Página de Manual do Utilizador -->

@props(['baseRoute' => ''])

<!DOCTYPE html>
<html lang="pt">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manual App Ecléctica</title>

  <link rel="icon" type="image/x-icon" href="{{ asset('assets/logo/ELeiloes-simbolo-cor.png') }}">

  <!-- STYLES CSS -->

  <!-- BOOTSTRAP CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

  <!-- MY STYLE CSS -->
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">

  <!-- SIDEBAR STYLE CSS -->
  <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">

  <!-- BOOTSTRAP ICONS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

  <!-- FONT AWESOME ICONS -->
  <script src="https://kit.fontawesome.com/075e68d52a.js" crossorigin="anonymous"></script>

  <!-- MATERIAL ICONS -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

  <!-- JQUERY LIBRARY -->
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

  <!-- BOOTSTRAP JAVASCRIPT -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</head>

<body>
  <!-- SideBar -->
  @include('manual.partials.sideBar')

  <!-- Conteúdo da Página -->
  <div class="page-content p-0 p-lg-5" id="content">

    {{$slot}}

  </div> <!-- Fim do Conteúdo da Página -->


</body>

{{-- JS Sidebar --}}
<script src="{{ asset('js/sidebar.js') }}"></script>

{{-- JS Global --}}
<script src="{{ asset('js/global.js') }}"></script>

{{-- HTMX Import --}}
<script src=" https://unpkg.com/htmx.org@1.9.9" integrity="sha384-QFjmbokDn2DjBjq+fM+8LUIVrAgqcNW2s0PjAxHETgRn9l4fvX31ZxDxvwQnyMOX" crossorigin="anonymous"></script>

<!-- HTMX Multi Update -->
<script src="https://unpkg.com/htmx.org@1.9.12/dist/ext/multi-swap.js"></script>

<!-- Main HotKeys 
## Shortcuts globais, comuns a todos os módulos
## para shortcuts específicos ver, no respectivo módulo o ficheiro hotkeys.blade.php
-->
<script type="text/javascript">
  // Módulos Navigate
  hotkeys('c,a,l,o,p,v', function(event, handler) {
    switch (handler.key) {
      case 'c':
        event.preventDefault();
        window.location.href = '/clientes';
        break;
      case 'a':
        window.location.href = '/leiloes';
        break;
      case 'l':
        window.location.href = '/lotes';
        break;
      case 'o':
        window.location.href = '/contratos';
        break;
      case 'p':
        break;
      case 'v':
        window.location.href = '/verbetes';
        break;
    }
  });
</script>