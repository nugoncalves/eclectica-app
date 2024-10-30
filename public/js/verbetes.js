// Update NOME do Verbete

function nomeUpdate() {
  let result
  let autor = document.getElementById("author")["value"];
  let titulo = document.getElementById("title")["value"];
  let lugar = document.getElementById("place")["value"];
  let data = document.getElementById("date")["value"];
  if (!isEmpty(autor)) {
    result = autor + ". " + titulo + ". ";
  }
  else {
    result = titulo + ". ";
  }
  if (!isEmpty(lugar)) {
    result += lugar + ". " + data;
  }
  else {
    result += data;
  }
  document.getElementById("nomeVerbete")["value"] = result;
}

function newNomeUpdate() {
  nomeResumido = document.getElementById("nomeVerbete")["value"];
  if (isEmpty(nomeResumido)) {
    nomeUpdate();
  }
}


// Função para verificar de String é Vazia
function isEmpty(string) {
  return typeof string === 'string' && string.trim().length === 0;
}


// Toogle CheckBoxes
$("#chkSelectAll").on('click', function () {
  this.checked ? $("input[name='select']").prop("checked", true) : $("input[name='select']").prop("checked", false);
})
