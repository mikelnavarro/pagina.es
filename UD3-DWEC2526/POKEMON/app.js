import { Pokemon } from "./Pokemon.js";
import { GuardarPokemon } from "./Storage.js";

// Variables almacenadas
const formulario = document.getElementById("formPokemon");
const storage = new GuardarPokemon();
const listaPokemon = document.getElementById("lista-pokemon");
const buttonLimpiarLocal = document.getElementById("borrarTodos");
const filtrado = document.getElementById("campoBuscar");

// Conjunto de Pokémon
let arrayPokemon = storage.load() || [];

// Formulario SUBMIT
formulario.addEventListener("submit", (e) => {
  e.preventDefault();
  const nombreInput = document.getElementById("nombre").value;
  const tipoInput = document.getElementById("tipo").value;
  const nivelInput = document.getElementById("nivel").value;

  if (!nombreInput) return alert("Debe completar el campo Titulo.");
  addPokemon(nombreInput, tipoInput, nivelInput);
});

// Añadir Elementos
function addPokemon(nombre, tipo, nivel) {
  const pokemon = new Pokemon(nombre, tipo, nivel);
  arrayPokemon.push(pokemon);
  storage.save(arrayPokemon);
  mostrarElementos(arrayPokemon);
}
// Mostrar Elementos
function mostrarElementos(arrayPokemon) {
  listaPokemon.innerHTML = "";
  if (arrayPokemon.length === 0) {
    listaPokemon.innerHTML = "<p>No hay productos a mostrar.</p>";
    return;
  }
  arrayPokemon.forEach((pokemon) => {
    const div = document.createElement("div");
    div.classList.add("card");
    div.innerHTML = `
            <p class="p-title"><strong>${pokemon.nombre}</strong><p>
            <p><strong>Tipo: ${pokemon.tipo}</strong></p>
            <p><strong>Nivel: ${pokemon.nivel}</strong></p>
            <p><strong>Capturado: ${pokemon.formatearFecha()}</strong></p>`;
    listaPokemon.appendChild(div);
    const ptitle = div.querySelector(".ptitle");
  });
}
// Botón que borra todos los elementos Pokémon
buttonLimpiarLocal.addEventListener("click", function () {
  storage.remove(arrayPokemon);
  mostrarElementos(arrayPokemon);
});
