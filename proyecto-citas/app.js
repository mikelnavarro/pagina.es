// IMPORTAR CLASE PERSONA
import { Persona } from "./Persona.js";
// Preparameos el JavaScript
// Obtenemos elementos del DOM
const formulario = document.getElementById("form");
const nombreInput = document.getElementById("nombre");
const apellidoInput = document.getElementById("primerapellido");
const dniInput = document.getElementById("dni");
const listaCitas = document.getElementById("lista-citas");



// Creamos el Array
let arrayPersonas = [];

function cargarDesdeLocalStorage() {
  const datos = localStorage.getItem("arrayPersonas");

  if (datos) {
    const objetos = JSON.parse(datos); // Aquí vuelve a objeto simple

    // Convertimos los objetos en personas
    arrayPersonas = objetos.map(
      (obj) => new Persona(obj.nombre, obj.apellido, obj.dni)
    );
  }
}

function guardarEnLocalStorage() {
  // SOLO se usa dentro de esta funcion, cada vez que se quiera guardar una persona
  localStorage.setItem("arrayPersonas", JSON.stringify(arrayPersonas));
  // Y solo guarda el array cuando se lo pidas, no antes
}

function agregarPersona(nombre, apellido, dni) {
  // Agrega al arrayPersonas
  // Llama a la funcion que guarda
  const persona = new Persona(nombre, apellido, dni);
  arrayPersonas.push(persona);
  guardarEnLocalStorage();
}

function mostrarPersonas() {
  listaCitas.innerHTML = "";

  arrayPersonas.forEach((p) => {
    const div = document.createElement("div");
    // Después de crear el element div
    div.textContent = `${p.nombre} - ${p.apellido} - ${p.dni}`;
    // Agregamos al elemento padre appendChild(div); que se encarga de añadir
    listaCitas.appendChild(div);
  });
}

formulario.addEventListener("submit", function (e) {
  e.preventDefault(); // Previene que se recargue la página del formulario

  const nombre = nombreInput.value.trim();
  const apellido = apellidoInput.value.trim();
  const dni = dniInput.value.trim();

  // Comprobamos que los campos no están vacíos
  if (nombre === "" || apellido === "" || dni === "") {
    alert("Rellena todos los campos.");
    return;
  }
  agregarPersona(nombre, apellido, dni);
  // Mostramos (creada despues)
  mostrarPersonas();
  formulario.reset();
});

// Ejecutamos la carga inicial al arrancar
cargarDesdeLocalStorage();
mostrarPersonas();
