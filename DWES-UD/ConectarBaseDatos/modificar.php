<?php
require_once 'Libro.php';
$libro = new Libro();
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
    $id = $_GET["id"];
    if (is_numeric($id)) {
        $datos = [
            "id" => $_POST['id'],
            "titulo" => $_POST["titulo"],
            "autor" => $_POST["autor"],
            "n_paginas" => $_POST["n_paginas"],
            "fecha_publicacion" => $_POST["fecha_publicacion"],
            "terminado" => $_POST["terminado"] ? 1 : 0
        ];
        $libro->modificar($datos);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar</title>
</head>
<body>
    <form method="POST" action="<?php $_SERVER['PHP_SELF'] . '?id=' . htmlspecialchars($_GET['id']); ?>">
        <label for="titulo">Título: </label>
        <input type="text" id="titulo" name="titulo" required><br>
        <label for="autor">Autor: </label>
    </form>
    
</body>
</html>