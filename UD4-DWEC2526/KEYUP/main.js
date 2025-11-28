import { ProductFactory } from "./ProductFactory.js";
import { Storage } from "./Storage.js";
import { DOMFacade } from "./DOMFacade.js";
// VARIBALES INCIALIZADAS
const storage = new Storage();
const formulario = document.getElementById("form-producto");
const arrayProductos = storage.load() || [];

// Evento formulario
formulario.addEventListener("submit", function (e) {
  e.preventDefault();
  const nombre = document.getElementById("nombre").value;
  const precio = document.getElementById("precio").value;
  const categoria = document.getElementById("categoria").value;
  const descuento = parseFloat(document.getElementById("descuento").value);

  let product = new ProductFactory.create(nombre,precio,categoria,descuento);
  
  product.calcularPrecioFinal();
  product.generarCodigo();
  arrayProductos.push(product);
  storage.save(arrayProductos);
  DOMFacade.mostrar(arrayProductos);
});
