<?php
// Importar

require '../vendor/autoload.php';
require '../src/GestorMascotas.php';

$datos = [];
// Lista Mascotas
if ($_SERVER["REQUEST_METHOD"]==="POST"){
    subirArchivos();
    $mascota = new GestorMascotas();



    // Fichero
    $name = $_FILES["foto"]["name"];

    $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
    $dir = "../public/img/";
    $destino = $dir . $name;
	$datos = array(
        "nombre"=>$_POST["nombre"],
        "tipo"=>$_POST["tipo"],
        "fecha_nac"=>$_POST["fecha_nac"],
        "foto_url"=> $destino,
        "id_persona"=>$_POST["responsable"],
    		);
	$correcto = $mascota->registrar($datos);


    if ($correcto){
        header("Location: principalCopy.php?mensaje=Libro agregado correctamente");
        exit();
   	} else {
   		echo "Error al cargar.";
   	}
}
echo "<pre>";
print_r($datos);
echo "</pre>";
function subirArchivos(){


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
        #paginaprincipal {
            max-width: 300px;
            width: 6%;
        }
    </style>
</head>
<body>
    <a href="principalCopy.php"><img src="img/paginaprincipal.png" id="paginaprincipal" alt="button principal"></a>
    <div class="container form-wrapper">
        <div class="row justify-content-center">
            <!-- TARJETA: REGISTRAR MASCOTA -->
            <div class="col-md-6 mb-4">
                <div class="card p-4">
                    <h2 class="mb-3">Registrar Mascota</h2>

                    <form action="<?= $_SERVER["PHP_SELF"]?>" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre:</label>
                            <input type="text" name="nombre" id="nombre" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="tipo" class="form-label">Tipo:</label>
                            <select name="tipo" id="tipo" class="form-select">
                                <option value="">-- Selecciona tipo --</option>
                                <option value="gato">gato</option>
                                <option value="perro">perro</option>
                                <option value="tortuga">tortuga</option>
                                <option value="agaporni">agaporni</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="fecha_nac" class="form-label">Fecha de Nacimiento:</label>
                            <input type="date" name="fecha_nac" id="fecha_nac" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="foto" class="form-label">Foto:</label>
                            <input type="file" name="foto" id="foto" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="responsable" class="form-label">Responsable:</label>
                            <select name="responsable" id="responsable" class="form-select">
                                <option value="">-- Selecciona responsable --</option>
                                <option value="1">César López Sáenz</option>
                                <option value="4">Amparo Larrañaga Iturza</option>
                                <option value="2">Manolo Rodríguez del Bosque</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            Registrar Mascota
                        </button>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <a href="principalCopy.php">Página Principal</a>
</body>
</html>