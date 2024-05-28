<?php

namespace App\Services;

use Exception;
use PHPMailer\PHPMailer\PHPMailer;

class MailService
{
    public function sendMail(string $email, string $name, int $age, string $message)
    {
        try {
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->Host = 'sandbox.smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Port = 2525;
            $mail->Username = '013469f36db924';
            $mail->Password = '5859071a219cf8';
            $mail->CharSet = 'utf8';

            $mail->setFrom($email, $name);
            $mail->addAddress('harcenkoila278@gmail.com', 'Ilya');

            $mail->isHTML(true);
            $mail->Subject = 'Новое сообщение с Laravel';
            $mail->Body = 'Возвраст: ' . $age . '<br> Сообщение: ' . $message;

            $mail->send();
        } catch (Exception $e) {
            echo "К сожелению сообщение не отправилось :(. Ошибка: $mail->ErrorInfo";
        }
    }
}
