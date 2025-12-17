<?php


require "Conexion.php";
require "Libro.php";
require "modificar.php";
/*

PHP incorpora funciones muy sencillas para leer y escribir ficheros, tanto en formato normal (líneas de texto) como en formato CSV.
fopen("archivo", "w") → abre o crea el archivo para escribir

fputcsv() → escribe una línea en CSV automáticamente separada por comas

fclose() → cierra el archivo

*/
$letras = ["A,B,C,D,E,F,G,H,I,J,K,L,M,N,Ñ,O,P,Q,R,S,T,U,V,W,Y,Z"];

$list = [
    ["aaa","bbb","ccc","dddd"],
    ["123","456","789"],
    ['"aaa"', '"bbb"']
];
$archivo = fopen("file.csv", "w");
fputcsv($archivo, $list, " ");

$archivo = fopen("datos.csv", "w");
fputcsv($archivo, ["hola", "qué tal"], ";");

// ESCRIBIMOS
$archivo = fopen("libros.csv", "r");
while (($fila = fgetcsv($archivo)) !== false) {
    print_r($fila);
}


fclose($archivo);
$archivo = fopen("libros.csv", "w");
fputcsv($archivo, ["id", "titulo", "autor", "paginas"]);
fputcsv($archivo, [1, "El Quijote", "Cervantes", 863]);
fclose($archivo);

// Escribir el contenido
$archivo = fopen("log.txt", "a");
fwrite($archivo, "Acceso registrado\n");
fclose($archivo);

// Leer el contenido
$contenido = file_get_contents("log.txt");
echo $contenido;