<?php
include 'header.php';

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Categorías - Tienda</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        h1 { color: #2c3e50; }
        .categoria-item {
            background: #f9f9f9;
            padding: 10px;
            margin: 8px 0;
            border-left: 4px solid #3498db;
        }
        a { text-decoration: none; color: #2980b9; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <h1>Categorías Disponibles</h1>
    <div class="categorias-lista">
        <?php if (!empty($categorias)): ?>
            <?php foreach ($categorias as $cat): ?>
                <div class="categoria-item">
                    <a href="/Categoria/listar/<?= htmlspecialchars($cat['id']) ?>">
                        <?= htmlspecialchars($cat['nombre']) ?>
                    </a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No hay categorías disponibles.</p>
        <?php endif; ?>
    </div>

    <br>
    <a href="/Restaurante/logout">Cerrar sesión</a>
</body>
</html>