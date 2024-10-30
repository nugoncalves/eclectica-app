<!-- TÍTULO E MENU DA SECÇÃO -->

<!-- Funcionalidade para Sticky Header -->
<div class="stickyToogler mb-0 mb-lg-3" id="stickyToogler"></div>

<!-- Início Header de Conteúdo -->
<nav class="container navbar navbar-expand-lg pageNav sticky-top d-flex align-items-center justify-content-around justify-content-sm-between p-3" id="pageNav">
  <!-- Title -->
  <a href="{{$baseRoute}}{{$query}}" class="h3 text-decoration-none link-dark m-0 py-0 px-3" id="titleMenu"><strong>{{$title}}</strong></a>

  <!-- Buttons -->
  <div class="d-flex justify-content-center justify-content-sm-end">
    <ul class="nav d-flex justify-content-center">

      {{ $slot ?? ""}}

    </ul>
  </div>
</nav> <!-- Fim Header de Conteúdo -->