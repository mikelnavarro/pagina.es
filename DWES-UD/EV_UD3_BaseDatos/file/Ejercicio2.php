<?php
/* Ejercicio 2: */

$archivo = fopen("file.csv", "r");
fscanf($archivo, "%s %c", $linea, $letra);
echo $letra;

// Crea un directorio
if (!is_dir("letras")) {
    mkdir("letras");
    echo "directorio generado";
}


// trim($linea): Quita saltos de línea al final de cada línea.
// file_exists: evita sobrescribir archivos existentes.
// Cada letra tiene su propio archivo letra.txt dentro de letras/.
while (($linea = fgets($archivo)) !== false) {  // lee línea por línea
    $letras = explode(" ", trim($linea));
    foreach ($letras as $letra) {
        $rutaLetra = "letras/$letra.txt";
        if (!file_exists($rutaLetra)) {
            $f = fopen($rutaLetra, "w");
            fwrite($f, $letra);
            fclose($f);
        }
    }
}
rewind($archivo);  // vuelve al inicio del archivo CSV

if (!is_dir("copiasletras")) {
    mkdir("copiasletras");
}

while (($linea = fgets($archivo)) !== false) {
    $letras = explode(";", trim($linea));


    foreach ($letras as $letra) {
        $origen = "letras/$letra.txt";
        $destino = "copiasletras/$letra.txt";
        if (file_exists($origen)) {
            copy($origen, $destino);
        }
    }
}



fclose($archivo);
$archivos = scandir("letras");  // lista todos los archivos y carpetas
print_r($archivos);
/*
===
glob("$carpeta/*.txt") → lista todos los archivos .txt en "letras".
*/
// Carpeta donde están los archivos
$carpeta = "letras";
// Obtenemos todos los archivos .txt
$archivos = glob("$carpeta/*.txt");
foreach ($archivos as $archivo) {
    echo "Archivo: " . basename($archivo) . "\n";
    $contenido = file_get_contents($archivo);
    echo "Contenido: " . $contenido . "\n";
    echo "---------------------\n"; 
}
