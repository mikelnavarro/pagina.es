let urlApi = "https://pokeapi.co/api/v2/pokemon";
fetch(urlApi)
  .then((response) => response.json())
  .then((json) => {
    printPokemons(json.results);
  });
// En esta ruta de la API no nos viene el id de cada pokemon, pero si que nos viene
// una URL, para poder obtener todos los datos de ese pokemon, la cual contiene su ID
// así que le extraigo el ID a la URL
function getPokemonId(url) {
  return url.split("/").filter(Boolean).pop();
}

// Pinta todos los pokemos insertando un HTML dentro del #container
function printPokemons(pokemons) {
  const container = document.getElementById("container");

  pokemons.forEach((pokemon) => {
    const id = getPokemonId(pokemon.url);

    container.innerHTML += `
      <div class="card">
        <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/${id}.png" alt="${
      pokemon.name
    }">
        <span>Nº.${id}</span>
        <h2>${pokemon.name.charAt(0).toUpperCase() + pokemon.name.slice(1)}</h2>
      </div>
    `;
  });
}
