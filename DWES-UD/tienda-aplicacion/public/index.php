<?php
require __DIR__ . '/../vendor/autoload.php';

use Mikelnavarro\TiendaAplicacion\Categoria;

$categorias = Categoria::todas();
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $mensajeAviso = $_GET["mensaje"] ?? null;
    if (isset($mensajeAviso)) {
        echo "<h4>" . $mensajeAviso . "</h4>";
        echo '<a href="perfil_usu.php">Ver perfil de usuario</a>';
    } else {
        echo "<h4>No se muestran mensajes</h4>";
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Inicio</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <style>
    h4 {

        color: red;
        font-weight: bold;
        font-family: 'Arial';

    }
    </style>
</head>

<body>
    <h1>Bienvenido a la tienda</h1>
    <a href="login.php?loguerse=1">LOGIN</a>
    <ul>
        <?php foreach ($categorias as $cat): ?>
        <li>
            <a href="productos.php?categoria=<?= $cat->getCodCat() ?>">
                <?= htmlspecialchars($cat->getNombreCat()) ?>
            </a>
        </li>
        <?php endforeach; ?>
    </ul>
</body>

</html>