import { Producto } from './Producto.js';
export class Storage {
    
    save(arrayProductos){
        localStorage.setItem("arrayProductos", JSON.stringify);
    }
    load(){
        const data = JSON.parse(localStorage.getItem("arrayProductos"));

    return arrayProductos.map((producto) => {
        const produc = new Producto(producto.nombre,producto.pais,producto.precioBase,producto.IVA,producto.discount);
        produc.generarCodigo();
        produc.formatear();
        addToCart(produc);
    });
    }
    eliminar(){
        localStorage.removeItem("arrayProductos");
    }
}