<?php
include 'Hobby.php';
include_once 'Cine.php';
include_once 'Acciones.php';
include_once 'ContadorTiempo.php';
session_start();
$_SESSION['enviado'] = md5(microtime());


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pelicula = $_POST["pelicula"];
    $duracion = $_POST["duracion"];
    $area = $_POST["area"];
    $lugar = $_POST["lugar"];
    $horas = $_POST["horas"];
    $enviado = $_POST["enviado"];


    $name = $_FILES["fichero"]["name"];
    $type = $_FILES["fichero"]["type"];
    $size = $_FILES["fichero"]["size"];
    $tmp = $_FILES["fichero"]["tmp_name"];
    $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
    // --- COMPROBAR EXTENSIÓN ---  
    /* La función pathinfo() sirve para descomponer una ruta o un nombre de archivo en sus partes (directorio, nombre base, extensión…)
    PATHINFO_EXTENSION: devuelve solo la parte después del último punto.
    Por qué usar strtolower() ==> Para evitar problemas con mayúsculas y minúsculas
    $ext es la extensión del fichero
    Tipo MIME de PDF: (application/pdf)
    */
    if ($ext != ".pdf" &&
     $type != "application/pdf") {
        echo "Debe ser PDF.";
        return;
    }


    // --- COMPROBAR SI EXISTE ---
    /* (__FILE__): Es una variable mágica de PHP
    Devuelve la ruta completa (absoluta) del archivo actual
    ===
    dirname(__FILE__): Devuelve solo la carpeta donde está el archivo actual. Si subidos estuviera en el mismo nivel, sería simplemente ==>/subidos/
    $dir . $name ==> Esto junta la ruta del directorio con el nombre del archivo, para tener la ruta completa donde se guardará el fichero
    Ejemplo de resultado: /xampp/htdocs/practica_formulario/subidos/documento.pdf
    ===
    */
    $dir = dirname(__FILE__) . "/subidos/";
    $destino = $dir . $name;



    if (file_exists($destino)) {
        echo "El archivo ya existe.";
        return;
    }

    /* --- COMPROBAR TAMAÑO ---
    El tamaño del fichero
    ===
    */
    if ($size > 2 * 1024 * 1024) {
        echo "Demasiado grande (> 2MB)";
        return;
    }

    //  --- MOVER ARCHIVO ---
    /* 1. Subir el fichero al servidor
    Cómo lo hacemos
    move_uploaded_file(nombre temporal, destino final): Devuelve true o false

    */
    $res = move_uploaded_file($tmp, $destino);
    if ($res) {
        echo "<br>Fichero guardado"; // Se guardó
    } else {
        echo "<br>Error";
    }


    // --- MOSTRAR DATOS ---
    echo "<br>"
        . "Película: " . $pelicula . "<br>"
        . "Duración: " . $duracion . "<br>"
        . "Área: " . $area . "<br>"
        . "Lugar: " . $lugar . "<br>"
        . "Horas: " . $horas . "<br>"
        . "Enviado: " . $enviado . "<br>"
        . "Nombre del fichero: " . $_FILES["fichero"]["name"] . "<br>"
        . "Nombre temporal del fichero en el servidor: " . $tmp . "<br>";




} else if ($_SERVER["REQUEST_METHOD"] == "GET") {
    echo "Solo método post.";
}


// Instanciar objeto
$cine = new Cine($pelicula,$duracion,$area,$lugar,$horas);

// Añadido mágicamente
$cine->fotografia = $destino;
var_dump(isset($cine->fotografia)); // true
echo "<hr>";
echo $cine; // imprime el objeto Cine
echo "<hr>";
echo "<br><b>Ruta guardada del PDF:</b> " . $cine->fotografia . "<br>";
echo "<hr>";


/* 
--- EJERCICIO 10 --- 

*/
$dir = dirname(__FILE__) . "/subidos/"; // directorio de guardado
$archivo_serializado = $dir . "cine_serializado.txt"; // archivo TXT
$serializado = serialize($cine); // realiza la serizalizzcion
file_put_contents($archivo_serializado, $serializado);
$contenido = file_get_contents($archivo_serializado); // contenido archivo seraliz
$cine_recuperado = unserialize($contenido);
echo "Unserialize: ";
echo $cine_recuperado; // cine es recuperado
var_dump($cine_recuperado);