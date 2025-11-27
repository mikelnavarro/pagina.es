<?php
// Incluye el archivo de la clase
require '../vendor/autoload.php';
require '../src/GestorMascotas.php';
// Instancia la clase Libro
$mascota = new GestorMascotas();


// Llama al método listar() para obtener los datos
$listaMascotas = $mascota->listar();
// Llama al método borrar() para eliminar
if (isset($_GET["action"]) && $_GET["action"] === "borrar" && isset($_GET["id"])) {
    if (is_numeric($_GET["id"])) {
        $mascota->eliminar($_GET["id"]);
        header("Location: principal.php?mensaje=Libro eliminado");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Listado de mascotas</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        img {
            max-width: 130px;
            height: auto;
        }
        a {
            text-decoration: none;
            background-color: blue;
            color: white;
            padding: 4px;
            width: 100%;
        }
    </style>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="estilo.css">
</head>

<body>
    <h2>Lista de mascotas</h2>
    <a href="../Logout.php">Cerrar sesion</a>
    <table>
        <thead>
            <tr>
                <th>Responsable</th>
                <th>ID</th>
                <th>Nombre</th>
                <th>Tipo</th>
                <th>Fecha de Nacimiento<n /th>
                <th>Imagen</th>
                <th>Foto URL</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Itera sobre el array de libros devuelto por el método
            foreach ($listaMascotas as $row) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row["id_persona"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["id"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["nombre"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["tipo"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["fecha_nacimiento"]) . "</td>";
                echo '<td><img src="' . $row['foto_url'] . '" alt="Foto"></td>';
                echo "<td>" . htmlspecialchars($row["foto_url"]) . "</td>";
                echo "<td>";
                echo "<a id=Editar href='modificar.php?action=modificar&id=" . htmlspecialchars($row['id']) . "'>Editar</a> | ";
                echo "<a id=Borrar href='principal.php?action=borrar&id=" . htmlspecialchars($row['id']) . "'>Borrar</a>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    <a href="registro.php">Registrar una Mascota</a>
</body>

</html>