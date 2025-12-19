<?php
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
</head>
<body>

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

<p>
    <a href="index.php">Volver al inicio</a> |
    <a href="logout.php">Cerrar sesión</a>
</p>

</body>
</html>
