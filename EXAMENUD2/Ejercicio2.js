"use strict";
/* Ejercicio 2:
===
Se te proporciona una array de enteros de longitud n.

La diferencia media del índice i es la diferencia absoluta entre la media de
los primeros i + 1 elementos de nums y la media de los últimos n - i - 1
elementos. Ambas medias deben redondearse al entero más cercano.
Devuelve el índice con la diferencia media mínima. Si hay varios índices de
este tipo, devuelve el más pequeño.
Nota:
===
La diferencia absoluta de dos números es el valor absoluto de su diferencia.
El promedio de n elementos es la suma de los n elementos dividida (división
entera) por n(número de elementos).El promedio de 0 elementos se
considera 0.
===
===
*/

/*
sumaTotal = suma de todo el array
sumaInicio = 0

Para cada i:
   sumaInicio += nums[i]    // suma de 0 a i
   sumaFin = sumaTotal - sumaInicio

*/
// [2,5,3,9,5,3];
let nums = [2, 5, 3, 9, 5, 3];
function indiceDiferenciaMinima(nums) {
  let size = nums.length;
  let sumaTotal = nums.reduce(
    (acumulador, valorActual) => acumulador + valorActual,
    0
  );
  // VARIABLES
  let mejorDiff = Infinity;
  let sumaFin = 0;
  let sumaInicio = 0;
  let mejorIndice = 0;
  let mediaFin = 0;
  let mediaInicio = 0;

  // for array
  for (let i = 0; i < size; i++) {
    sumaInicio += nums[i]; // suma los primeros
    sumaFin = sumaTotal - sumaInicio; // suma de lo que queda

    mediaInicio = Math.floor(sumaInicio / (i + 1)); // calcular la media de la suma de ese inicio
    let elementosFin = size - i - 1; // obtiene los elementos finales

    if (elementosFin > 0) {
      mediaFin = Math.floor(sumaFin / elementosFin);
    } else {
      mediaFin = 0;
    }

    // calcular diferencia (media)
    // si calculamos mediaInicio menos mediaFin nos sale diferencia absoluta para diferencia nums
    let diff = Math.abs(mediaInicio - mediaFin);
    // abs para evitar número negativo
    // PROCEDIMIENTO
    console.log("i =", i);
    console.log("Elementos inicio:", nums.slice(0, i + 1));
    console.log("Elementos fin   :", nums.slice(i + 1));
    console.log("sumaInicio =", sumaInicio);
    console.log("sumaFin =", sumaFin);
    console.log("mediaInicio =", mediaInicio);
    console.log("mediaFin =", mediaFin);
    console.log("diff =", diff);
    console.log("mejorDiff actual =", mejorDiff);
    console.log("mejorIndice actual =", mejorIndice);

    if (diff < mejorDiff) {
      // ¿es mayor diferencia de mejorDiff?
      mejorDiff = diff; // update
      mejorIndice = i; // guardamos el indice actual porque, de momento, es el mejor candidato
      console.log("Nuevo mejor índice:", mejorIndice);
    }
  }
  return mejorIndice;
}
console.log("Resultados: " + indiceDiferenciaMinima(nums));











/*
Mostrar el Primer procedimiento

console.log(nums);
const suma = nums.reduce((acumulador, valorActual) => {
  console.log(`Paso: acumulador = ${acumulador}, valorActual = ${valorActual}`);
  return acumulador + valorActual;
}, 0);
*/

/*
OTRA FORMA
===
let suma = 0;
for (const numero of nums) {
  suma += numero;
}
*/
