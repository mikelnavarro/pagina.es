import { ProductFactory } from "./ProductFactory.js";
import { Storage } from "./Storage.js";
import { DOMFacade } from "./DOMFacade.js";
// Mostrar filtrados
// Evento KeyUp para búsqueda
const storage = new Storage();
const arrayProductos = storage.load() || [];
const categoriaFilter = document.getElementById("categoriaFilter");
const busqueda = document.getElementById("busqueda");
busqueda.addEventListener("keyup", function (event) {
  const texto = event.target.value.toLowerCase();

  const filtrados = arrayProductos.filter((pro) =>
    pro.name.toLowerCase().includes(texto)
  );
  DOMFacade.mostrar(filtrados);
});
categoriaFilter.addEventListener("change", function (event) {
  const categoria = event.target.value;

  const filtrados = arrayProductos.filter((pro) =>
    pro.categoria.includes(categoria)
  );

  DOMFacade.mostrar(filtrados);
  // Filtrado
  resultado.textContent = `Te gusta el sabor ${event.target.value}`;
});
