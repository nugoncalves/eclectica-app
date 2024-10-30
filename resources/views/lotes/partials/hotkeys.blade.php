<!-- Main HotKeys -->

<script type="text/javascript">
  hotkeys('alt+shift+f, alt+v, alt+l, alt+p', function(event, handler) {
    switch (handler.key) {
      case 'alt+shift+f': //PROCURAR POR FILTROS
        const filtros = new bootstrap.Modal('#modal_codigos');
        filtros.show();
        break;
      case 'alt+v': //ATRIBUIR VERBETE
        const verbetes = new bootstrap.Modal('#verbetes_list');
        verbetes.show();
        break;
      case 'alt+l': //NOVA COLOCAÇÃO EM LEILÃO
        let status = document.getElementById('status').value;
        if (status === 'disponível') {
          const colocacoes = new bootstrap.Modal('#modal_nova_colocacao');
          colocacoes.show();
        };
        break;
      case 'alt+p': //IMPRIMIR ETIQUETA
        break;
    }
  });
</script>