import { ProductFactory } from "./ProductFactory.js";
export class Storage {
  save(arrayProductos) {
    localStorage.setItem("arrayProductos", JSON.stringify(arrayProductos));
  }

  load() {
    const data = JSON.parse(localStorage.getItem("arrayProductos"));


    if (data) {
      return data.map(elemento => {
        const product = new Product(elemento.name, elemento.price, elemento.categoria, elemento.discount);
        product.fechaCreacion = elemento.fechaCreacion;
        product.codigo = elemento.codigo;
        product.calcularPrecioFinal();
        product.generarCodigo();
        return product;
      });
    }
  }

  clear() {
    localStorage.removeItem("arrayProductos");
  }
}
