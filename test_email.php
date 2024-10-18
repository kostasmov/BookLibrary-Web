<?php

require 'vendor/autoload.php'; // Подключите автозагрузчик Composer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true); // Создаем новый экземпляр PHPMailer

try {
    // Настройка SMTP
    $mail->isSMTP(); // Указываем, что будем использовать SMTP
    $mail->Host = 'smtp.mailtrap.io'; // Укажите SMTP-сервер
    $mail->SMTPAuth = true; // Включаем аутентификацию
    $mail->Username = '60c2ddd08f3267'; // Ваш логин
    $mail->Password = '557b2f6d565a8d'; // Ваш пароль
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Включаем TLS
    $mail->Port = 2525; // Укажите порт (обычно 2525, 587 или 465)

    // Получатели
    $mail->setFrom('example@example.com', 'Имя отправителя'); // Укажите адрес отправителя
    $mail->addAddress('vasvasvas@mail.ru'); // Добавляем адрес получателя

    // Содержимое письма
    $mail->isHTML(true); // Указываем, что тело письма будет в формате HTML
    $mail->Subject = 'Тестовое письмо';
    $mail->Body    = 'Это тестовое письмо для проверки соединения с SMTP.';
    $mail->AltBody = 'Это текстовое сообщение для тех, кто не поддерживает HTML.';

    // Отправляем письмо
    $mail->send();
    echo 'Письмо отправлено успешно';
} catch (Exception $e) {
    echo "Ошибка при отправке: {$mail->ErrorInfo}";
}
