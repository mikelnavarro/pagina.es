const prompt = require('prompt-sync')();
/*
Si queremos utilizar funciones que nos ayudarán a:
- Reorganizar el código
- Reutilizar
- Mantener mejor las funciones si hay que cambiar la lógica */


function restar(a, b) {
    return a - b;
}
console.log(restar(1, 2));





// Elevar al cuadrado

let elevarAlCuadrado = function (numero) {
    return numero * numero;
};

console.log(elevarAlCuadrado(7));