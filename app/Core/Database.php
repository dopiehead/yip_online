<?php
namespace App\Core;

use PDO;

class Database {
    private static $instance;

    public static function connect() {
        if (!self::$instance) {
            $dsn = "mysql:host=".$_ENV['DB_HOST'].";dbname=".$_ENV['DB_NAME'];
            self::$instance = new PDO($dsn, $_ENV['DB_USER'], $_ENV['DB_PASS']);
            self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$instance;
    }
}
