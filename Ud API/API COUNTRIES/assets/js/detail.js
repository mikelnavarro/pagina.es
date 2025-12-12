const apiURL = "https://restcountries.com/v3.1/name/spain";

fetch(apiURL)
  .then((response) => response.json())
  .then((data) => {
    document.getElementById("country-name").textContent = data[0].name.official;
    document.getElementById("country-capital").textContent = data[0].capital;
    document.getElementById("country-population").textContent = data[0].population;
    document.getElementById("country-language").textContent = data[0].languages["spa"];
    document.getElementById("country-area").textContent = data[0].area;
  });


  function jngte() {
        // 1. Intentar hacer la petición a la API
    try {
        // fetch() realiza la petición GET
        const response = await fetch(API_URL + pokemonName);

        // 2. Manejar posibles errores HTTP (ej: 404 Not Found)
        if (!response.ok) {
            throw new Error(`Error HTTP: ${response.status} - Pokémon no encontrado`);
        }
} catch (error) {

}
  }
  

// script.js (añadir a continuación del código anterior)

function displayPokemon(data) {
    const resultDiv = document.getElementById('pokemonResult');
    
    // Accedemos a las propiedades específicas del objeto JSON recibido
    const name = data.name.charAt(0).toUpperCase() + data.name.slice(1);
    const id = data.id;
    const type = data.types.map(typeInfo => typeInfo.type.name).join(', ');
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
