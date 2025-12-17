<?php
require __DIR__ . '/../vendor/autoload.php';

use Mikelnavarro\TiendaAplicacion\Categoria;

$categorias = Categoria::todas();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Inicio</title>
</head>

<body>
    <h1>Bienvenido a la tienda</h1>
    <ul>
        <?php foreach ($categorias as $cat): ?>
        <li>
            <a href="productos.php?categoria=<?= $cat->getCodCat() ?>">
                <?= htmlspecialchars($cat->getNombre()) ?>
            </a>
        </li>
        <?php endforeach; ?>
    </ul>
</body>

</html>