import { Storage } from "./Storage.js";
import { DOMFacade } from "./DOMFacade.js";

const storage = new Storage();
let arrayProductos = storage.load() || [];
// Borrar Productos
document.getElementById("borrarTodo").addEventListener("click", (event) => {
  storage.clear();
  storage.load();
  window.location.reload();
});