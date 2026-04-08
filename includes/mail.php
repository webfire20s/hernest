<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/PHPMailer/src/Exception.php';
require_once __DIR__ . '/PHPMailer/src/PHPMailer.php';
require_once __DIR__ . '/PHPMailer/src/SMTP.php';

function sendMail($to, $subject, $message)
{
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
            $mail->Host       = 'mail.hernestworld.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'info@hernestworld.com';
            $mail->Password   = 'Webfire#@12#';

            $mail->SMTPSecure = 'ssl';
            $mail->Port       = 465;

            $mail->SMTPDebug = 3;
            $mail->Debugoutput = 'html';

        $mail->setFrom('info@hernestworld.com', 'HERNEST');
        $mail->addAddress($to);   

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $message;

        return $mail->send();

    } catch (Exception $e) {
        echo "Mailer Error: " . $mail->ErrorInfo;
        return false;
    }
}