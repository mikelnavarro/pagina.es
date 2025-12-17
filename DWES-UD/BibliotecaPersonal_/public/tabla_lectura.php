<?php
require "../src/Libro.php";
// Instancia la clase Libro
$libro = new Libro();
// Llama al método listar() para obtener los datos
$libros = $libro->listar();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="tabla_lectura.css">
</head>

<body class="bg-light">




    <div class="container py-5">
        <h1 class="mb-4 text-center">Libros Recomendados</h1>



        <!-- Tabla de Visualización -->
        <h2>Tabla de Visualización Biblioteca</h2>
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
                echo "<a id=Ver href='ver.php?action=ver&id=" . htmlspecialchars($row["id"]) . "'>Ver</a> | ";
                echo "<a id=Borrar href='principal.php?action=borrar&id=" . htmlspecialchars($row['id']) . "'>Borrar</a>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>


        <!--<div class="row g-4 justify-content-center">
             Card 1 
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 d-flex">
                <div class="card card-custom w-100">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title title-custom"><?= $row["titulo"] ?></h5>
                        <p class="card-text small text-muted author-custom"><?= $row["autor"] ?></p>
                        <div class="badge badge-pages mt-2"><?= $row["n_paginas"] ?> páginas</div>
                        <div class="badge badge-date mt-2">Publicado: <?= $row["fecha_publicacion"] ?></div>
                    </div>
                </div>
            </div>
        </div>
        </div>-->
</body>

</html>