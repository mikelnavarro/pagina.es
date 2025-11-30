const prompt = require('pcd rompt-sync')();



let peso = parseInt(prompt("Peso en kg: "));
let altura = parseFloat(prompt("Altura en metros: "));



let indiceMasa = peso / (Math.pow(altura, 2));
console.log("Su IMC es: " + indiceMasa);
