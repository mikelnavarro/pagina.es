"use sctrict";
import { Libro } from "./Libro.js";

// Definimos las variables del DOM
const crear = document.getElementById("formulario");
const nombreInput = document.getElementById("nombre");
const pagInput = document.getElementById("pag");
const prestamoInput = document.getElementById("prestamo");

let arrayLibros = [];

function guardarEnLocalStorage() {
  localStorage.setItem("arrayLibros", JSON.stringify(arrayLibros));
}

function agregarUnLibro(nombre, numPaginas, prestamo) {
  const libro = new Libro(nombre, numPaginas, prestamo);
  arrayLibros.push(libro);
  guardarEnLocalStorage();
}

crear.addEventListener("submit", function (event) {
  event.preventDefault(); // Previene por defecto

  const nombre = nombreInput.value.trim();
  const numPaginas = parseInt(pagInput.value);
  const prestamo = prestamoInput.checked;
  if (nombre === "" || isNaN(numPaginas)) {
    alert("Rellena todos los campos.");
    return;
  }

  agregarUnLibro(nombre, numPaginas, prestamo);
  crear.reset();
});
