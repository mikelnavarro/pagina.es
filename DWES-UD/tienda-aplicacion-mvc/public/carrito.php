<?php
session_start();
$carrito = $_SESSION['carrito'] ?? [];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <main>
        <div class="cabecera-usuario">
            <span><strong>Usuario:</strong> <?= htmlspecialchars($_SESSION['usu']['correo'] ?? 'Invitado') ?></span>
            <nav>
                <a href="index.php">Home</a> |
                <a href="productos.php">Ver productos</a> |
                <a href="logout.php">Cerrar sesión</a>
            </nav>
        </div>
    <?php
    if (empty($carrito)) {
        echo "<p>El carrito está vacío</p>";
    }
    ?>
    <h1>Carrito</h1>

    <table>
        <tr>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>Subtotal</th>
        </tr>

        <?php foreach ($carrito as $linea): ?>
            <tr>
                <td><?= htmlspecialchars($linea['Nombre'] ?? '') ?></td>
                <td><?= (int)($linea['cantidad'] ?? 0) ?></td>
                <td><?= number_format((float)($linea['Precio'] ?? 0), 2) ?> €</td>
                <td><?= number_format((float)($linea['Precio'] ?? 0) * (int)($linea['cantidad'] ?? 0), 2) ?> €</td>
            </tr>
        <?php endforeach; ?>
    </table>

    <p><strong>Total:</strong>
        <?= number_format(array_sum(array_map(fn($linea) => (float)($linea['Precio'] ?? 0) * (int)($linea['cantidad'] ?? 0), $carrito)), 2) ?> €
    </p>    
    <?php if (!empty($carrito)): 
        $total = number_format(array_sum(array_map(fn($linea) => (float)($linea['Precio'] ?? 0) * (int)($linea['cantidad'] ?? 0), $carrito)), 2);
    ?>
    <form action="checkout.php" method="POST" class="form-confirmar">
        <label for="email">Correo para recibir confirmación:</label>
        <input type="email" id="email" name="email" required placeholder="tu@correo.com">
        <input type="hidden" name="total" value="<?= htmlspecialchars($total) ?>">
        <button type="submit">Confirmar pedido (<?= $total ?> €)</button>
    </form>
    <?php endif; ?>
    </main>
</body>
</html>