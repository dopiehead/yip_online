<?php
namespace App\Services;

class MailService {
    public static function send($to, $subject, $message) {
        $headers = "From: no-reply@ecommerce.test\r\n";
        mail($to, $subject, $message, $headers);
    }
}
