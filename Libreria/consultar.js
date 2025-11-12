"use strict";
// IMPORTAMOS
import { Libro } from "./Libro.js";
const lista = document.getElementById("lista-datos");

let arrayLibros = [];
function cargarDesdeLocalStorage() {
    const datos = localStorage.getItem("arrayLibros");
    if (datos) {
        const objetos = JSON.parse(datos);
        arrayLibros = objetos.map(
            (obj) => new Libro(obj.nombre, obj.numPaginas, obj.prestamo)
        );
    }
}


function mostrarElementos() {
    lista.innerHTML = "";
    if (arrayLibros.length === 0) {
    lista.textContent = "No hay libros registrados.";
    return;
    }
    arrayLibros.forEach((libro) => {
    let div = document.createElement("div");
    div.textContent = `${libro.nombre} - ${libro.numPaginas} - ${libro.prestamo}`;
    lista.appendChild(div)
    });

}


    cargarDesdeLocalStorage();
    mostrarElementos();
