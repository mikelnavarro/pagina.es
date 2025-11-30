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
    const h2 = document.createElement("h2");
    // Estadisticas Class
    h2.classList.add("h2");
    estadisticaAgua.classList.add("estadistica");
    estadisticaPlanta.classList.add("estadistica");
    estadisticaFuego.classList.add("estadistica");
    
    h2.textContent = `Estadísticas`;
    estadisticaAgua.innerHTML = `<span><strong>Agua \tPromedio nivel: ${agua}</span>`;
    estadisticaPlanta.innerHTML = `<span><strong>Planta: \tPromedio nivel: ${planta}</span>`;
    estadisticaFuego.innerHTML = `<span><strong>Fuego: \tPromedio nivel: ${fuego}</span>`;


    estadisticasPokemon.appendChild(h2);
    estadisticasPokemon.appendChild(estadisticaAgua);
    estadisticasPokemon.appendChild(estadisticaPlanta);
    estadisticasPokemon.appendChild(estadisticaFuego);
}
let agua = 0;
let fuego = 0;
let planta = 0;

arrayPokemon.filter((i) => {
    const nivel = i.nivel;
    const tipo = i.tipo;
    if (tipo == "agua") {
        agua++;
    } else if (tipo == "planta") {
        planta++;
    } else if (tipo == "fuego") {
        fuego++;
    }
    /* Nivel Estadística */
    const promedioNivel = 0;
    if (tipo == "agua") {
        agua = Math.abs(nivel).toFixed(1);
    } else if (tipo == "planta") {
        planta = Math.abs(nivel).toFixed(1);
    } else if (tipo == "fuego") {
        fuego = Math.abs(nivel).toFixed(1);
    }
});
