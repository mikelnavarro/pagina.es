// 1. CONFIGURACIÓN (Variables que no cambian)
const TMDB_CONFIG = {
  BASE_URL: "https://api.themoviedb.org/3",
  IMAGE_URL: "https://image.tmdb.org/t/p/w500",
  OPTIONS: {
    method: "GET",
    headers: {
      accept: "application/json",
      Authorization: `Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI2Y2I3NTkwNjQxNDI5MzkwNDc1YzQ3OTI2NzU0NmUzOCIsIm5iZiI6MTc2Nzk3MzkzNy45OCwic3ViIjoiNjk2MTI0MzE3ZWQyY2MwNWY3MzY0MTAxIiwic2NvcGVzIjpbImFwaV9yZWFkIl0sInZlcnNpb24iOjF9.x5dlUTPogbnLsvla7OrBbfVGOnE9AJE0Zj_4hzlfxNw`,
    },
  },
};
// REFERENCES
const inputNombre = document.getElementById("busqueda-titulo");
const error_mensaje = document.getElementById("error");
// endpoints
const endpoints = {
  popular: "/movie/popular",
  topRated: "/movie/top_rated",
  upcoming: "/movie/upcoming",
  trending: "/trending/movie/week",
  search: "/search/movie",
};
// 2. SERVICIO DE DATOS (Fetch puro)
async function getMovies(endpoint) {
  const response = await fetch(
    `${TMDB_CONFIG.BASE_URL}${endpoint}`,
    TMDB_CONFIG.OPTIONS
  );
  if (!response.ok) {
    throw new Error("Error en la petición");
  }
  try {
    const data = await response.json();
    return data.results; // Retornamos directamente los resultados
  } catch (error) {
    (error.textContent = "Error al obtener datos:"), error;
  }
}

// 3. RENDERIZADO
function renderGallery(movies) {
  const container = document.getElementById("contenedor-peliculas");
  container.innerHTML = ""; // Limpiar antes de pintar

  if (movies.length === 0) {
    const noResults = document.createElement("p");
    noResults.textContent = "No se encontraron películas.";
    container.appendChild(noResults);
    return;
  }

  movies.forEach((movie) => {
    // IMPORTANTE: Creamos elementos NUEVOS en cada vuelta del bucle
    const card = document.createElement("div");
    card.className = "pelicula-card";
    card.style.cursor = "pointer"; // Hacer que parezca clickeable
    card.addEventListener("click", () => {
      window.location.href = `card.html?id=${movie.id}`;
    });

    const img = document.createElement("img");
    img.src = movie.poster_path
      ? `${TMDB_CONFIG.IMAGE_URL}${movie.poster_path}`
      : "placeholder.png";
    img.alt = movie.title;
    const title = document.createElement("h3");
    title.textContent = movie.title;
    const id = document.createElement("span");
    id.textContent = movie.id;
    const rating = document.createElement("p");
    rating.textContent = `${movie.vote_average.toFixed(1)}`;
    // EXTRAER EL AÑO
    const releaseYear = document.createElement("p");
    releaseYear.textContent = movie.release_date;


    card.appendChild(img);
    card.appendChild(title);
    card.appendChild(id);
    card.appendChild(rating);
    card.appendChild(releaseYear);
    // 6. Añadir la tarjeta al contenedor principal (section)
    container.appendChild(card);
  });
}

// 4. INICIALIZADOR (Controla el flujo)
async function initApp() {
  // Aquí puedes cambiar el endpoint fácilmente para probar otros
  const movies = await getMovies("/movie/upcoming?language=es-ES&page=1");
  renderGallery(movies);
}



// Ejecutar al cargar el DOM
document.addEventListener("DOMContentLoaded", initApp);

