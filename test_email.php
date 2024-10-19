<?php

require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

try {
    // Настройка SMTP
    $mail->isSMTP();
    $mail->Host = 'smtp.mailtrap.io';
    $mail->SMTPAuth = true;
    $mail->Username = '60c2ddd08f3267';
    $mail->Password = '557b2f6d565a8d';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 2525;

    // Получатели
    $mail->setFrom('example@example.com', 'Имя отправителя');
    $mail->addAddress('vasvasvas@mail.ru');

    // Содержимое письма
    $mail->isHTML(true);
    $mail->Subject = 'Тестовое письмо';
    $mail->Body    = 'Это тестовое письмо для проверки соединения с SMTP.';
    $mail->AltBody = 'Это текстовое сообщение для тех, кто не поддерживает HTML.';

    $mail->send();
    echo 'Письмо отправлено успешно';
} catch (Exception $e) {
    echo "Ошибка при отправке: {$mail->ErrorInfo}";
}
