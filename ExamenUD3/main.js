"use strict";
import { Tren } from "./Tren.js";

// Variables
const registrarTrenes = document.getElementById("registroTrenes");
const listarTrenes = document.getElementById("listadoTrenes");
const divTrenes = document.getElementById("div");
const nombreInput = document.getElementById("nombre");
const velocidadInput = document.getElementById("velocidad");
const tipoS = document.getElementById("tipo");
const buttonLimpiarLocal = document.getElementById("limpiarLocal");
const arrayTrenes = [];
/* LocalStorage() */
function cargarEnLocalStorage() {
  const datos = localStorage.getItem("arrayTrenes");
  // Comprobamos que existan Datos
  if (datos) {
    const objetos = JSON.parse(datos);

    arrayTrenes = objetos.map((obj) => {
      const t = new Tren(obj.nombre, obj.velocidad, obj.tipo);
      t.fechaAlta = new Date(obj.fechaAlta);
      return t;
    });
  }
}
function guardarEnLocalStorage() {
  localStorage.setItem("arrayTrenes", JSON.stringify(arrayTrenes));
}
function Fitrar() {

}
registrarTrenes.addEventListener("submit", function (event) {
  event.preventDefault();

  const nombreTren = nombreInput.value;
  const velocidadTren = velocidadInput.value;
  const tipoTren = tipoS.value;

  /* Comprobar
  if (!nombreTren || !velocidadTren || !tipoTren) {
    alert("Rellena todos los campos");
    return;
  }
*/

  agregarTren(nombreTren, velocidadTren, tipoTren);
  registrarTrenes.reset();
});


/* Funnción Para Mostrar Elementos */
function mostrarElementos() {
  listarTrenes.innerHTML = "";

  if (arrayTrenes.length === 0) {
    listarTrenes.innerHTML = "<p><strong>No hay Elementos</strong></p>";
  }
  arrayTrenes.forEach((tren) => {
    const divTrenes = document.createElement("div");
    divTrenes.classList.add("div");
    divTrenes.innerHTML = `
                <h3>${tren.nombre}</h3>
                <p><strong>Tipo: </strong>${tren.tipo}</p>
                <p><strong>Velocidad: </strong>${tren.velocidad} km/h</p>
                <p><strong>Fecha de alta: </strong>${tren.formatearFecha()}</p>`;

    listarTrenes.appendChild(divTrenes);
  });
}

/* Función Para Agregar Trenes */
function agregarTren(nombre, velocidad, tipo) {
  const tren = new Tren(nombre, velocidad, tipo);
  tren.formatearFecha();
  arrayTrenes.push(tren);
  guardarEnLocalStorage();
  mostrarElementos();
}
buttonLimpiarLocal.addEventListener("click", function (e) {
  e.preventDefault();
  localStorage.removeItem("arrayProductos");
  cargarEnLocalStorage();
  mostrarElementos();
});
cargarEnLocalStorage();
mostrarElementos();
