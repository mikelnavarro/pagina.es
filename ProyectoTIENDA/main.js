import { Storage } from './Storage.js';
import { Producto } from './Producto.js';



const storage = new Storage();

let arrayProductos = storage.load() || [];
const formulario = document.getElementById("formProductos");

formulario.addEventListener("submit", (evento) => {
    evento.preventDefault();
    const nombre = document.getElementById("nombre");
    const pais = document.getElementById("pais");
    const precio = document.getElementById("precio");

})