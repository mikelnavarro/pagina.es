<?php

require __DIR__ . '/../vendor/autoload.php';
session_start();

use Mikelnavarro\TiendaAplicacion\Producto;

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $codCategoria = $_GET['cat'] ?? null;
    // Obtenemos los productos de dicha categoría
    $productos = Producto::productosPorCategoria($_GET["categoria"]);

    if ($codCategoria === FALSE) {
        echo "<p><strong>Error al conectar la base de datos!</strong>";
    }
}
$correo = $_SESSION['usu']['correo'] ?? 'Invitado';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <main>
        <div class="cabecera-usuario">
            <span><strong>Usuario:</strong> <?= htmlspecialchars($correo) ?></span>
            <nav>
                <a href="index.php">Home</a> |
                <a href="carrito.php">Ver carrito</a> |
                <a href="logout.php">Cerrar sesión</a>
            </nav>
        </div>
        <table class="tabla-productos">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Peso</th>
                    <th>Stock</th>
                    <th>Comprar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($productos as $p): ?>
                    <tr>
                        <td><?= htmlspecialchars($p['Nombre']) ?></td>
                        <td><?= htmlspecialchars($p['Descripcion']) ?></td>
                        <td><?= $p['Peso'] ?> kg</td>
                        <td><?= $p['Stock'] ?></td>
                        <td>
                            <form action="add_carrito.php" method="POST" class="form-comprar">
                                <input type="hidden" name="id" value="<?= $p['CodProd'] ?>">
                                <select name="cantidad">
                                    <?php for ($i = 1; $i <= 10; $i++): ?>
                                        <option value="<?= $i ?>"><?= $i ?></option>
                                    <?php endfor; ?>
                                </select>
                                <button type="submit">Añadir Al Carrito</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>


    </main>
</body>

</html>