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
    <title>Perfil de Usuario</title>
    <style>
        /* Reset y tipografía */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

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

        .btn {
            display: inline-block;
            padding: 10px 25px;
            border-radius: 50px;
            background-color: #ff4b2b;
            color: #fff;
            text-decoration: none;
            font-weight: bold;
            transition: background 0.3s ease;
        }

        .btn:hover {
            background-color: #ff416c;
        }
    </style>
</head>

<body>
    <div class="profile-card">
        <h2>Perfil de Usuario</h2>
        <p><strong>Username:</strong> <?= htmlspecialchars($datosUsuario["username"]) ?></p>
        <p><strong>Password:</strong> <?= htmlspecialchars($datosUsuario["password"]) ?></p>
        <a href="verPerfil.php?action=eliminar&id=<?= $datosUsuario["id"] ?>" class="btn">Eliminar</a>
    </div>
</body>

</html>