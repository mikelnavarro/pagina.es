// Configuración TMDB (igual que en script.js)
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

// Función para obtener detalles de una película por ID
async function getMovieDetails(movieId) {
  const response = await fetch(
    `${TMDB_CONFIG.BASE_URL}/movie/${movieId}?language=es-ES`,
    TMDB_CONFIG.OPTIONS
  );
  if (!response.ok) {
    throw new Error("Error al obtener detalles de la película");
  }
  return await response.json();
}

// Función para renderizar los detalles
function renderMovieDetails(movie) {
  document.getElementById("movie-poster").src = movie.poster_path
    ? `${TMDB_CONFIG.IMAGE_URL}${movie.poster_path}`
    : "placeholder.png";
  document.getElementById("movie-poster").alt = movie.title;
  document.getElementById("movie-title").textContent = movie.title;
  document.getElementById("movie-release-date").textContent = `Fecha de lanzamiento: ${movie.release_date}`;
  document.getElementById("movie-rating").textContent = `Puntuación: ${movie.vote_average.toFixed(1)}`;
  document.getElementById("movie-overview").textContent = movie.overview;
  document.getElementById("movie-genres").textContent = `Géneros: ${movie.genres.map(g => g.name).join(', ')}`;
}

// Inicializar la aplicación
async function initCard() {
  const urlParams = new URLSearchParams(window.location.search);
  const movieId = "642224";
  if (movieId) {
    try {
      const movie = await getMovieDetails(movieId);
      renderMovieDetails(movie);
    } catch (error) {
      console.error(error);
      document.getElementById("movie-details").innerHTML = "<p>Error al cargar los detalles de la película.</p>";
    }
  } else {
    document.getElementById("movie-details").innerHTML = "<p>ID de película no proporcionado.</p>";
  }
}

// Ejecutar al cargar el DOM
document.addEventListener("DOMContentLoaded", initCard);