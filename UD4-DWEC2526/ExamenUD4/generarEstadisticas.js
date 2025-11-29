import { Pokemon } from "./Pokemon.js";
import { GuardarPokemon } from "./Storage.js";

// VARIABLES
const storage = new GuardarPokemon();
const arrayPokemon = storage.load() || [];
const estadisticasPokemon = document.getElementById("estadisticasPokemon");
const estadisticaAgua = document.getElementById("estadisticaAgua");
const estadisticaPlanta = document.getElementById("estadisticaPlanta");
const estadisticaFuego = document.getElementById("estadisticaFuego");
const generarEstadisticas = document.getElementById("generarEstadisticas");
generarEstadisticas.addEventListener("click", function (event) {
    mostrarEstadisticas();
});
function mostrarEstadisticas() {
    estadisticasPokemon.innerHTML = " ";
    estadisticaAgua.innerHTML = " ";
    estadisticaFuego.innerHTML = " ";
    estadisticaPlanta.innerHTML = " ";
    const estadistica = document.createElement("section")
    estadistica.classList.add("estadistica");
    estadisticaAgua.classList.add("estadistica");
    estadisticaPlanta.classList.add("estadistica");
    estadisticaFuego.classList.add("estadistica");

    estadisticaAgua.innerHTML = `<span><strong>Agua: ${agua}`;
    estadisticaPlanta.innerHTML = `<span><strong>Planta: ${planta}`;
    estadisticaFuego.innerHTML = `<span><strong>Fuego: ${fuego}`;
    estadisticasPokemon.appendChild(estadistica);
    estadisticasPokemon.appendChild(estadisticaAgua);
    estadisticasPokemon.appendChild(estadisticaPlanta);
    estadisticasPokemon.appendChild(estadisticaFuego);
}
let agua = 0;
let fuego = 0;
let planta = 0;

arrayPokemon.filter((i) => {
    const tipo = i.tipo;
    if (tipo == "agua") {
        agua++;
    } else if (tipo == "planta") {
        planta++;
    } else if (tipo == "fuego") {
        fuego++;
    }
});
