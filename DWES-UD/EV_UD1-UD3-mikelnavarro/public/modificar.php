<?php
require_once '../src/GestorMascotas.php';
$mascota = new GestorMascotas();
$id = null;
// Comprobamos el id
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
}
if (!$id) {
    echo "Error: No se ha especificado un ID valido.";
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["action"] == "modificar") {
    $datos = [
        "nombre" => $_POST["nombre"],
        "tipo" => $_POST["tipo"] ? : 'selected',
        "fecha_nacimiento" => $_POST["fecha_nac"],
        "foto_url" => $_POST["foto"],
    ];
    $mascota->modificar($datos);
    header("Location: principal.php?mensaje=La mascota ha sido modificada ");
    exit();
}
$mascota_actual = $mascota->getID($id);
if (!$mascota_actual) {
    echo "Error, el ID no existe.";
}
echo "<pre>";
print_r($mascota_actual);
echo "</pre>";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar</title>
    <linl rel="stylesheet" href="css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
    <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
        <label for="nombre">Nombre: </label>
        <input type="text" id="nombre" name="nombre" value="<?= $mascota_actual["nombre"] ?>"><br>
        <label for="tipo">Tipo </label>
        <select id="tipo" name="tipo">
            <option value="" <?= $mascota_actual["tipo"] == '' ? 'selected' : "" ?>></option>
            <option value="gato" <?= $mascota_actual["tipo"] == 'gato' ? 'selected' : "" ?>>gato</option>
            <option value="perro" <?= $mascota_actual["tipo"] == 'perro' ? 'selected' : "" ?>>perro</option>
            <option value="tortuga" <?= $mascota_actual["tipo"] == 'tortuga' ? 'selected' : "" ?>>tortuga</option>
            <option value="argaponi" <?= $mascota_actual["tipo"] == 'argaponi' ? 'selected' : "" ?>>argaponi</option>
        </select><br>
        <input type="date" id="fecha_nac" name="fecha_nac" value="<?= $mascota_actual["fecha_nacimiento"] ?>"><br>
        <label for="foto">Foto del animal </label>
        <input type="file" id="foto" name="foto" value="<?= $mascota_actual["foto_url"] ?>"><br><br>
        <input type="hidden" name="action" value="modificar">
        <input type="hidden" name="id" value="<?= $_GET['id'] ? $_GET["id"] : ''; ?>">
        <input type="submit" value="Editar">
    </form>
    <a href="principal.php">Volver al listado</a>
</body>

</html>