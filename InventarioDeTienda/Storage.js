import { CartObserver } from "./cartObserver.js";
import { Producto } from "./Producto.js";
export class Storage {
  save(arrayProductos) {
    localStorage.setItem("arrayProductos", JSON.stringify(arrayProductos));
  }
  load() {
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
}
