<?php


namespace Mikel\Ud3;

use Mikel\Ud3\Mailer;


require '../vendor/autoload.php';

$correo = new Mailer();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $from = $_POST["remitente"];
    $to = $_POST["destinatario"];
    $cc = $_POST["CC"];
    $subject = $_POST["subject"];
    $body = $_POST["body"];


    /* Envio de Ficheros al servidor */
    $name = $_FILES["attachment"]["name"];
    $type = $_FILES["attachment"]["type"];
    $tmp = $_FILES["attachment"]["tmp_name"];
    $size = $_FILES["attachment"]["size"];
    $extension = strtolower(pathinfo($name, PATHINFO_EXTENSION));

    
    
    // 1. La Extension
    if ($extension !== "pdf") {
        echo "Extensión no permitida";
    }
    // 2. Crear carpeta para uploads si no existe
    $dir = "../src/uploads/";
    // 3. Ruta final donde guardar el archivo
    $finalPath = $dir .$name;
    // 4. Mover archivo desde /tmp a carpeta definitiva
    if (move_uploaded_file($tmp, $finalPath)) {
        $attachment = $finalPath;
    } else {
        echo "Error al mover el archivo";
    }

    // Comprobar que se haya enviado
    if ($correo->sendEmail($from, $to, $cc, $attachment, $subject, $body)){
        echo "Correo enviado.";
    } else {
        echo "No se ha enviado el Correo";
    }
}
?>