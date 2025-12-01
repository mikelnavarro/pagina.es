// IMPORTACIONES

import { Grid } from "./Grid.js";
const formulario = document.getElementById("form");

formulario.addEventListener("submit", (e) => {
  // Variables
  const filas = document.getElementById("nufilas");
  const columnas = document.getElementById("nucolumnas");
  const velocidadHunter = document.getElementById("velocidadHunter");
  const trampas = document.getElementById("trampas");

  // Validación

  validarNumeroFilas(filas);
  validarNumeroColumnas(columnas);
  validarVelocidad(velocidadHunter);

  if (!formulario.checkValidity()) {
    e.preventDefault();
    formulario.reportValidity();
    // Generacion del Grid
    let tablero = Grid.create(filas,columnas,trampas);
    window.location.replace("juego.html");
  }
});

// Función para validar
function validarNumeroFilas(filas) {
  if (filas.value === 0) {
    filas.setCustomValidity("Se esperaban más filas!");
  } else if (filas.value < 3 || filas.value > 10) {
    filas.setCustomValidity("Menor o igual a 10, mayor o igual a 3.");
  } else {
    filas.setCustomValidity("");
  }
}
function validarNumeroColumnas(columnas) {
  if (columnas.value === 0) {
    columnas.setCustomValidity("Se esperaban más columnas!");
  } else if (columnas.value < 3 || columnas.value > 10) {
    columnas.setCustomValidity("Menor o igual a 10, mayor o igual a 3.");
  } else {
    columnas.setCustomValidity("");
  }
}

function validarVelocidad(velocidadHunter) {
  if (velocidadHunter.value === 0) {
    velocidadHunter.setCustomValidity("Se esperaba más velocidad!");
  } else if (velocidadHunter.value > 800 || velocidadHunter < 200) {
    velocidadHunter.setCustomValidity("Incorrecto!");
  } else {
    velocidadHunter.setCustomValidity("");
  }
}
