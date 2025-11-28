import { ProductFactory } from "./ProductFactory.js";
export class Storage {
  save(arrayProductos) {
    localStorage.setItem("arrayProductos", JSON.stringify(arrayProductos));
  }

  load() {
    const data = JSON.parse(localStorage.getItem("arrayProductos"));


    if (data) {
      return data.map(elemento => {
        const product = new ProductFactory(elemento.name, elemento.price);
        product.id = elemento.id;
        product.fechaProducto = elemento.fechaProducto;
        product.horaProducto = elemento.horaProducto;
        product.finalPrice = elemento.finalPrice;
        return product;
      });
    }
  }

  clear() {
    localStorage.removeItem("arrayProductos");
  }
}
