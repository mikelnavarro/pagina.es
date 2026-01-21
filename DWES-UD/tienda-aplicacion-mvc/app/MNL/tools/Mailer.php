<?php
namespace MNL\tools;

require_once __DIR__ . '/../vendor/autoload.php';

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class Mailer
{
	/**
	 * Enviar correo usando SMTP configurado en config.ini.
	 * Devuelve true si se envía correctamente, o una cadena con el error.
	 */
	public static function send(string $to, string $subject, string $body, string $alt = null)
	{
		$config = Config::getInstance();

		// Obtener configuración de mail (si falta, usar isMail como fallback)
		$mailHost = $config->get('mail', 'host') ?? null;
		$mailPort = $config->get('mail', 'port') ?? null;
		$mailUser = $config->get('mail', 'user') ?? null;
		$mailPass = $config->get('mail', 'pass') ?? null;
		$mailFrom = $config->get('mail', 'from') ?? $mailUser ?? 'no-reply@localhost';
		$mailFromName = $config->get('mail', 'from_name') ?? 'Tienda';

		$mail = new PHPMailer(true);
		try {
			// Si hay host definido, usar SMTP
			if ($mailHost) {
				$mail->isSMTP();
				$mail->Host = $mailHost;
				$mail->SMTPAuth = true;
				$mail->Username = $mailUser;
				$mail->Password = $mailPass;
				if (defined('\PHPMailer\\PHPMailer\\PHPMailer::ENCRYPTION_STARTTLS')) {
					$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
				} else {
					$mail->SMTPSecure = 'tls';
				}
				$mail->Port = (int)$mailPort ?: 587;
			} else {
				// Fallback: usar mail() si no hay configuración SMTP
				$mail->isMail();
			}

			$mail->CharSet = 'UTF-8';
			$mail->setFrom($mailFrom, $mailFromName);
			$mail->addAddress($to);
			$mail->Subject = $subject;
			$mail->isHTML(true);
			$mail->Body = $body;
			$mail->AltBody = $alt ?? strip_tags($body);

			$mail->send();
			return true;
		} catch (Exception $e) {
			return $mail->ErrorInfo ?: $e->getMessage();
		}
	}
}