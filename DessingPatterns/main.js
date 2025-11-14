import { validator  } from "./validar.js";
import { applyDiscount } from "./discountDecorator.js";
import { ProductFactory } from "./ProductFactory.js";
import { CartObserver  } from "./cartObserver.js";
const formularioTienda = document.getElementById("formularioTienda");
const button = document.getElementById("addBtn");
/*
const nuevoProducto = ProductFactory.create("Camisa", 20);
console.log(nuevoProducto);
const pro = ProductFactory.create("Pantalón", 30);
const proDescuento = applyDiscount(pro,0.15);
console.log(proDescuento);
const productoCinco = ProductFactory.create("Camiseta", 45);
console.log(applyDiscount(productoCinco,0.20));
*/
const cart = [];
const cartObs = new CartObserver();
cartObs.subscribe(total => {
    document.getElementById("total").textContent = total + "$";
});
function addToCart(producto){
    cart.push(producto);
    const total = cart.reduce((s, p) => s + p.finalPrice, 0);
    cartObs.notify(total);
    renderProducto(producto);
}

function renderProducto(product) {
    const discountPercent = (product.discount * 100).toFixed(0);
    const listaTotal = document.getElementById("producto-lista");
    const div = document.createElement("div");
    div.innerHTML = 
            `<p>${product.name}</p>
            <p>Precio sin IVA: ${product.price}</p>
            <p>Precio con descuento: ${discountPercent}</p>
            <p>Precio final: ${product.finalPrice.toFixed(2)} $ </p>
            <p>ID: ${product.id}</p><br>`;
    listaTotal.appendChild(div);
}
formularioTienda.addEventListener("submit", function (e) {
    e.preventDefault();
    const div = document.createElement("div");
    const name = document.getElementById("name").value;
    const price = document.getElementById("price").value;
    const discount = parseFloat(document.getElementById("discount").value);
    

    let product = ProductFactory.create(name, price);
    product = applyDiscount(product,discount);
    product.discount = discount;
    addToCart(product);
});
