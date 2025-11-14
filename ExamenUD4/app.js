import { Pokemon } from './Pokemon.js';
import { GuardarPokemon } from './Storage.js';

const formulario = document.getElementById("formularioPokemon");
const storage = new GuardarPokemon();
const listaPokemon = document.getElementById("lista-pokemon");
const buttonLimpiarLocal = document.getElementById("borrarTodos");
const filtrado = document.getElementById("busqueda");




let arrayPokemon = storage.load() || [];
formulario.addEventListener("submit", (e) => {
    e.preventDefault();
    const nombreInput = document.getElementById("nombre").value;
    const tipoInput = document.getElementById("tipoSelect").value;
    const nivelInput = document.getElementById("nivel").value;


    if (!nombreInput) return alert("Debe completar el campo Titulo.");
    addPokemon(nombreInput,tipoInput,nivelInput);
});

/* Función Añadir */
function addPokemon(nombre, tipo, nivel) {
    const pokemon = new Pokemon(nombre, tipo, nivel);
    arrayPokemon.push(pokemon);
    storage.save(arrayPokemon);
    mostrarElementos();
}
function mostrarElementos() {
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
buttonLimpiarLocal.addEventListener("click", function () {
    storage.remove(arrayPokemon);
    storage.load();
    mostrarElementos();
});

/*
filtrado.addEventListener("keyup", function (e) {ç
    e.preventDefault();
    const tipo = filterPriority.value;
    mostrarElementos(pok => {
        if (tipo === "") return true;
        return pok.tipo === tipo;
    });
});


*/
storage.load();
mostrarElementos();