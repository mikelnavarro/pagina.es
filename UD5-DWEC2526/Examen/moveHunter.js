import { Hunter } from "./Hunter.js";




// --- IMAGE 1 ---
// Una sola bola
const container = document.getElementById("principal");
const miImagen = new Hunter("boat.png", "bola verde", 50, 50, 3, 2);
// Animación
setInterval(() => {
  miImagen.move(container, 50, 50); // width/height de la imagen
}, 20);
