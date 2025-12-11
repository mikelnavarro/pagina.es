<?php
// Incluye el archivo de la clase
require '../vendor/autoload.php';
require '../src/GestorMascotas.php';
// Instancia la clase Libro
$mascota = new GestorMascotas();


// Llama al método listar() para obtener los datos
$listaMascotas = $mascota->listarResponsable();
// Llama al método borrar() para eliminar
if (isset($_GET["action"]) && $_GET["action"] === "borrar" && isset($_GET["id"])) {
    if (is_numeric($_GET["id"])) {
        $mascota->eliminar($_GET["id"]);
        header("Location: principalCopy.php?mensaje=Mascota eliminada");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Listado de mascotas</title>
    <link href="css/bootstrap.min_002.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
    /* Estilos para el body */
    body {
        margin: 10px 20px 10px 20px;
        /* Relleno para top, right, bottom, left */
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
</head>

<body>
    <a href="registro.php">Registrar Una Mascota</a>
    <h2>Lista de mascotas</h2>
    <a href="Logout.php">Cerrar sesion</a>
    <div class="container">
    <?php foreach ($listaMascotas as $pet): ?>
    <div class="card">
        <div class="card-content">
            <img src="<?php echo $pet['foto_url'] ?>" class="card-img-top img-fluid" alt="">
            <div class="card-text">
                <strong>Responsable:</strong><?php echo $pet['responsable'] ?><br>
                <strong>Nombre:</strong><?php echo $pet['nombre'] ?><br>
                <strong>Tipo:</strong><?php echo $pet['tipo'] ?><br>
                <strong>Fecha de Nacimiento:</strong><?php echo $pet['fecha_nacimiento'] ?>
            </div>
        </div>
        <div>
            <a href="modificar.php?action=modificar&id=<?= $pet['id'] ?>" class="btn btn-primary">Modificar La Mascota</a>
            <a href="ModificarFoto.php?action=modificar&id=<?= $pet['id'] ?>" class="btn btn-warning">Cambiar foto</a>
            <a href="principalCopy.php?action=borrar&id=<?= $pet['id'] ?>" class="btn btn-danger">Eliminar</a>
        </div>
    </div>
    <?php endforeach; ?>
</div>
</body>

</html>