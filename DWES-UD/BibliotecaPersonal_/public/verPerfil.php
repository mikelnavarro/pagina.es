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
    <link rel="stylesheet" href="estilo.css">
    <link href=" https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <style>
    body {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background: linear-gradient(135deg, #6e8efb, #a777e3);
    }

    .profile-card {
        background: #fff;
        border-radius: 15px;
        padding: 30px 40px;
        width: 350px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
        text-align: center;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .profile-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
    }

    .profile-card h2 {
        margin-bottom: 20px;
        color: #333;
    }

    .profile-card p {
        font-size: 18px;
        color: #555;
        margin-bottom: 15px;
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="profile-card">
            <h2>Perfil de Usuario</h2>
            <p><strong>Username:</strong><?= htmlspecialchars($datosUsuario["username"]) ?></p>
            <a href="verPerfil.php?action=eliminar&id=<?= $datosUsuario["id"] ?>" class="btn btn-danger">Eliminar</a>
        </div>
    </div>
</body>

</html>