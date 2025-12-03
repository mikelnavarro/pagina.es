<?php
/* Ejercicio 1: */
$list = [
    ["aaa", "bbb", "ccc", "dddd"],
    ["123", "456", "789"],
    ['"aaa"', '"bbb"']
];


$archivo = fopen("datos.csv", "w");
fputcsv($archivo, ["hola", "qué tal"], ";");


/* Ejercicio 2: */
$alfabeto = str_split("ABCDEFGHIJKLMNÑOPQRSTUVWXYZ");
$letras = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "Ñ", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z"];
$contador = 0;
$archivo = fopen("file.csv", "w");
$bloque = [];
$contador = 0;
for ($i = 0; $i <= count($letras); $i++) {
    $bloque[] = $letras[$i];
    $contador++;
    if ($contador === 5) {
        fputcsv($archivo, $bloque, " ");
        $bloque = [];
        $contador = 0;
    }
}


// Si quedan letras en el bloque (menos de 5) al final
if (!empty($bloque)) {
    fputcsv($archivo, $bloque, " ");
}
fclose($archivo);
echo "CSV generado correctamente.";
?>