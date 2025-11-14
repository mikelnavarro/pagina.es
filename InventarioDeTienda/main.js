import { CartObserver } from "./cartObserver.js";
import { Producto } from "./Producto.js";
const formularioProducto = document.getElementById("formulario-inventario");
const nombreInput = document.getElementById("nombre");
const precioBaseInput = document.getElementById("precioBase");
const categoriaProSelect = document.getElementById("categoriaProducto");
const sectionListar = document.getElementById("lista-productos");
const DivProducto = document.getElementById("producto-individual");
const buttonLimpiarLocal = document.getElementById("limpiarLocal");
const sectionTotal = document.getElementById("total");


let arrayProductos = [];
const cart = [];
const cartObs = new CartObserver();
cartObs.subscribe(total => {
    document.getElementById("total").textContent = total + "$";
});
function addToCart(producto){
    cart.push(producto);
    const total = cart.reduce((s, p) => s + p.precioConIVA, 0);
    cartObs.notify(total);
    mostrarProductos(producto);
}

function cargarEnLocalStorage() {
  const datos = localStorage.getItem("arrayProductos");

  if (datos) {
    const objetos = JSON.parse(datos);

    arrayProductos = objetos.map((obj) => {
      const p = new Producto(obj.nombre, obj.precioBase, obj.categoria);
      p.generarCodigoProducto();
      p.fechaCreacion = new Date(obj.fechaCreacion);
      p.calcularPrecioIVA();
      addToCart(p);
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
  agregarProducto(nombre, precioBase, categoriaProducto);ç
  formularioProducto.reset();
});
/* Funcion Para Mostrar */
function mostrarProductos() {
  sectionListar.classList.add("lista-productos");
  sectionListar.innerHTML = "";
  if (arrayProductos.length === 0) {
    sectionListar.innerHTML = "<p>No hay productos a mostrar.</p>";
    return;
  }
  // Mostrar los productos
  arrayProductos.forEach((p) => {
    const div = document.createElement("div");
    const botonEliminar = document.createElement("button");
    botonEliminar.textContent = "Eliminar";
    botonEliminar.classList.add("borrarProducto");
    div.classList.add("producto-card");
    div.innerHTML = `
            <p>Código: ${p.generarCodigoProducto()}</p>
            <p>Producto: ${p.nombre}</p>
            <p>Categoria: ${p.categoria}</p>
            <p>Precio + IVA: ${p.precioConIVA.toFixed(2)}</p>
            <p>Precio Base: ${p.precioBase}</p>
            <p>Fecha (en español): ${p.formatearFechaCreacion()}</p>
    `;
    div.appendChild(botonEliminar);
    sectionListar.appendChild(div);
    botonEliminar.addEventListener("click", function (event) {
      event.preventDefault();

      borrarProducto();

      guardarEnLocalStorage();
      mostrarProductos();
    });
  });
}
/* Funcion Para Agregar Productos */
function agregarProducto(nombre, precioBase, categoria) {
  // Llama a la funcion
  const producto = new Producto(nombre, precioBase, categoria);
  producto.generarCodigoProducto();
  producto.formatearFechaCreacion();
  producto.calcularPrecioIVA();
  arrayProductos.push(producto);
  guardarEnLocalStorage();
  mostrarProductos();
}




/* Funcion Eliminar */
function borrarProducto() {
  arrayProductos.forEach((p) => {
    let id = p.generarCodigoProducto();
    if (p.generarCodigoProducto()) {
      arrayProductos.pop(p.generarCodigoProducto());
    }

  });
}
buttonLimpiarLocal.addEventListener("click", function (e) {
  e.preventDefault();
  localStorage.removeItem("arrayProductos");
});




// Ejecutamos la carga inicial al arrancar
cargarEnLocalStorage();
mostrarProductos();


function calcularTotal() {
  arrayProductos.forEach((p) => {
    const precio = p.calcularPrecioIVA();
    const total = document.createElement("section");
    total.classList.add("total");
    total.innerHTML = `
          <p><strong>${precio}</strong></p>`;
  });
  sectionTotal.appendChild(total);

}
calcularTotal();