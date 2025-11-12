// 
const prompt = require('prompt-sync')();


let edadPerro = prompt("Ingresa edad del perro: ");

let edadHumana = edadPerro * 7;
console.log("Su perro tiene " + edadHumana + " años");