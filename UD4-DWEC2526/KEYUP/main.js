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
  const descuento = parseFloat(document.getElementById("descuento").value);

  let product = new ProductFactory(nombre, precio);
  // Añadimos el descuento
  // product.descuento = applyDiscount(product,descuento);
  arrayProductos.push(product);
  storage.save(arrayProductos);
  DOMFacade.mostrar(arrayProductos);

});

