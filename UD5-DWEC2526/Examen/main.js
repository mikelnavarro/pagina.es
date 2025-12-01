import { Storage } from "./Storage.js";
import { Grid } from "./Grid.js";
import { Jugador } from "./Jugador.js";
import { Hunter } from "./Hunter.js";


const storage = new Storage();
const divgrid = document.getElementById("grid");

// --- IMAGE 1 ---
const container = document.getElementById("canvas2"); // puede ser <main>
const miImagen = new Hunter("boat.png", "bola verde", 50, 50, 3, 2);

// Animación
setInterval(() => {
  miImagen.move(container, 50, 50); // width/height de la imagen
}, 20);


// Generacion grid
function generateGrid() {
  let randomY = Math.random() * window.screen.height;
  let randomX = Math.random() * window.screen.width;
  divgrid.style.display = Grid;
  divgrid.style.gridColumn
  divgrid.style.position = "absolute";
  divgrid.style.top = Math.floor(randomY) + "px";
  divgrid.style.left = Math.floor(randomX) + "px";



  /* --- ESTILOS CSS GRID 
              display: grid;
            gap: 20px 40px;
            grid-template-columns: auto auto auto;
            padding: 20px;
            margin-top: 50px;
            margin-bottom: 50px;
            background-color: dodgerblue;
    */
}
