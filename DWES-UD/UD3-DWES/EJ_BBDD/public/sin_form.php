<?php
    use Mikel\Ud3\Mailer;
    require '../vendor/autoload.php';
    $mail = new Mailer();
    $from = "mikelnavarro33@gmail.com";
    $to = "mikelnavarro33@gmail.com";
    $cc = "mikelnavarro33@gmail.com";
    $subject = "Qué tal";
    $body = "Cuerpo.";
    $attachment = "../archivo(1).pdf";



    if ($mail->sendEmail($from, $to, $cc, $attachment, $subject, $body)){
        echo "Correo enviado.";
    } else {
        echo "No se ha enviado el Correo";
    }
?>