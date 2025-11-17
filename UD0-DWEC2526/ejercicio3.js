'use strict';
/*


Dos cadenas se consideran cercanas si se puede obtener una a partir de la
otra mediante las siguientes operaciones:


Operación 1: Intercambiar dos caracteres existentes.
Por ejemplo, abcde -> aecdb. (swap entre a y b)
Operación 2: Transformar cada aparición de un carácter existente en otro
carácter existente y hacer lo mismo con el otro carácter.

Por ejemplo, aacabb -> bbcbaa (todas las a se convierten en b y todas las b
se convierten en a).
Puedes utilizar las operaciones en cualquiera de las cadenas tantas veces
como sea necesario.
Dadas dos cadenas, palabra1 y palabra2, devuelve verdadero si palabra1 y
palabra2 son cercanas y falso en caso contrario.


*/
function sonCercanas(origen,fin){
    if(origen.length !== fin.length){
        return false;
        // devuelve si compara longitud
    }

    // creamos array
    // de las cadenas
    let arrayCo;
    let arrayF;
    let setCo = new Set(arrayCo.sort());
    let setCadenaFinal = new Set(arrayF());

    // metodo Set ( mirar)






}


sonCercanas("aabbccdd","ceb")