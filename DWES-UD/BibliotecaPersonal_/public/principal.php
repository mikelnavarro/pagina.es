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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="estilos.css">
    <style>
    /* Estilos para el body */
    body {
        margin: 10px 20px 10px 20px;
        /* Relleno para top, right, bottom, left */
    }

    /* Estilos para el main */
    main {
        margin: 20px;
        /* Margen uniforme alrededor del main */
        padding: 15px;
        /* Relleno interno dentro del main */
        background-color: #ffffff;
        border: 1px solid #ccc;
        box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
        /* Sombra para dar profundidad */
    }

    .container {
        /* Si quieres que el contenedor ocupe todo el ancho disponible, puedes eliminar max-width */
        max-width: 800px;
        margin: auto;
        padding: 20px;
        display: flex;
        /* Añade flex para que las tarjetas se muestren en línea */
        flex-wrap: wrap;
        /* Permite que las tarjetas se ajusten y pasen a la siguiente línea si no hay espacio */
        justify-content: space-between;
        /* Espacio entre tarjetas. Puedes ajustar según prefieras */
    }

    .card {
        border: 1px solid #ccc;
        padding: 10px;
        margin-bottom: 10px;
        /* Ancho de las tarjetas. Puedes ajustar según prefieras */
        width: calc(33% - 10px);
        /* Esto asume que quieres 3 tarjetas por fila y resta 20px por el espacio entre tarjetas */
        box-sizing: border-box;
        /* Asegura que el padding y el borde se incluyan en el ancho total de la tarjeta */
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    /* HIPERENLACES */
    a {
        text-decoration: none;
        background-color: blue;
        color: white;
        padding: 4px;
        width: 100%;
    }
    </style>
</head>

<body>
    <a href="../src/Logout.php">Cerrar Sesión</a>
    <a href="verPerfil.php">MI USUARIO</a>
    <a href="listaUsers.php" class="btn btn-success">Users</a>
    <div class=" container md-3">
        <?php foreach ($libros as $libro): ?>
        <div class="card" style="width: 18rem;">
            <img src="img/tortuga2.jpeg" class="card-img-top img-fluid" alt="">
            <div class="card-content">
                <div class="card-text">
                    <strong>ID: </strong><?php echo $libro['id'] ?><br>
                    <strong>Titulo: </strong><?php echo $libro['titulo'] ?><br>
                    <strong>Autor: </strong><?php echo $libro['autor'] ?><br>
                    <strong>Fecha de publicación: </strong><?php echo $libro['fecha_publicacion'] ?><br>
                    <strong>Número de páginas: </strong><?php echo $libro['n_paginas'] ?><br>
                </div>
            </div>
            <div class="d-flex flex-row mb-3" style="gap:0.4em;">
                <a href="ver.php?action=ver&id=<?= $libro['id'] ?>" class="btn btn-primary">
                    Ver
                </a><br>
                <a href="modificar.php?action=modificar&id=<?= $libro['id'] ?>" class="btn btn-warning">
                    Editar
                </a><br>
                <a href="principal.php?action=borrar&id=<?= $libro['id'] ?>" class="btn btn-danger">
                    Borrar
                </a>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

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
    <a href="agregar.php">Agregar Libro</a>
    <a href="tabla_lectura.php">Grid Tabla Lectura</a>
</body>

</html>