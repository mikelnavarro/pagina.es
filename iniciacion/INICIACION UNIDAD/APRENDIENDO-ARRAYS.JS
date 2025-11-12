
/* Inicializar un array en JavaScript */
/*
    Ejemplo: lista de animales inicializada con la forma literal (más clara y recomendada).
    - Forma literal: let lista = ["Perro", "Gato", "Caballo"];
        Es la forma más habitual y legible.
    - Alternativa: let lista = new Array("Perro", "Gato"); 
        (evitar new Array(n) porque crea un array vacío de longitud n).
    - Los arrays pueden contener distintos tipos: ["Perro", 3, true].
    - Acceso por índice: lista[0] -> "Perro" (los índices comienzan en 0).
    - Propiedades y métodos útiles:
            - lista.length -> número de elementos.
            - lista.push("Vaca") -> añade al final.
            - lista.pop() -> elimina y devuelve el último elemento.
            - lista.splice(indice, cantidad) -> elimina/insertar en medio.
    - Para inspección: console.log(lista) o console.table(lista).
*/

let lista = ["Perro", "Gato", "Caballo", "Gallina", "Pinguino"];

console.log(lista);

/**
 * @file Comentarios sobre el uso de indexOf y lastIndexOf con el array 'lenguajes'.
 *
 * @description
 * El array contiene nombres de lenguajes de programación. Se muestran ejemplos de búsqueda
 * mediante los métodos del prototipo Array:
 *
 * - Array.prototype.indexOf(searchElement)
 *   Devuelve el índice (entero >= 0) de la primera aparición de searchElement en el array.
 *   Si el elemento no se encuentra, devuelve -1.
 *
 * - Array.prototype.lastIndexOf(searchElement[, fromIndex])
 *   Devuelve el índice de la última aparición de searchElement, buscando desde el final del
 *   array o desde la posición opcional fromIndex hacia atrás. Si no se encuentra, devuelve -1.
 */
let lenguajes = ["JavaScript", "PHP", "C", "Java", "PHP", "Python", "C++", "C#"];
console.log(lenguajes.indexOf( "C"));
console.log(lenguajes.indexOf("Java"));
console.log(lenguajes.indexOf("PHP"));
console.log(lenguajes.lastIndexOf("PHP", 3));

let lista = ["Perro", "Gato", "Caballo", "Gallina", "Pinguino"];

console.log(lista);
/* Recorrer un array */


/**
 * @file Comentarios sobre el uso de indexOf y lastIndexOf con el array 'lenguajes'.
 *
 * @description
 * El array contiene nombres de lenguajes de programación. Se muestran ejemplos de búsqueda
 * mediante los métodos del prototipo Array:
 *
 * - Array.prototype.indexOf(searchElement)
 *   Devuelve el índice (entero >= 0) de la primera aparición de searchElement en el array.
 *   Si el elemento no se encuentra, devuelve -1.
 *
 * - Array.prototype.lastIndexOf(searchElement[, fromIndex])
 *   Devuelve el índice de la última aparición de searchElement, buscando desde el final del
 *   array o desde la posición opcional fromIndex hacia atrás. Si no se encuentra, devuelve -1.
 */
let lenguajes = ["JavaScript", "PHP", "C", "Java", "PHP", "Python", "C++", "C#"];
console.log(lenguajes.indexOf( "C"));
console.log(lenguajes.indexOf("Java"));
console.log(lenguajes.indexOf("PHP"));
console.log(lenguajes.lastIndexOf("PHP", 3));



