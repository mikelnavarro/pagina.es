<?php 
namespace Mikel\Ud3;
require '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;



$mail = new PHPMailer(true);
try {

    $mail->isSMTP();
    $mail->Host = "sandbox.smtp.mailtrap.io";
    $mail->SMTPAuth = true;
    $mail->Username = "461e9cba9e036a";
    $mail->Password   = '453dccf1532dc9'; 
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->setFrom('hello@demomailtrap.co', 'Mailtrap');
    $mail->addAddress("mikelnavarro33@gmail.com", "Unidad 3");
    $mail->addReplyTo("mikelnavarro33@gmail.com");
    $mail->addAttachment("../archivo(1).pdf");
    $mail->isHTML(true);
    $mail->Subject = "Este es el asunto.";
    $mail->Body    = 'Congrats for sending test email with Mailtrap';
    $mail->AltBody = "Cuerpo";
    $mail->send();
    echo "Correo enviado (a Mailtrap)";

} catch (Exception $e) {
    echo "Mensaje no envidado por error: {$mail->ErrorInfo}";
}
?>