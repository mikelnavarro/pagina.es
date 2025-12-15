// Referencias a los elementos HTML por su ID
const inputNombre = document.getElementById("busquedaNombre");
const pokemonId = document.getElementById("pokemon-id");
const pokemonName = document.getElementById("pokemon-name");
const pokemonSprite = document.getElementById("pokemon-sprite");
const pokemonType = document.getElementById("pokemon-types");
const pokemonCulo = document.getElementById("pokemon-culo");

// Url de API
let urlApi = "https://pokeapi.co/api/v2/pokemon";

/**
 * Obtiene y muestra un Pokémon basado en su ID o nombre.
 */
const obtenerMostrar = async (inputNombre) => {
  if (!inputNombre) {
    pokemonName.textContent = "Introduce un ID o nombre para buscar.";
    pokemonType.textContent = "N/A";
    pokemonSprite.src = "placeholder.png";
    return;
  }
  // Usamos el input directamente en la URL de la API
  const url = `${urlApi}/${inputNombre.toLowerCase()}/`;
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
    console.error(error); // Muestra el error en consola para depuración
    pokemonName.textContent = "Error: Pokémon no encontrado o problema de red.";
    pokemonType.textContent = "N/A";
    pokemonCulo.src = "placeholder.png";
    pokemonSprite.src = "placeholder.png";
  }
};

// En esta ruta de la API no nos viene el id de cada pokemon, pero si que nos viene
// una URL, para poder obtener todos los datos de ese pokemon, la cual contiene su ID
// así que le extraigo el ID a la URL
function getPokemonId(url) {
  return url.split("/").filter(Boolean).pop();
}

// Función auxiliar para mantener el código limpio
const actualizarDOM = (pokemonData) => {
  const id = getPokemonId(pokemonData.species.url);
  // Actualizar texto, nombre formateado
  pokemonName.textContent = pokemonData.name.toUpperCase();
  pokemonId.textContent = id;

  // Actualizar la imagen (src y alt)
  pokemonSprite.src = pokemonData.sprites.front_default || "placeholder.png"; // Usamos sprites.front_default
  pokemonCulo.src = pokemonData.sprites.back_default;
  pokemonSprite.alt = `Imagen de ${pokemonData.name}`;
  // Actualizar tipo
  if (pokemonData.types && pokemonData.types.length > 0) {
    pokemonType.textContent = `${pokemonData.types[0].type.name}`;
  } else {
    pokemonType.textContent = "Tipo: N/A";
  }
};
// Función que lee el input del usuario y llama a obtenerMostrar.
if (inputNombre) {
  inputNombre.addEventListener("keyup", () => {
    const busquedaValor = inputNombre.value.trim();
    obtenerMostrar(busquedaValor);
  });

  // Cargar un Pokémon inicial al cargar la página (ej. Bulbasaur)
  obtenerMostrar("1");
} else {
  console.error("El input 'busquedaNombre' no se encontró en el HTML.");
}
