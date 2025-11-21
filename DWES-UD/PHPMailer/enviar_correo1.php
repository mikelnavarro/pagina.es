<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';


if ($_SERVER["REQUEST_METHOD"] == "post"){
    if (isset($_POST["nombre"],$_POST["mail"],$_POST["mensaje"])){
        $remitente = $_POST["nombre"];
        $email = $_POST["mail"];
        $mensaje = $_POST["mensaje"];
        
        /* Fichero */
        $name = $_FILES["fichero"]["name"];
        $tmp = $_FILES["fichero"]["tmp_name"];
        $tam = $_FILES["fichero"]["size"];

        if ($tam > 256 * 1024) {
            echo "<br>Demasiado grande";
        return;
        }
        echo "Nombre del fichero: " . $_FILES["fichero"]["name"];
        $res = move_uploaded_file($_FILES["fichero"]["tmp_name"],"subidos/".$_FILES["fichero"]["name"]);

        if ($res){
            echo "<br>Fichero guardado";
        } else{
            echo "<br>Error";
        }
        }
}

$mail = new Mailer($email,$email,$mensaje,$tmp);
?>