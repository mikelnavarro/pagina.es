// Referencias DOM
const pais = document.getElementById("country-card");
const flag = document.getElementById("country-flag");
const countryName = document.getElementById("country-name");
const countryCapital = document.getElementById("country-capital");
const inputNombre = document.getElementById("busquedaNombre");
const population = document.getElementById("country-population");
const countryCoat = document.getElementById("country-coat");
const area = document.getElementById("country-area");
const countryLanguage = document.getElementById("country-language");
const countryNameOfficial = document.getElementById("country-oficial");
const currency = document.getElementById("country-currency");
const urlApi = "https://restcountries.com/v3.1/name";
const checkS = document.getElementById("status-estado");
const subregion = document.getElementById("ubica");
// Obtener datos
async function getDatos(inputNombre) {
  if (!inputNombre) {
    countryName.textContent = "Introduce un nombre.";
    countryCapital.textContent = "N/A";
    coatOfArms.textContent = "placeholder.png";
    currency.textContent = "N/A";
    flag.src = "placeholder.png";
    return;
  }
  // Usamos el input directamente en la URL de la API
  const url = `${urlApi}/${inputNombre.toLowerCase()}/`;
  // 1. Intentar obtener los datos

  try {
    const response = await fetch(url);
    if (!response.ok) {
      throw new Error("País no encontrado");
    }

    // Los Datos
    const data = await response.json();

    // 2. Manipular El DOM
    dibujaCards(data[0]);
  } catch (error) {
    console.error(error); // Muestra el error en consola para depuración
    countryName.textContent = "País no encontrado";
    countryCapital.textContent = "N/A";
    flag.src = "placeholder.png";
  }
}
// En esta ruta de la API no nos viene el id de cada nación, pero si que nos viene
// una URL, para poder obtener todos los datos de ese paises, la cual contiene su ID
// así que le extraigo el ID a la URL
function getCountry(url) {
  return url.split("/").filter(Boolean).pop();
}
function dibujaCards(paises) {
  // Actualizar texto, nombre formateado
  countryName.textContent = paises.translations.spa.official;
  // Actualizar la capital del país
  countryCapital.textContent = paises.capital;
  countryLanguage.textContent = paises.languages.language;
  countryNameOfficial.textContent = paises.name.official;
  (population.textContent = new Intl.NumberFormat("es-ES", {
    maximumSignificantDigits: 3,
  }).format(paises.population)),
    (area.textContent = new Intl.NumberFormat("es-ES").format(paises.area));

  // Actualizar la imagen (src y alt)
  flag.src = paises.flags.png || "placeholder.png"; // Usamos sprites.front_default
  flag.alt = paises.flags.alt || `Bandera de ${paises.name.official}`;
  countryCoat.src = paises.coatOfArms.png;
  countryCoat.alt = `Escudo de ${paises.translations.spa.common}`;

  // Subregion
  subregion.innerHTML = paises.subregion;
  // 1. Extraer las monedas (obtiene un array de objetos de moneda)
  const monedas = Object.values(paises.currencies);
  // 2. Acceder al nombre y símbolo de la primera moneda disponible
  if (monedas.length > 0) {
    const nombreMoneda = monedas[0].name; // Ejemplo: "Mexican peso"
    const simboloMoneda = monedas[0].symbol; // Ejemplo: "$"
    currency.textContent = `${nombreMoneda} (${simboloMoneda})`;
  }
  const status = paises.status;
  if (paises.status === "officially-assigned") {
    checkS.innerHTML = "";
  }
}

// Función que lee el input del usuario y llama a obtenerMostrar.
if (inputNombre) {
  inputNombre.addEventListener("keyup", () => {
    const busquedaValor = inputNombre.value.trim();
    getDatos(busquedaValor);
  });

  // Cargar un Pokémon inicial al cargar la página (ej. Bulbasaur)
  getDatos("spain");
} else {
  console.error("El input 'busquedaNombre' no se encontró en el HTML.");
}
