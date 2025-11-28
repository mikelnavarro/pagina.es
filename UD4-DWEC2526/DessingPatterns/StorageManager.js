import { ProductFactory } from "./ProductFactory.js";
export class StorageManager {
  save(arrayProductos) {
    localStorage.setItem("arrayProductos", JSON.stringify(arrayProductos));
  }

  load() {
    const data = JSON.parse(localStorage.getItem("arrayProductos"));

    if (data) {
      arrayProductos.forEach((elemento) => {
        const product = new ProductFactory(elemento.name, elemento.price);
        return product;
      });
    }
  }

  clear() {
    localStorage.removeItem("arrayProductos");
  }
}
