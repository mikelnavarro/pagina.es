"use strict";
// IMPORTAMOS
import { Libro } from "./Libro.js";
const sectionData = document.getElementById("section");
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
    sectionData.innerHTML = "";
    lista.innerHTML = "";
    if (arrayLibros.length === 0) {
    lista.textContent = "No hay libros registrados.";
    return;
    }
    arrayLibros.forEach((libro) => {
    let section = document.createElement("section");
    let div = document.createElement("div");
    div.textContent = `${libro.nombre} - ${libro.numPaginas} - ${libro.prestamo}`;
    sectionData.appendChild(lista);
    lista.appendChild(div)
    });

}


    cargarDesdeLocalStorage();
    mostrarElementos();
