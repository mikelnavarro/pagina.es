const prompt = require('prompt-sync')();
/* Queremos crear un objeto en JavaScript de vehiculo con sus
características:
1. Marca
2. Modelo
3. Año
4. Plazas
5. Color
6. Combustible

Luego mostrar por pantalla la frase del coche, cómo es
*/


let car = {
    marca: "Mercedes",
    modelo: "Benz",
    anio: 2023,
    plazas: 4,
    combustible: "Diesel",
};




const carJSON = JSON.stringify(car);
console.log(carJSON);
console.log(car.modelo);



/* =ARRAY= 
===
=== */



let frutas = [
    "Manzana",
    "Pera",
    "Sandia",
    "Melon",
    "Kiwi",
    "Albaricoque",
    "Aguacate"
];
frutas.push("Mandarina");
console.log(frutas);
frutas.push("Naranja");
console.log(frutas);



for (let i = 1; i <= frutas.length - 1; i++){

    console.log(i + ". " + frutas[i]);
}


let numeros = [6, 34, 5, 6, 39, 92, 91];
numeros.sort((a, b) => a -b);
console.log(numeros);



// Bucle FOR

let array = [1, 2, 3];
for (let i = 0; i < array.length; i++) {


    console.log("Iteracion: " + i + ": " + array[i]);
    console.log(array.indexOf(array[i]));
    console.log(array.lastIndexOf(array[i]));


}


