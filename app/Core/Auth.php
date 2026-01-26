<?php
namespace App\Core;

class Auth {

    // Make sure the user is logged in
    public static function check() {
        if (!isset($_SESSION['user']) || empty($_SESSION['user'])) {
            header('Location: /login');
            exit;
        }
    }

    // Optional: get current logged-in user
    public static function user() {
        return $_SESSION['user'] ?? null;
    }
}