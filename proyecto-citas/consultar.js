// IMPORTAR clase persona
import { Persona } from "./Persona.js";
const SectionPersonas = document.getElementById("lista-citas");



let arrayPersonas = [];
function cargarDesdeLocalStorage() {
  const datos = localStorage.getItem("arrayPersonas");

  if (datos) {
    const objetos = JSON.parse(datos); // Aquí vuelve a objeto simple
    arrayPersonas = objetos.map(
      (obj) => new Persona(obj.nombre, obj.apellido, obj.dni)
    );
  }
}
function mostrarElementos() {
  SectionPersonas.innerHTML = "";

  arrayPersonas.forEach((p) => {
    const div = document.createElement("div");
    div.textContent = `${p.nombre} - ${p.apellido} - ${p.dni}`;
    SectionPersonas.appendChild(div);
  });
}
cargarDesdeLocalStorage();
mostrarElementos();
