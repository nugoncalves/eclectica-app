// Sidebar MENU toggle
//  Fecha ou abre o MENU ao pressionar botão
$(function () {
  $('#sidebarCollapse').on('click', function () {
    $('#sidebar, #content').toggleClass('active');
  });
});

//   Muda o aspeto do botão se SideBar Aberto ou fechado
//   Usa a interceção do sidebar com a lateral do ecrã como trigger
const observerSideBar = new IntersectionObserver(function (entries) {
  button = document.getElementById('sidebarCollapse');
  if (entries[0].intersectionRatio === 0)
    button.classList.remove("opened");
  else if (entries[0].intersectionRatio === 1)
    button.classList.add("opened");
}, {
  threshold: [0, 1]
});

observerSideBar.observe(document.querySelector("#sidebar"));


// Reduz ou aumenta o tamanho do Header de Conteúdo no scroll
//   Usa a interceção do header com o elemento stickyToogler
const observerSectionTitle = new IntersectionObserver(function (entries) {
  buttons = document.querySelectorAll(".titleMenuButton");
  title = document.getElementById("titleMenu");
  if (entries[0].intersectionRatio === 0)
    buttons.forEach(b => { b.classList.add("btn-sm") }),
      document.querySelector("#titleMenu").classList.replace("h3", "h4");
  else if (entries[0].intersectionRatio === 1)
    buttons.forEach(b => { b.classList.remove("btn-sm") }),
      document.querySelector("#titleMenu").classList.replace("h4", "h3");
}, {
  threshold: [0, 1]
});

observerSectionTitle.observe(document.querySelector(".stickyToogler"));