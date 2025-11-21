<?php

/* Enunciado
B) Genera una estructura para que haya al menos una clave cuyo valor represente
uno de estos tipos de datos:
cadena,
entero,
decimal
fecha.
---
---
Genera un catálogo de N entidades de forma aleatoria, donde N es una
constante PHP definida correctamente. Para ello:
---
B.1) Si el tipo de dato es cadena, tendrá entre 1 y 10 caracteres.
B.2) Si el tipo de dato es entero, deberá estar comprendido entre 3 y 8 dígitos.
B.3) Si el tipo de dato es decimal, la parte entera deberá tener entre 1 y 3 dígitos,
y la parte decimal entre 1 y 5 dígitos
B.4) Si el tipo de dato es tipo fecha, deberá estar comprendida entre el
01/01/2025 y el 30/09/2025
---
NOTA: usa https://www.php.net/manual/es/function.rand.php
NOTA: para determinar qué tipo de valor puede tener la clave define un único
array asociativo, cuyas claves sean los campos en forma de cadena y los valores
sean el tipo de dato que representan (también en forma de cadena). 
---
---
Por ejemplo:
$tipos = array(
"titulo" => "cadena",
"n_paginas" => "entero",
"precio" => "decimal",
"fecha_publicacion" => "fecha");

---
*/
define("N", 10);
$tipos = array(
    "titulo" => "cadena",
    "n_paginas" => "entero",
    "fecha_publicacion" => "date",
    "precio" => "decimal"
);


$libreria = array();
for  ($i = 0; $i < N; $i++) {
    $libro = array();
    foreach ($tipos as $campo => $tipo) {
        switch ($tipo) {
            case "cadena":
            $libro[$campo] = generarCadena();
                break;
            case "entero":
            $libro[$campo] = generarEntero();
                break;
            case "date":
            $libro[$campo] = generarFecha();
                break;
            case "decimal":
            $libro[$campo] = generarDecimal();
                break;
            default:
                # code...
                break;
        }
    }
}

$libreria[] = $libro;



function generarCadena() {
    $caracteres_permitidos = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $cadena = '';
    $longitud = 10;
    $cadena = substr(str_shuffle($caracteres_permitidos), 1, $longitud);
    return $cadena;
}
function generarEntero() {

    return rand(100,99999999);

}
function generarDecimal() {
    $p_decimal = rand(1,99999);
    $p_entera = rand(1,999) / pow(10, rand(1, 5));
    return $p_entera + $p_decimal;
    // pow(10, rand(1, 5)) → calcula una potencia de 10 (10 elevado a ese valor).
    // Si salió 3, hace pow(10, 3) → 1000.
    // Si salió 5, hace pow(10, 5) → 100000.


    // al dividir el número grande por esa potencia, "recortas" cuántos decimales tendrá.
    // Ejemplo: 34782 / 1000 = 34.782 (3 decimales).
    // Ejemplo: 5821 / 100000 = 0.05821 (5 decimales).
}
function generarFecha() {
    $min_date = strtotime("2025-01-01");
    $max_date = strtotime("2025-09-31");
    // timesttamp

    // Generar la Fecha
    $fecha = rand($min_date, $max_date);

    return date('Y-m-d H:i:s', $fecha);
}


foreach ($libreria as $indice => $libro) {
    echo "Libro: " . ($indice+1) . "<br>";
        foreach ($libro as $campo => $valor) {
            echo " - $campo: $valor <br>";
        }
    echo "<br>";
}
