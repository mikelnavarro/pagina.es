const prompt = require('prompt-sync')();
/* Voy a tener que hacer una calculadora que pueda:
- Sumar 
- Restar
- Multiplicar
- Dividir
- Resto
*/

// Declaramos las variables
// let
let num1,
num2,
resultado;
num1 = parseInt(prompt("Introduce Numero 1: "));
num2 = parseInt(prompt("Introduce Numero 2: "));
let opcion = prompt("Introduce la operacion (-/+/%/*//) : ");


switch (opcion) {
    case '+':
        resultado = num1 + num2;
        console.log(num1 + " + " + num2 + " = " + resultado);
        break;
    case '-':
        if (num1 > num2) {
            resultado = num1 - num2;
        } else {
            resultado = num2 - num1;
        }
        console.log(num1 + " + " + num2 + " = " + resultado);
        break;
    case '*':
        resultado = num1 + num2;
        console.log(num1 + " + " + num2 + " = " + resultado);
        break;
    case '/':
        if (num1 > num2) {
            resultado = num1 /num2;
        } else {
            resultado = num2 / num1;
        }        console.log(num1 + " + " + num2 + " = " + resultado);
        break;
    case '%':

        if (num1 > num2) {
            resultado = num1 % num2;
        } else {
            resultado = num2 % num1;
        }
        console.log(num1 + " + " + num2 + " = " + resultado);
        break;
    default:
        console.log("No se introdujo nada")
        break;
}

