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
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Formulario Login</title>
    <link rel="stylesheet" href="estilo.css">
</head>

<body>
    <form method="POST" action="<?php echohtmlspecualchars($_SERVER["PHP_SELF"]);?>">
        <label for="pelicula">Película: </label>
        <input type="text" id="pelicula" name="pelicula"><br><br>
        <label for="duracion">Duración: </label>
        <input type="number" id="duracion" name="duracion"><br><br>
        <label for="area">Área: </label>
        <input type="text" id="area" name="area"><br><br>
        <label for="lugar">Lugar: </label>
        <input type="text" id="lugar" name="lugar"><br><br>
        <label for="horas">Horas: </label>
        <input type="number" id="horas" name="horas"><br><br>
        <input type="submit" value="Enviar">
        <!-- Parametro oculto para verificar que se ha enviado -->
        <input type="hidden" name="enviado" value="1">
        <!-- Campo Comprobacion de Envio -->
        <p name="Comprobacion"></p>
    </form>

    <?php
    echo "<br>"
    . "Película: " . $pelicula . "<br>"
    . "Duración: " . $duracion . "<br>"
    . "Área: " . $area . "<br>"
    . "Lugar: " . $lugar . "<br>"
    . "Horas: " . $horas . "<br>";
    ?>
</body>

</html>