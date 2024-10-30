import Autocomplete from "./autocomplete.js";

Autocomplete.init();

// Diminui tamanho do Title Menu
const observer = new IntersectionObserver(function (entries) {
  buttons = document.querySelectorAll(".titleMenuButton");
  title = document.getElementById("titleMenu");
  // no intersection 
  if (entries[0].intersectionRatio === 0)
    buttons.forEach(b => { b.classList.add("btn-sm") }),
      document.querySelector("#titleMenu").classList.replace("h3", "h4");
  else if (entries[0].intersectionRatio === 1)
    buttons.forEach(b => { b.classList.remove("btn-sm") }),
      document.querySelector("#titleMenu").classList.replace("h4", "h3");
}, {
  threshold: [0, 1]
});

observer.observe(document.querySelector(".stickyToogler"));

document.addEventListener('DOMContentLoaded', function() {
    let isFormEdited = false;
    const form = document.getElementsByTagName('form');
    console.log(form);

    // Detecta mudanças no formulário
    form.addEventListener('change', function() {
        isFormEdited = true;
    });

    // Reseta o estado do form quando enviado
    form.addEventListener('submit', function() {
        isFormEdited = false;
    });

    // Intercepta o evento de descarregamento da página
    window.addEventListener('beforeunload', function(e) {
        if (isFormEdited) {
            const confirmationMessage =
                'Você tem alterações não salvas. Tem certeza que deseja sair?';
            e = confirmationMessage;
            return confirmationMessage;
        }
    });
});
