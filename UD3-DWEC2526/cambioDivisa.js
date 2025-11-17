
'use strict';

import { DIVISA_EURO, DIVISA_DOLAR, DIVISA_LIBRA, EURO_TO_DOLLAR, LIBRA_TO_DOLLAR } from "./constantes.js";
// funcion cambar de divisa
function cambioDivisa(divisaFrom,divisaTo,monto){
    switch (divisaFrom) {
        case DIVISA_EURO:
            if (divisaTo===DIVISA_EURO) {
                return monto * matrix[0][0];
            } else if (divisaTo===DIVISA_DOLAR){
                return monto * matrix[0][2];
            } else if (divisaTo===DIVISA_LIBRA){
                return monto * matriz[0][1];
            }
            break;
        case DIVISA_LIBRA:

            break;
        case DIVISA_DOLAR:

            break;
        default:
            alert("Elige una divisa");
            break;
    }
}

function generarMatrizIntercambioDivisas() {
    // Generar la maatriz para intercambiar las divisas restantes
    // Clave-Valor


    // Ejemplo:
    
    return [
    [1, EURO_TO_DOLLAR / LIBRA_TO_DOLLAR, EURO_TO_DOLLAR],
    [LIBRA_TO_DOLLAR / EURO_TO_DOLLAR, 1, LIBRA_TO_DOLLAR],
    [1 / EURO_TO_DOLLAR, 1 / LIBRA_TO_DOLLAR, 1],
     ];

}

