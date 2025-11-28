<?php 
namespace Mikel\Ud3;
require '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;



$mail = new PHPMailer(true);
try {

    $mail->isSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = true;
    $mail->Username = "mikelnavarro33@gmail.com";
    $mail->Password   = 'zrdg ttks uqrn yexe'; 
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->setFrom('mikelnavarro33@gmail.com', 'Gmail');
    $mail->addAddress("mikelnavarro33@gmail.com", "Unidad 3");
    $mail->addReplyTo("mikelnavarro33@gmail.com");
    $mail->addAttachment("../archivo(1).pdf");
    $mail->isHTML(true);
    $mail->Subject = "Este es el asunto.";
    $mail->Body    = 'Esto es un mensaje enviado con Gmail Google';
    $mail->AltBody = "Cuerpo";
    $mail->send();
    echo "Correo enviado (a Google)";

} catch (Exception $e) {
    echo "Mensaje no envidado por error: {$mail->ErrorInfo}";
}
?>