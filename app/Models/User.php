<?php
namespace App\Models;

use App\Core\Database;
use PDO;

class User {

    public static function all() {
        $stmt = Database::connect()->query("SELECT * FROM users");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function find($id) {
        $stmt = Database::connect()->prepare("SELECT * FROM users WHERE id=?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function findByEmail($email) {
        $stmt = Database::connect()->prepare("SELECT * FROM users WHERE user_email=?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create(array $data) {
        // Ensure required keys exist
        $name = trim($data['name'] ?? '');
        $email = trim($data['email'] ?? '');
        $password = trim($data['password'] ?? '');
        $user_type = trim($data['user_type'] ?? 'user'); // default to 'user'
        $created_at = $data['created_at'] ?? date("Y-m-d H:i:s");
    
        if (!$name || !$email || !$password) {
            throw new \Exception("Name, email, and password are required");
        }
    
        $hash = password_hash($password, PASSWORD_DEFAULT);
    
        $stmt = Database::connect()->prepare(
            "INSERT INTO users (user_name, user_email, user_password, user_type, reset_token, created_at) 
             VALUES (?, ?, ?, ?, ?, ?)"
        );
    
        // reset_token is initially NULL
        return $stmt->execute([$name, $email, $hash, $user_type, null, $created_at]);
    }
    

    public static function update($id, $data) {
        $fields = [];
        $values = [];

        foreach ($data as $key => $value) {
            if ($key === 'password') {
                $value = password_hash($value, PASSWORD_DEFAULT);
            }
            $fields[] = "$key=?";
            $values[] = $value;
        }


    }

}
