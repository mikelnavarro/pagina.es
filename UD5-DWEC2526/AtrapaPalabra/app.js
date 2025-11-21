const palabraInput = document.getElementById("atrapaLaPalabra");
const liPalabras = ["Spain", "Germany", "France", "Italy", "Russia", "Turkey"];


const pantallaPrincipal = document.querySelectorAll(".container");
function mostrarElementos() {
  pantallaPrincipal.classList.add("container");
  const span = document.createElement("span");
  liPalabras.forEach((palabra) => {
    span.textContent = random(palabra);
  });

  pantallaPrincipal.appendChild(span);
}

/* Creacion de Elementos */
function moveIt(event) {
  let randomY = Math.random() * window.screen.height;
  let randomX = Math.random() * window.screen.width;
  btn.style.position = "absolute";
  btn.style.top = Math.floor(randomY) + "px";
  btn.style.left = Math.floor(randomX) + "px";
}
function generar() {
  const spanPalabras = "";
  spanPalabras.innerHTML = "";
  const div = document.createElement("div");
  div.classList.add("divClassPalabra");
  liPalabras.forEach((palabra) => {
    div.textContent = Math.random() * palabra;
  });
}
mostrarElementos();
generar();
