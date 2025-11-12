const prompt = require('prompt-sync')();
/*
===
Haz una función que como parámetro reciba un array de números y
obtenga el número que menos repeticiones haya tenido. En caso de
empate devuelve el número más pequeño.
===*/


const liNum = [1, 5, 3, 4, 2, 3, 4];



function menorRepeticiones(liNum) {
    let count = 0;
    let min = liNum[0];

    for (let i = 0; i <= liNum.length; i++) {
        if (liNum.indexOf(liNum[i]) == liNum.lastIndexOf(liNum[i])) {
            return liNum[i];
            if (liNum[i].length == 2) {
                return liNum[i] < min;
            }
        }
    }
}


console.log("Ej. 3 ==> " + menorRepeticiones(liNum))


/*
Dada un array de enteros, encuentra todo los numeros que aparecen un
numero impar de veces. 

*/


function imparVeces(liNum) {
    let count = 0;
    let duplicados = [];

    for (let i = 0; i <= liNum.length - 1; i++) {

        if (liNum.indexOf(liNum[i]) == liNum.lastIndexOf(liNum[i])) {
            count++;
            if (count % 2 != 0) {
                duplicados.push(liNum[i]);
            }
        }
    }
    return duplicados;
}
console.log("Ej. 4 ==> " + imparVeces(liNum))


/*
===
Implementar la funcion que toma como argumento una secuencia de enteros o String
y devuelve una lista de elementos sin ningun elemento repetido y preservando el orden original de los elementos
===*/
function menorRepeticionesOtra(liNum) {

    let min = liNum[0];
    let count = 0;
    let duplicados = [];
    for (let i = 0; i <= liNum.length - 1; i++) {

        if (liNum.indexOf(liNum[i]) == liNum.lastIndexOf(liNum[i])) {
            duplicados.push(liNum[i]);
        }
    }
    return duplicados;
}
console.log("Ej. 5 ==> " + menorRepeticionesOtra(liNum));

/*
===
Escribe una funcion que tome un parametro positivo num y
devuelva su persistencia multiplicativa, que es el numero de veces 
que debes multiplicar los digitos de num hasta llegar a un solo digito. */
let numero = 4;

function pMultiplicativa(numero) {

    // Si el número ya tiene un solo dígito, la persistencia es 0.
    if (numero < 10) {
        return 0;
    }



    let i = 0;
    while (numero >= 10) {


        let digitos = String(numero).split('').map(Number);
        let multiplicacion = digitos[i] * digitos[i]; // Multiplica los dígitos del número actual



        // Actualiza el numero para la siguiente iteracion
        numero = multiplicacion;


        i++;
    }
    return i;
}


console.log("Ej. 6 ==> " + pMultiplicativa(numero));


/*
===

Escribe una funcion que tenga como parametro una array de numeros enteros.
Tu trabajo es tomar ese array y econtrar un indice n en el que la suma de los enteros a la izquierda de n sea igual a la suma
de los enteros a la derecha de n.

Si no hay ningun indice que haga que esto ocurra, devuelve -1. Si se le
da un array con multiples respuestas, devuelve el menor indice correcto
===
Digamos que te dan el array {1,2,3,4,3,2,1}:
Tu función devolverá el índice 3, porque en la 3ª posición del array, la suma
del lado izquierdo del índice ({1,2,3}) y la suma del lado derecho del índice
({3,2,1}) son ambas iguales a 6.
Veamos otra.
Te dan el array {1,100,50,-51,1,1}:
Su función devolverá el índice 1, porque en la primera posición de la matriz,
la suma del lado izquierdo del índice ({1}) y la suma del lado derecho del
índice ({50,-51,1,1}) son ambas iguales a 1.

*/
let lista = [3, 2, 1, 1, 2, 3];

function ambosLados(lista) {
    let rightSum = 0;
    let leftSum = 0;
    let totalSum = 0;

    // Primer bucle para calcular la suma total
    for (let i = 0; i < lista.length; i++) {
        totalSum += lista[i];
    }
    console.log("Suma total: " + totalSum);
    // Segundo bucle para encontrar el índice de equilibrio
    for (let i = 0; i > lista.length; i++) {
        rightSum = totalSum - leftSum - lista[i];
        console.log("Suma derecha: " + rightSum);
        if (rightSum === leftSum) {
            return i;
        }
        leftSum += lista[i];
    }




    // Si no se encuentra un índice, devuelve -1
    return -1;
}

console.log(ambosLados(lista));