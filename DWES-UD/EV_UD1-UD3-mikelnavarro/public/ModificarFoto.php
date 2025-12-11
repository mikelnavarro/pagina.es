<?php
// Importar

require '../vendor/autoload.php';
require '../src/GestorMascotas.php';
// Lista Mascotas
$mascota = new GestorMascotas();
$idMascota = null;
// Comprobamos el id
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $idMascota = $_GET['id'];
    $mascota_actual = $mascota->getID($idMascota);
    if (!$mascota_actual) {
        echo "Error, el ID no existe.";
    }
    if (!$idMascota) {
        echo "Error: No se ha especificado un ID de una mascota válido.";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && $_GET["action"] == "modificar") {
    if (isset($_POST['foto'])) {
        $foto = $_POST['foto'];


        // Fichero
        $name = $_FILES["foto"]["name"];

        $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
        $dir = "../public/img/";
        $destino = $dir . $name;
        $datos = array(
            "foto_url" => $destino,
        );
        $correcto = $mascota->cambiarFotos($datos);
        echo "<pre>";
        print_r($datos);
        echo "</pre>";

        header('Location: principalCopy.php?mensaje=Fotografía modificada');
        exit();
        if ($correcto) {
        header('Location: principalCopy.php?mensaje=Fotografía modificada');
            exit();
        } else {
            echo "Error al cargar.";
        }
    }
}




function subirArchivos()
{


    $name = $_FILES["foto"]["name"];
    $type = $_FILES["foto"]["type"];
    $size = $_FILES["foto"]["size"];
    $tmp = $_FILES["foto"]["tmp_name"];
    $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
    // --- COMPROBAR EXTENSIÓN ---  
    /* La función pathinfo() sirve para descomponer una ruta o un nombre de archivo en sus partes (directorio, nombre base, extensión…)
    PATHINFO_EXTENSION: devuelve solo la parte después del último punto.
    Por qué usar strtolower() ==> Para evitar problemas con mayúsculas y minúsculas
    $ext es la extensión del fichero
    Tipo MIME de PDF: (application/pdf)
    */
    // --- COMPROBAR SI EXISTE ---
    $dir = dirname(__FILE__) . "/img/";
    $destino = $dir . $name;



    if (file_exists($destino)) {
        echo "El archivo ya existe.";
        return;
    }
    /* --- COMPROBAR TAMAÑO ---
    El tamaño del fichero
    ===
    */
    if ($size > 2 * 1024 * 1024) {
        echo "Demasiado grande (> 2MB)";
        return;
    }

    //  --- MOVER ARCHIVO ---
    /* 1. Subir el fichero al servidor
    Cómo lo hacemos
    move_uploaded_file(nombre temporal, destino final): Devuelve true o false

    */
    $res = move_uploaded_file($tmp, $destino);
    if ($res) {
        echo "<br>Fichero guardado"; // Se guardó
    } else {
        echo "<br>Error";
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Mascota</title>

    <link href="css/bootstrap.min_002.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* NO pisamos .container de Bootstrap, usamos una clase propia */
        .form-wrapper {
            max-width: 800px;
            margin: 20px auto;
        }
    </style>
</head>

<body>

    <a href="principalCopy.php">Página Principal</a>
    <div class="container form-wrapper">
        <div class="row justify-content-center">
            <!-- TARJETA: REGISTRAR MASCOTA -->
            <div class="col-md-6 mb-4">
                <div class="card p-4">
                    <h2 class="mb-3">Modificar la Foto</h2>

                    <form action="<?= $_SERVER["PHP_SELF"] ?>" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="foto" class="form-label">Foto:</label>
                            <input type="file" name="foto" id="foto" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Modificar</button>

                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>