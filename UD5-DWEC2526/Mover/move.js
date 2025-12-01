import { Img } from './Img.js';
import { Bola } from "./Bola.js";
// --- CANVAS ---
const canvas = document.getElementById("myCanvas");
const ctx = canvas.getContext("2d");

// Posición inicial de la pelota
let x = canvas.width / 2;
let y = canvas.height - 30;
let dx = 2;
let dy = -2;


// Dibuja la pelota
function drawBall() {
    ctx.beginPath();
    ctx.arc(x, y, 10, 0, Math.PI * 2);
    ctx.fillStyle = "#0095DD";
    ctx.fill();
    ctx.closePath();
}
// Actualiza la posición de la pelota y rebota en los bordes
function draw() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    drawBall();

    x += dx;
    y += dy;

    if (x + 10 > canvas.width || x - 10 < 0) dx = -dx;
    if (y + 10 > canvas.height || y - 10 < 0) dy = -dy;
}
// Llama a draw cada 10ms
setInterval(draw, 10);
// --- CANVAS 1 ---
const canvas1 = document.getElementById("canvas1");
const ctx1 = canvas1.getContext("2d");

// Una sola bola
const bola1 = new Bola(50, 50, 2, 3, 15, "red");


function animarCanvas1() {
    ctx1.clearRect(0, 0, canvas1.width, canvas1.height);
    bola1.mover(ctx1, canvas1.width, canvas1.height);
    requestAnimationFrame(animarCanvas1);
}
animarCanvas1();
// --- IMAGEN DOM ---
const nuevaImagen = document.createElement('img');
nuevaImagen.src = "../UT5_WEB_Practico/img/Green_Circle.png";
nuevaImagen.alt = 'Una imagen de la carpeta';
nuevaImagen.style.position = "absolute";
document.getElementById("principal").appendChild(nuevaImagen);

// Velocidad de movimiento de la imagen
let vx = 3;
let vy = 2;

// Posición inicial
let imgX = 50;
let imgY = 50;

function moverImagen() {
    imgX += vx;
    imgY += vy;

    // Rebote en los bordes de la ventana
    if (imgX + nuevaImagen.width > window.innerWidth || imgX < 0) vx = -vx;
    if (imgY + nuevaImagen.height > window.innerHeight || imgY < 0) vy = -vy;

    nuevaImagen.style.left = imgX + "px";
    nuevaImagen.style.top = imgY + "px";
}
// Llama a moverImagen cada 20ms
setInterval(moverImagen, 20);
// --- IMAGE 1 ---
// Una sola bola
const container = document.getElementById("imagen1"); // puede ser <main>
const miImagen = new Img("../UT5_WEB_Practico/img/Green_Circle.png", "bola verde", 50, 50, 3, 2);

// Animación
setInterval(() => {
    miImagen.move(container, 50, 50); // width/height de la imagen
}, 20);
// --- IMAGE ---
// const imagen2 = new Img("../UT5_WEB_Practico/img/Green_Circle.png", "bola verde", 50, 50, 4, 4);
const i2 = document.getElementById("imagen1");
setInterval(() => {
    imagen2.move(i2,50, 50);
}, 20);

