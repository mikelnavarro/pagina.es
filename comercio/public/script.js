const titulo = document.getElementById("libro-titulo");
const autor = document.getElementById("libro-autor");
const anio = document.getElementById("libro-annio");
// Url de API
let urlApi = "http://localhost:3000";



/**
 * Obtiene y muestra un Pokémon basado en su ID o nombre.
 */
const obtenerMostrar = async () => {
  const url = `${urlApi}/${inputNombre.toLowerCase()}/`;

  try {
    const response = await fetch(urlApi);

    if (!response.ok) {
      throw new Error("Pokemon no encontrado");
    }

    const data = await response.json();

    actualizarDOM(data);
  } catch (error) {
    console.error(error);
    titulo.textContent = "Error: Pokémon no encontrado o problema de red.";
    autor.textContent = "Error: Pokémon no encontrado o problema de red.";
    anio.textContent = "Error: Pokémon no encontrado o problema de red.";
  }
};

const actualizarDOM = (libreriaData) => {
  autor.textContent = libreriaData.titulo;
  titulo.textContent = libreriaData.autor;
  anio.textContent = libreriaData.anio;
};
