// Crear el botón
const boton = document.createElement("button");
const elemento = document.getElementById("idPalabras");
const liPalabras = ["Spain", "Germany", "France", "Italy", "Russia", "Turkey"];
function mostrarElementos(){

  const indiceAleatorio = Math.floor(Math.random() * liPalabras.length);
  let seleccionar = liPalabras[indiceAleatorio];
  elemento.textContent = seleccionar;
}
mostrarElementos();
// Añadir texto
boton.textContent = 'Haz clic aquí';

// Añadir atributos
boton.id = 'mi-boton';
boton.className = 'btn btn-primary';

// Añadir estilos CSS
boton.style.backgroundColor = '#007bff';
boton.style.color = 'white';
boton.style.padding = '10px 20px';
boton.style.border = 'none';
boton.style.borderRadius = '5px';

// Añadir al DOM
document.body.appendChild(boton);


/* Creacion de Elementos */


function moverLaPalabra(){
    let randomY = Math.random() * window.screen.height;
    let randomX = Math.random() * window.screen.width;
    elemento.style.position = "absolute";
    elemento.style.top = Math.floor(randomY) + "px";
    elemento.style.left = Math.floor(randomX) + "px";
    elemento.classList.add("elemento");
}
moverLaPalabra();