<?php
require __DIR__ . '/../vendor/autoload.php';

use Mikelnavarro\TiendaAplicacion\Categoria;

$categorias = Categoria::todas();
?>
<!doctype html>
<html lang="es">
<head><meta charset="utf-8"><title>Categorías</title></head>
<body>
<h1>Categorías</h1>
<ul>
    <?php foreach ($categorias as $cat): ?>
        <li><?= htmlspecialchars($cat->getNombre()) ?></li>
    <?php endforeach; ?>
</ul>
</body>
</html>
