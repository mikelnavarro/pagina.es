// Referencia
const urlApi = "";
fetch(urlApi)
  .then((response) => response.json())
  .then((json) => {
    print(json.results);
  });

function print() {
  paises.forEach((country) => {
    container.innerHTML += `
      <div class="card">
        <img src=${country.flags.png} alt="${country.name.common}">
        <span>Nº.${country.name.common}</span>
        <h2>${
          country.name.common.charAt(0).toUpperCase() +
          country.name.common.slice(1)
        }</h2>
      </div>
    `;
  });
}

// En esta ruta de la API no nos viene el NOMBRE DE cada Country, pero si que nos viene
// Una URL, para poder obtener todos los datos de ese country, la cual contiene su ID
// así que le extraigo el ID a la URL
function getCountry(url) {
  return url.split("/").filter(Boolean).pop();
}
