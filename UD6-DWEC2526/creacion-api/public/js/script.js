// Referencias
const IdLibro = document.getElementById("libro-id");
const title = document.getElementById("libro-titulo");
const autor = document.getElementById("libro-autor");
const lista = document.getElementById("lista-libros");

async function cargarLibros() {
  try {
    const response = await fetch("/api/libros");
    // Comprobamos si la respuesta es ok o no
    if (!response.ok) {
      throw new Error("No existe ese libro");
    }
    // Obtenemos los datos
    const data = await response.json();

    // 2. Manipular El DOM
    mostrarDom(data);
  } catch (error) {
    console.error("Error al cargar libros:", error);
  }
}
cargarLibros();
function mostrarDom(data) {
  lista.innerHTML = "";

  data.forEach((libro) => {
    // Crear nuevos elementos para cada libro
    const li = document.createElement("li");

    // Crear elementos para el ID, título y autor del libro actual
    const IdLibro = document.createElement("span");
    const title = document.createElement("h2");
    const autor = document.createElement("span");

    IdLibro.textContent = `${libro._id}`;
    title.textContent = `${libro.titulo}`;
    autor.textContent = `Autor: ${libro.autor}`;

    IdLibro.className = "libro-id";
    title.className = "libro-titulo";
    autor.className = "libro-autor";
    li.appendChild(IdLibro);
    li.appendChild(title);
    li.appendChild(autor);

    // Añadir el li a la lista
    lista.appendChild(li);
  });
}
