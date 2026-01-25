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

    // Make sure the user is an admin/vendor
    public static function admin() {
        // First, ensure user is logged in
        self::check();

        // Safe check
        if (!isset($_SESSION['user']['user_type']) || $_SESSION['user']['user_type'] !== 'vendor') {
            http_response_code(403);
            exit('Forbidden');
        }
    }

    // Optional: get current logged-in user
    public static function user() {
        return $_SESSION['user'] ?? null;
    }
}