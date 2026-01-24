<?php
namespace App\Core;

class Auth {
    public static function check() {
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit;
        }
    }

    public static function admin() {
        if ($_SESSION['user']['role'] !== 'admin') {
            http_response_code(403);
            exit('Forbidden');
        }
    }
}
