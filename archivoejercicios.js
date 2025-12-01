"use strict";

/*

ARCHIVO EJERCICIO

*/


/*
Mostrar el Primer procedimiento

console.log(nums);
const suma = nums.reduce((acumulador, valorActual) => {
  console.log(`Paso: acumulador = ${acumulador}, valorActual = ${valorActual}`);
  return acumulador + valorActual;
}, 0);
*/
function isCercana(cadenaOrigen, cadenaResultado) {
  if (cadenaOrigen.length !== cadenaResultado.length) {
    return false;
  }
  const arrayCadenaOrigen = cadenaOrigen.split("");
  const arrayCadenaResultado = cadenaResultado.split("");
  const mapaLetrasOrigen = GenerarMapaFromArrayLetras(arrayCadenaOrigen);
  const mapaLetrasResultado = GenerarMapaFromArrayLetras(arrayCadenaResultado);

  if (mapaLetrasOrigen !== mapaLetrasResultado){
    return "No son Cercanas";
  } else {
    return "Son cercanas";
  }
}


function GenerarMapaFromArrayLetras(array) {
  const mapaLetras = new Map();
  for (let index = 0; index < array.length; index++) {
    const element = array[index];
    if (mapaLetras.has(element)) {
      mapaLetras.set(element, mapaLetras.get(element) + 1);
    } else {
      mapaLetras.set(element, 1);
    }
  }
  return mapaLetras;
}
console.log(isCercana("cabbba", "abbccc"));
