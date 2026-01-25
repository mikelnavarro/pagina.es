<?php

require __DIR__ . '/../vendor/autoload.php';

use Mikelnavarro\TiendaAplicacion\Producto;
if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $codCategoria = $_GET["categoria"];
    // Obtenemos los productos de dicha categoría
    $productos = Producto::productosPorCategoria($_GET["categoria"]);

    if ($codCategoria === FALSE) {
        echo "<p><strong>Error al conectar la base de datos!</strong>";
    }


}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Productos Por Categoría</title>
</head>

<body>
    <p>Productos Por Categoria</p>

    <?php foreach ($productos as $producto): ?>

    <p><strong><?= $producto["CodProd"]?></strong></p>
    <p><strong><?= $producto["Nombre"] ?></strong></p>
    <?php endforeach; ?>
</body>

</html>