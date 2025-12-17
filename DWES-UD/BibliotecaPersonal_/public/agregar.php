<?php
require_once '../src/Libro.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $libro = new Libro();
    $datos = array(
        "titulo" => $_POST["titulo"],
        "autor" => $_POST["autor"],
        "n_paginas" => $_POST["n_paginas"],
        "fecha_publicacion" => $_POST["fecha_publicacion"],
    );
    $correcto = $libro->crear($datos);
    if ($correcto) {
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
    <link rel="stylesheet" href="estilos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container-xl">
        <a class="icon-link icon-link-hover" style="--bs-link-hover-color-rgb: 25, 135, 84;" href="#">
            Icon link
            <svg xmlns="http://www.w3.org/2000/svg" class="bi" viewBox="0 0 16 16" aria-hidden="true">
                <path
                    d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z" />
            </svg>
        </a>
        <h2>Crear libro</h2>

        <div class="container mt-4">
            <div class="col-md-5 col-lg-4">
                <!-- Ajusta el ancho aquí -->
                <div class="card shadow p-4">
                    <h3 class="mb-3 text-primary">Crear Libro</h3>
                    <form action="<?php $_SERVER["PHP_SELF"] ?>" method="POST">
                        <div class="mb-3">
                            <label for="titulo">Título: </label>
                            <input type="text" id="titulo" name="titulo"><br>
                        </div>
                        <div class="mb-3">
                            <label for="autor">Autor: </label>
                            <input type="text" id="autor" name="autor"><br>
                        </div>
                        <div class="mb-3">
                            <label for="n_paginas">Numero de Paginas: </label>
                            <input type="number" id="n_paginas" name="n_paginas"><br>
                        </div>
                        <div class="mb-3">
                            <label for="fecha_publicacion">Fecha de publicación: </label>
                            <input type="date" id="fecha_publicacion" name="fecha_publicacion"><br>
                        </div>
                        <div class="mb-3">
                            <input type="submit" value="Crear Libro" class="btn btn-success w-100">
                        </div>
                    </form>
                    <div class="mt-3 text-center">
                        <a href="principal.php" class="btn btn-success">Volver al listado</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>