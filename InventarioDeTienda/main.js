import { Producto } from "./Producto.js";
const formularioProducto = document.getElementById("formulario-inventario");
const nombreInput = document.getElementById("nombre");
const precioBaseInput = document.getElementById("precioBase");
const categoriaProSelect = document.getElementById("categoriaProducto");
const sectionListar = document.getElementById("lista-productos");
const DivProducto = document.getElementById("producto-individual");
const buttonLimpiarLocal = document.getElementById("limpiarLocal");
let arrayProductos = [];

function cargarEnLocalStorage() {
  const datos = localStorage.getItem("arrayProductos");

  if (datos) {
    const objetos = JSON.parse(datos);

    arrayProductos = objetos.map((obj) => {
      const p = new Producto(obj.nombre, obj.precioBase, obj.categoria);
      p.fechaCreacion = new Date(obj.fechaCreacion);
      p.calcularPrecioIVA();
      return p;
    });
  }
}

/* Guardar Datos localStorage() */
function guardarEnLocalStorage() {
  localStorage.setItem("arrayProductos", JSON.stringify(arrayProductos));
}
/* Leer El Formulario */
formularioProducto.addEventListener("submit", function (event) {
  event.preventDefault();

  const nombre = nombreInput.value.trim();
  const precioBase = precioBaseInput.value.trim();
  const categoriaProducto = categoriaProSelect.value;

  if (!nombre || !precioBase || !categoriaProducto) {
    alert("Rellena todos los campos.");
    return;
  }
  if (precioBase < 0) {
    alert("Precio No Válido.");
    return;
  }
  agregarProducto(nombre, precioBase, categoriaProducto);
  formularioProducto.reset();
});

/* Funcion Para Mostrar */
function mostrarProductos() {
  sectionListar.innerHTML = "";
  sectionListar.classList.add("producto-card");
  if (arrayProductos.length === 0) {
    sectionListar.innerHTML = "<p>No hay productos a mostrar.</p>";
    return;
  }
  // Mostrar los productos
  arrayProductos.forEach((p) => {
    const div = document.createElement("div");
    div.classList.add("producto-card");
    div.innerHTML = `
            <p>Producto: ${p.nombre}</p>
            <p>Categoria: ${p.categoria}</p>
            <p>Precio + IVA: ${p.precioConIVA.toFixed(2)}</p>
            <p>Precio Base: ${p.precioBase}</p>
            <p>Fecha (en español): ${p.formatearFechaCreacion()}</p>
    `;
    div.style.backgroundColor = "#f0f0f0";
    div.style.border = "1px solid #ccc";
    div.style.padding = "1rem";
    sectionListar.appendChild(div);
  });
}
/* Funcion Para Agregar Productos */
function agregarProducto(nombre, precioBase, categoria) {
  // Llama a la funcion
  const producto = new Producto(nombre, precioBase, categoria);
  producto.formatearFechaCreacion();
  producto.calcularPrecioIVA();
  arrayProductos.push(producto);
  guardarEnLocalStorage();
  mostrarProductos();
}
buttonLimpiarLocal.addEventListener("click", function (e) {
  e.preventDefault();
  localStorage.removeItem("arrayProductos");
});

// Ejecutamos la carga inicial al arrancar
cargarEnLocalStorage();
mostrarProductos();