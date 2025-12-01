
/*
===
Dados dos numeros enteros left y right, devuelve el RECUENTO DE NUMEROS
en el rango inclusivo que tienen un numero primo de bits establecidos
en SU REPRESENTACION BINARIA.

Recuerda que el NUMERO de bits establecidos que tien un numero entero es el
NUMERO DE 1 PRESENTE CUANDO se escribe en binario

Tiene que hacer:

leftNum = 6, rightNum = 10
Salida sera 4
*/

let rightNum = 10;
let leftNum = 6;
/*
function pasarBinario(leftNum) {
    
    // Comprobacion de que no sea numero negativo
    if (leftNum < 0 && rightNum < 0) {
        return 0;
    }
    // Convertir el numero en binario
    let binLeft = leftNum.toString(2);


    return binLeft;

} */



function contarBits(rightNum, leftNum) {
    let contarNum = 0;


    // Comprobacion de que no sea numero negativo
    if (leftNum < 0 && rightNum < 0) {
        return 0;
    }
    // incrementar el numero izquierda => numero derecha
    // 6=10
    for (let i = leftNum; i <= rightNum; i++) {
        let contador = 0;
        // Convertir el numero en binario
        let binLeft = i.toString(2);
        console.log(i + " --" + binLeft);

        // Si bit igual a 1
        for (let bit of binLeft) {
            if (bit == '1') {
                contador++;






                // Comprobar contador es numero Primo
                
                if (contador === 1) {
                    false;
                }
                for (let j = 2; j <= contador; j++) { // For recorre
                    if ((contador % j) === 0) {
                        contarNum++; // Lo cuenta
                    } else { // si no
                        false; // falso
                    }
                }
            }
        }
    }

    return contarNum;
}
console.log(contarBits(rightNum, leftNum));
