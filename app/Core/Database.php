<?php
namespace App\Core;

use PDO;

class Database {
    private static $instance;

    public static function connect() {
        if (!self::$instance) {
            try {
                $dsn = "mysql:host=" . $_ENV['DB_HOST'] . ";dbname=" . $_ENV['DB_NAME'];
                self::$instance = new PDO($dsn, $_ENV['DB_USER'], $_ENV['DB_PASS'], [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]);
            } catch (\PDOException $e) {
                // Log the error and show a friendly message
                error_log($e->getMessage());
                die("Database connection failed. Check logs.");
            }
        }

        return self::$instance;
    }
}
