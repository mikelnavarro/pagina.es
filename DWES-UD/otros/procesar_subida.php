<?php

// El tamaño del fichero
$tam = $_FILES["fichero"]["size"];

if ($tam > 256 * 1024) {
    echo "<br>Demasiado grande";
    return;
}


echo "Nombre del fichero: " . $_FILES["fichero"]["name"];
echo "<br>Nombre temporal del fichero en el servidor: " . $_FILES["fichero"]["tmp_name"];
// Resultado: guardar archivo movido al directorio del servidor 
$res = move_uploaded_file($_FILES["fichero"]["tmp_name"],"subidos/".$_FILES["fichero"]["name"]);



// Condiciones para comprobar si se guardó
if ($res){
    echo "<br>Fichero guardado";
} else{
    echo "<br>Error";
}
?>