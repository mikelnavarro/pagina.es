<?php
require __DIR__ . '/../vendor/autoload.php';

use Mikelnavarro\TiendaAplicacion\Pedido;
use MNL\tools\Mailer;

session_start();

$carrito = $_SESSION['carrito'] ?? [];
$email = $_POST['email'] ?? null;
if (empty($carrito)) {
    header('Location: carrito.php?mensaje=Carrito vacío');
    exit();
}
$restaurante = $_SESSION['usu']['CodRes'] ?? null;

try {
    $result = Pedido::crearDesdeCarrito($carrito, $restaurante);

    $nombreRestaurante = $result["Restaurante"];
    $codPed = $result['codPed'];
    $fecha = $result['fecha'];
    $totalNumeric = $result['total'];
    $orderLinesHtml = $result['orderLinesHtml'];

    // Enviar correo de confirmación si se proporcionó email
    $emailStatus = null;
    if ($email) {
        $subject = "Confirmación pedido #" . $codPed;
        $body = '<p>' . htmlspecialchars($nombreRestaurante) . '</p>';
        $body = '<h1>Pedido #' . htmlspecialchars($codPed) . "</h1>";
        $body .= '<p>Fecha: ' . htmlspecialchars($fecha) . '</p>';
        $body .= '<table border="1" cellpadding="6" cellspacing="0"><tr><th>Producto</th><th>Cantidad</th><th>Precio</th><th>Subtotal</th></tr>';
        $body .= $orderLinesHtml;
        $body .= '</table>';
        $body .= '<p><strong>Total: ' . number_format($totalNumeric, 2) . ' €</strong></p>';

        $sent = Mailer::send($email, $subject, $body);
        if ($sent === true) {
            $emailStatus = 'Correo de confirmación enviado a ' . htmlspecialchars($email);
        } else {
            $emailStatus = 'Error enviando correo: ' . htmlspecialchars((string)$sent);
        }
    }

    unset($_SESSION['carrito']); ?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="utf-8">
        <title>Pedido confirmado</title>
        <link rel="stylesheet" href="assets/css/style.css">
    </head>

    <body>
        <main>
            <h1>Pedido confirmado</h1>
            <p>Su pedido <strong>#<?= htmlspecialchars($codPed) ?></strong> se ha registrado correctamente.</p>
            <?php if (!empty($emailStatus)): ?>
                <p><?= $emailStatus ?></p>
            <?php endif; ?>
            <p><a href="index.php">Volver al inicio</a> | <a href="productos.php">Seguir comprando</a></p>
        </main>
    </body>

    </html>
<?php
    exit();
} catch (Exception $e) {
    // Redirigir con mensaje de error
    header('Location: carrito.php?mensaje=' . urlencode('Error al procesar pedido: ' . $e->getMessage()));
    exit();
}
?>