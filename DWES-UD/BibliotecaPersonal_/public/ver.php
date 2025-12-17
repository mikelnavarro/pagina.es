<?php
require_once '../src/Libro.php';
$libro = new Libro();
$libro_actual = null;
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
if ($_GET["action"] == "ver") {
    $libro_actual = $libro->getID($id);
}

/*
echo "<pre>";
print_r($libro_actual);
echo "</pre>";

*/
if ($libro_actual) {
    echo "<h2>Detalles del Libro</h2>";
    echo "<p><strong>ID:</strong> " . htmlspecialchars($libro_actual['id']) . "</p>";
    echo "<p><strong>Título:</strong> " . htmlspecialchars($libro_actual['titulo']) . "</p>";
    echo "<p><strong>Autor:</strong> " . htmlspecialchars($libro_actual['autor']) . "</p>";
    echo "<p><strong>Número de Páginas:</strong> " . htmlspecialchars($libro_actual['n_paginas']) . "</p>";
    echo "<p><strong>Fecha de Publicación:</strong> " . htmlspecialchars($libro_actual['fecha_publicacion']) . "</p>";
    echo "<p><strong>¿Terminado?:</strong> " . htmlspecialchars($libro_actual['terminado'] ? 'Sí' : 'No') . "</p>";
} else {
    echo "<p>Libro no encontrado.</p>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver</title>
    <link rel="stylesheet" href="estilos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <style>
    * {
        font-family: "Arial";
    }

    table {
        display: flex;
        flex: 0;
        padding: 15px;
        width: 95%;
        border-style: none;
    }

    th {
        display: flex;
        align-items: right;
        padding: 6px;
        border: 2px solid black;
    }

    td {
        display: flex;
        flex-direction: row;
        border: 2px solid black;
        padding: 6px;

    }
    </style>
</head>

<body>
    <main>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Número de Páginas</th>
                    <th>Año Publicación</th>
                    <th>¿Terminado?</th>
                </tr>
            </thead>
            <tbody>
                <?php

                if ($libro_actual) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($libro_actual["id"]) . "</td>";
                    echo "<td>" . htmlspecialchars($libro_actual["titulo"]) . "</td>";
                    echo "<td>" . htmlspecialchars($libro_actual["autor"]) . "</td>";
                    echo "<td>" . htmlspecialchars($libro_actual["n_paginas"]) . "</td>";
                    echo "<td>" . htmlspecialchars($libro_actual["fecha_publicacion"]) . "</td>";
                    echo "<td>" . htmlspecialchars($libro_actual["terminado"] ? "Sí" : "No") . "</td>";
                    echo "</tr>";
                }
                ?>

            </tbody>
        </table>
    </main>
    <a href="principal.php" class="btn btn-success">Volver al listado</a>
</body>

</html>