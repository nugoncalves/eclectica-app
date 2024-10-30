// FILTRAR POR CÓDIGOS
$(document).on('keydown', function ( e ) {
  if ((e.metaKey || e.ctrlKey) && ( String.fromCharCode(e.which).toLowerCase() === 'f') ) {
  $("#offcanvas_filtros").offcanvas('show');
  }
});

//Copy Verbete
function verbeteToLote(){
  var idVerbete = document.getElementById('idVerbete').value;
  var nomeVerbete = document.getElementById('nomeVerbete').innerHTML;
  var descricaoPT = descricaoVerbetePT.getData();
  var descricaoEN = descricaoVerbeteEN.getData();
  var verbete_id = document.getElementById('verbete_id');
  var tagsVerbete = document.getElementById('tags_verbete').value
  verbete_id.value = idVerbete;
  main_lang_name.innerHTML = nomeVerbete;
  editor.setData(descricaoPT);
  editorEN.setData(descricaoEN);
  tags.value  = tagsVerbete;

  document.getElementById('main_form').submit();
};

