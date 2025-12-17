
async function loadPokemons() {
  const res = await fetch("https://pokeapi.co/api/v2/pokemon");
  const data = await res.json();

  const detailedPokemons = await Promise.all(
    data.results.map(async (p) => {
      const res = await fetch(p.url);
      return await res.json();
    })
  );

  printPokemons(detailedPokemons);
}

function getPokemonId(url) {
  return url.split("/").filter(Boolean).pop();
}

function printPokemons(pokemons) {
  const container = document.getElementById("container");

  pokemons.forEach((pokemon) => {
    const id = getPokemonId(pokemon.url);

    container.innerHTML += `
      <div class="card">
        <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/${id}.png" alt="${pokemon.name}">
        <span>Nº.${id}</span>
        <h2>${pokemon.name.charAt(0).toUpperCase() + pokemon.name.slice(1)}</h2>
      </div>
    `;
  });
}
