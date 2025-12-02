<?php
require "../vendor/autoload.php";
require "../src/Registro.php";


session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: login.php");
    exit;
}
$user = new Registro();
$sesion = $_SESSION["usuario"];
echo "Usuario: " . $_SESSION["usuario"] . "<br>";
$datosUsuario = $user->getUsername($sesion);
print_r($datosUsuario);
if ($datosUsuario) {
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="card-content">
                <div class="card-text">
                    <strong>Nombre:</strong> <?= htmlspecialchars($datosUsuario["username"]) ?><br>
                    <strong>Fecha de Nacimiento:</strong> 2019-01-15
                </div>
            </div>
            <div>
                <a href="#" class="btn btn-danger">Eliminar</a>
            </div>
        </div>
    </div>
</body>

</html>