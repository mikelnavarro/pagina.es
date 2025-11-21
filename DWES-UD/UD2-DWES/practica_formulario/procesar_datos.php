<?php    

if ($_SERVER["REQUEST_METHOD"] == "GET"){
    $enviado = $_GET['enviado'];
    if (isset($_GET['pelicula'], $_GET['duracion'], $_GET['area'], $_GET['lugar'], $_GET['horas'])){
        $pelicula = htmlspecialchars($_GET['pelicula']); // Se usa htmlspecialchars para prevenir ataques XSS
        $duracion = htmlspecialchars($_GET['duracion']);
        $area = htmlspecialchars($_GET['area']);
        $lugar = htmlspecialchars($_GET['lugar']);
        $horas = htmlspecialchars($_GET['horas']);
        echo "Se han recibido";
    } else {
        echo "Los parametros no fueron enviados";
    }
} else {
    $enviado = '0';
}


    echo "<br>"
    . "Película: " . $pelicula . "<br>"
    . "Duración: " . $duracion . "<br>"
    . "Área: " . $area . "<br>"
    . "Lugar: " . $lugar . "<br>"
    . "Horas: " . $horas . "<br>";




?>
