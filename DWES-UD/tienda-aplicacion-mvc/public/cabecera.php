<?php
require __DIR__ . "/../vendor/autoload.php";
// Si no existe la sesión del usuario, lo mandamos al login
$usu = $_SESSION['usu'];
?>
<header>
    <p><strong>Código de usuario:</strong><?= htmlspecialchars($usu['CodRes'], ENT_QUOTES, 'UTF-8') ?></p>
    <p><strong>Correo:</strong><?= htmlspecialchars($usu['correo'], ENT_QUOTES, 'UTF-8') ?></p>
</header>