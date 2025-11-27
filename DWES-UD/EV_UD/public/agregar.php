<?php
require_once '../src/Libro.php';
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $libro = new Libro();
    $datos = array(
        "titulo"=>$_POST["titulo"],
        "autor"=>$_POST["autor"],
        "n_paginas"=>$_POST["n_paginas"],
        "fecha_publicacion"=>$_POST["fecha_publicacion"],
    );
    $correcto = $libro->crear($datos);
    if ($correcto){
        header("Location: principal.php?mensaje=Libro agregado correctamente");
        exit();
    } else {
        echo "Error al agregar";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Agregación del Libro</title>
    <link rel="stylesheet" href="estilo.css">
</head>

<body>
    <h2>Crear libro</h2>
    <form action="<?php $_SERVER["PHP_SELF"]?>" method="POST">
        <label for="titulo">Título: </label>
        <input type="text" id="titulo" name="titulo"><br>
        <label for="autor">Autor: </label>
        <input type="text" id="autor" name="autor"><br>
        <label for="n_paginas">Numero de Paginas: </label>
        <input type="number" id="n_paginas" name="n_paginas"><br>
        <label for="fecha_publicacion">Fecha de publicación: </label>
        <input type="date" id="fecha_publicacion" name="fecha_publicacion"><br>
        <input type="submit" value="Crear Libro">
    </form>
    <a href="principal.php">Volver al listado</a>
</body>

</html>