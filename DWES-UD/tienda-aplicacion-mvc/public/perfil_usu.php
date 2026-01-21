<?php

require __DIR__ . "/../vendor/autoload.php";
session_start();

// Si no existe la sesión del usuario, lo mandamos al login
if (!isset($_SESSION['usu'])) {
    header("Location: login.php?mensaje=Debes iniciar sesión");
    exit();
}

$usu = $_SESSION['usu'];

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Perfil de usuario</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <main>
        <div class="cabecera-usuario">
            <span><strong>Usuario:</strong> <?= htmlspecialchars($usu['correo']) ?></span>
            <nav>
                <a href="index.php">Home</a> |
                <a href="carrito.php">Ver carrito</a> |
                <a href="logout.php">Cerrar sesión</a>
            </nav>
        </div>

        <h1>Perfil del usuario</h1>

    <ul>
        <li><strong>Código de usuario:</strong>
            <?= htmlspecialchars($usu['CodRes'], ENT_QUOTES, 'UTF-8') ?>
        </li>

        <li><strong>Correo:</strong>
            <?= htmlspecialchars($usu['correo'], ENT_QUOTES, 'UTF-8') ?>
        </li>

        <li><strong>Contraseña (hash):</strong>
            <?= htmlspecialchars($usu['password'], ENT_QUOTES, 'UTF-8') ?>
        </li>

        <li><strong>Dirección: </strong>
            <?= htmlspecialchars($usu['direccion'], ENT_QUOTES, 'UTF-8') ?>
        </li>

        <li><strong>País:</strong>
            <?= htmlspecialchars($usu['pais'], ENT_QUOTES, 'UTF-8') ?>
        </li>
    </ul>

    </main>
</body>

</html>