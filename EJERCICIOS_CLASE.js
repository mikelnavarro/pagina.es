
/* Haz una funcion que calcule y devuelva el numero
de vocales en la cadena dada. Consideraremos a, e, i, o, u como vocales
La cadena de entrada solo consta de letras minusculas o espacion. */

const prompt = require('prompt-sync')();


let cadena = prompt("Cadena: ");
const vocales = [aeiou];
cadena.trim();
cadena.toLowerCase;
console.log(cadena.slice(2, 4))


for (let i = 0; i < cadena.length; i++) {

}
// Ejercicio2
/* 
Los cajeros automáticos permiten códigos PIN de 4 o 6 dígitos y los
códigos PIN no pueden contener más que exactamente 4 dígitos o
exactamente 6 dígitos. Si a la función se le pasa una cadena de PIN
válida, devuelve true, de lo contrario devuelve false.  */


let codigo = prompt("Introduce el codigo:");


function cajeroAutomatico(codigo) {
    codigo.trim();
    if ((codigo.length <= 6) || (codigo.length >= 4)) {
        return true;
    } else {
        return false;
    }
}



console.log(cajeroAutomatico(codigo));
/*
Haz una función que como parámetro reciba un array de números y
obtenga el número que menos repeticiones haya tenido. En caso de
empate devuelve el número más pequeño.
*/

let array = [1, 1, 2, 3, 3, 3, 4, 5];