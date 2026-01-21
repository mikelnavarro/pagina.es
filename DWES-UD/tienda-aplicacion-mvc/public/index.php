<?php
require __DIR__ . '/../vendor/autoload.php';
session_start();

use Mikelnavarro\TiendaAplicacion\Categoria;

$categorias = Categoria::todas();
$correo = $_SESSION['usu']['correo'] ?? 'Invitado';
$carrito = $_SESSION['carrito'] ?? [];
$cantidadCarrito = array_sum(array_column($carrito, 'cantidad'));
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $mensajeAviso = $_GET["mensaje"] ?? null;
    if (isset($mensajeAviso)) {
        echo "<h4>" . $mensajeAviso . "</h4>";
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
    <main>
        <div class="cabecera-usuario">
            <span><strong>Usuario:</strong> <?= htmlspecialchars($correo) ?></span>
            <nav>
                <a href="index.php">Home</a> |
                <a href="carrito.php">Ver carrito (<?= $cantidadCarrito ?>)</a> |
                <?php if ($correo !== 'Invitado'): ?>
                    <a href="perfil_usu.php">Mi perfil</a> |
                    <a href="logout.php">Cerrar sesión</a>
                <?php else: ?>
                    <a href="login.php?loguerse=1">LOGIN</a>
                <?php endif; ?>
            </nav>
        </div>

        <h1>Bienvenido a la tienda</h1>
        <h2>Selecciona una categoría:</h2>
        <ul>
            <?php foreach ($categorias as $cat): ?>
            <li>
                <a href="productos.php?categoria=<?= $cat->getCodCat() ?>">
                    <?= htmlspecialchars($cat->getNombreCat()) ?>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
    </main>
</body>

</html>