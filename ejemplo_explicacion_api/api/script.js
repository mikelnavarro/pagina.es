
// Referencias a los elementos HTML por su ID
const pokemonId = document.getElementById("pokemon-id");
const pokemonName = document.getElementById("pokemon-name");
const pokemonSprite = document.getElementById("pokemon-sprite");
const pokemonType = document.getElementById("pokemon-types");

// Url de API
let urlApi = "https://pokeapi.co/api/v2/pokemon";


const obtenerMostrar =  async (id) => {
    const url = `https://pokeapi.co/api/v2/pokemon/${id}/`;

    // 1. Intentar obtener los datos

    try {
        const response = await fetch(url);

        if (!response.ok) {
            throw new Error("Pokemon no encontrado");
        }

        // Los Datos
        const data = await response.json();

        // 2. Manipular El DOM
        actualizarDOM(data);
    } catch (error) {
        pokemonName.textContent = 'Error: Pokémon no encontrado o problema de red.';
        pokemonSprite.src = 'via.placeholder.com';
        pokemonId.textContent = 'N/A';
        pokemonType.textContent = 'N/A';

    }

}

// Función auxiliar para mantener el código limpio

const actualizarDOM = (pokemonData) => {
    // Actualizar texto, nombre formateado
    pokemonName.textContent = pokemonData.name.toUpperCase();
    pokemonId.textContent = pokemonData.id;


    // Actualizar la imagen (src y alt)
    pokemonSprite.src = pokemonData.sprites.front_default;
    pokemonSprite.alt = `Imagen de ${pokemonData.name}`;

}
// 4. Llamar a la función al cargar la página (ejemplo con Pikachu, ID 25)
obtenerMostrar(25);