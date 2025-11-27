<?php
require '../src/Libro.php';
require __DIR__ . '/../vendor/autoload.php';
// Incluye el archivo de la clase

// Instancia la clase Libro
$libro = new Libro();


// Llama al método listar() para obtener los datos
$libros = $libro->listar();
// Llama al método borrar() para eliminar

if (isset($_GET["action"]) && $_GET["action"] === "borrar" && isset($_GET["id"])) {
    if (is_numeric($_GET["id"])) {
        $libro->borrar($_GET["id"]);
        header("Location: principal.php?mensaje=Libro eliminado");
        exit();
    }
}
// Opcional: Manejo de Mensaje
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Listado de Libros</title>
    <style>
    </style>
    <link rel="stylesheet" href="estilo.css">
</head>

<body>
    <h2>Listado de Libros</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Autor</th>
                <th>Número de Páginas</th>
                <th>Año Publicación</th>
                <th>¿Terminado?</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Itera sobre el array de libros devuelto por el método
            foreach ($libros as $row) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row["id"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["titulo"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["autor"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["n_paginas"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["fecha_publicacion"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["terminado"] ? "Sí" : "No") . "</td>";
                echo "<td>";
                // Botones de acción (funcionalidad a implementar más tarde)
                echo "<a id=Editar href='modificar.php?action=modificar&id=" . htmlspecialchars($row['id']) . "'>Editar</a> | ";
                echo "<a id=Ver href='ver.php?action=ver&id=" .htmlspecialchars($row["id"]). "'>Ver</a> | ";
                echo "<a id=Borrar href='principal.php?action=borrar&id=" . htmlspecialchars($row['id']) . "'>Borrar</a>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    <a href="agregar.php">Agregar Libro</a>
</body>

</html>