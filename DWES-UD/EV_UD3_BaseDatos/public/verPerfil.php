<?php
require "../vendor/autoload.php";
require "../src/Usuario.php";


session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: login.php");
    exit;
}
$user = new Usuario();
$sesion = $_SESSION["usuario"];
$datosUsuario = $user->getUsername($sesion);
print_r($datosUsuario);


// Recibir datos de action y ID
if (isset($_GET["action"]) && $_SERVER["REQUEST_METHOD"] === "GET") {
    if ($_GET["action"] == "eliminar") {
        $id = $_GET["id"];
        if ($user->getID($id)) {
            $user->deleteUsername($id);
            header("Location: registrarse.php?mensaje=user eliminado");
            exit();
        } else if (!$user->getID($id)) {
            die("El usuario no existe en la base de datos!");
            return false;
        }
    }
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
                    <strong>Password: </strong><?= htmlspecialchars($datosUsuario["password"]) ?>
                </div>
            </div>
            <div>
                <a href="verPerfil.php?action=eliminar&id=<?php echo $datosUsuario["id"] ?>" class="btn btn-danger">Eliminar</a>
            </div>
        </div>
    </div>
</body>

</html>