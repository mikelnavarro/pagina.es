import { Pokemon } from "./Pokemon.js";
import { GuardarPokemon } from "./Storage.js";


// VARIABLES
const formulario = document.getElementById("formPokemon");
const storage = new GuardarPokemon();
const listaPokemon = document.getElementById("lista-pokemon");
const buttonLimpiarLocal = document.getElementById("borrarTodos");
const busqueda = document.getElementById("campoBuscar");

let arrayPokemon = storage.load() || [];
// FORMULARIO
formulario.addEventListener("submit", (e) => {
    e.preventDefault();
    const nombreInput = document.getElementById("nombre").value;
    const tipoInput = document.getElementById("tipo").value;
    const nivelInput = document.getElementById("nivel").value;

    if (!nombreInput) return alert("Debe completar el campo Titulo.");
    addPokemon(nombreInput, tipoInput, nivelInput);
});

// Función de añadir un pokémon
function addPokemon(nombre, tipo, nivel) {
    const pokemon = new Pokemon(nombre, tipo, nivel);
    arrayPokemon.push(pokemon);
    storage.save(arrayPokemon);
    mostrarElementos(arrayPokemon);
}
// Función de mostrar los elementos
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
// Botón que limpia todo
buttonLimpiarLocal.addEventListener("click", function () {
    storage.remove(arrayPokemon);
});
// Búsqueda
busqueda.addEventListener("keyup", function (event) {
    const texto = event.target.value.toLowerCase();
    const filtrados = arrayPokemon.filter((pk) =>
        pk.nombre.toLowerCase().includes(texto) || pk.tipo.toLowerCase().includes(texto)
    );
    mostrarElementos(filtrados);
});
storage.load();
mostrarElementos(arrayPokemon);