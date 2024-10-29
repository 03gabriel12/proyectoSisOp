<?php

define('pass', 'fqwx xnkx aexl hxss');
define('email_sender', 'e3761144@gmail.com');


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';



function EnviarCorreo($para, $asunto, $html, $test = false)
{

    $mail = new PHPMailer(true);
    if ($test) {
        $mail->SMTPDebug = 2; // O 3 para más detalles
        $mail->Debugoutput = 'html'; // O 'error_log' para enviar la salida a un log
    }
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = email_sender;
        $mail->Password = pass; // Usa una contraseña de aplicación
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587; // Puerto TCP para SSL

        $mail->setFrom(email_sender, 'Verificacion de Cuenta Sistema de Usuario');
        $mail->addAddress($para);

        // Captura y procesa el contenido de 'correo_html.php' con variables dinámicas
        // ob_start();
        // include $html;
        // $html = ob_get_clean();


        $mail->isHTML(true);
        $mail->Subject = $asunto;
        $mail->Body = $html;
       // $mail->Body =  file_get_contents($html);

        $mail->send();
    } catch (Exception $e) {
        echo "Error al enviar el mensaje: {$mail->ErrorInfo}";
        die();
    }
}
