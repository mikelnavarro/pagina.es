<?php

namespace Mikel\Ud3;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../vendor/autoload.php';
class Mailer {

    
    protected PHPMailer $mail;
    public function __construct() {
        $this->mail = new PHPMailer(true);
    // Configuración del SMTP
    $this->mail->isSMTP();
    $this->mail->Host = "smtp.gmail.com";
    $this->mail->SMTPAuth = true;
    $this->mail->Username = "mikelnavarro33@gmail.com";
    $this->mail->Password   = 'zrdg ttks uqrn yexe'; 
    $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $this->mail->Port = 587;


    }

    // Definir los métodos
    public function sendEmail($from, $to, $cc, $attachment, $subject, $body) {
    try {
        $this->mail->setFrom($from);
        $this->mail->addAddress($to);

        if (!empty($cc)) {
        $this->mail->addCC($cc);
        }
        
        if (!empty($attachment) && file_exists($attachment)) {
            $this->mail->addAttachment($attachment);
        }

        $this->mail->isHTML(true);
        $this->mail->Subject = $subject;
        $this->mail->Body    = $body;
        return $this->mail->send();
    } catch (Exception $excepcion){
    echo "Mensaje no enviado por error: {$this->mail->ErrorInfo}";
}

}
}

?>