<?php


$username = $_GET["user"];
$password = $_GET["password"];



?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Procesar</title>
</head>
<body>
    <h5>¿A qué no es seguro enviar datos por el GET?</h5>
    <h1>Que ha introducido el usuario: </h1>
    <p>Usuario: <?php echo $username; ?></p>
    <p>Contraseña: <?php echo $password; ?></p>
</body>
</html>