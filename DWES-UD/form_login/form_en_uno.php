<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST["usuario"]=="mikel" && $_POST["clave"]=="1234"){
        header("Location: bienvenido.html");
    } else {
        $err = true;
    }
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
    <?php if (isset($err)){
        echo "<p> Revise usuario y contraseña</p>";
    } 
    ?>
        <form method="POST"
            action="<?php echohtmlspecualchars($_SERVER["PHP_SELF"]);?>">
            <label for="usuario">Usuario: </label>
            <input value="<?php if (isset($usuario))echo $usuario;?>" id="usuario" name="usuario" type="text">
            <label for="clave">Clave: </label>
            <input id="clave" name="clave" type="password">
            <input name="submit" type="submit">
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