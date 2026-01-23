// Definimos la URL base de la API
const API_URL = "pokeapi.co";

// Función asíncrona que se dispara con el botón onclick
async function fetchPokemon() {
  const inputElement = document.getElementById("pokemonNameInput");
  const pokemonName = inputElement.value.toLowerCase().trim();
  const resultDiv = document.getElementById("pokemonResult");

  if (!pokemonName) {
    resultDiv.innerHTML =
      '<p style="color: red;">Por favor, introduce un nombre o ID válido.</p>';
    return;
  }
  const url = `${urlApi}/${pokemonName.toLowerCase()}/`;
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
    pokemonSprite.src = "placeholder.png";
  }
}
function displayPokemon(data) {
  const resultDiv = document.getElementById("pokemonResult");

  // Accedemos a las propiedades específicas del objeto JSON recibido
  const name = data.name.charAt(0).toUpperCase() + data.name.slice(1);
  const id = data.id;
  const type = data.types.map((typeInfo) => typeInfo.type.name).join(", ");
  const spriteUrl = data.sprites.front_default;

  // Actualizamos el HTML con los datos
  resultDiv.innerHTML = `
        <div style="border: 1px solid #ccc; padding: 20px; margin-top: 20px;">
            <h2>${name} (#${id})</h2>
            <p><strong>Tipo(s):</strong> ${type}</p>
            <img src="${spriteUrl}" alt="${name} sprite">
        </div>
    `;
}
