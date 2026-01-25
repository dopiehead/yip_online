<?php
namespace App\Models;

use App\Core\Database;

class Order {

    public static function create($userId, $total) {
        $db = Database::connect();
        $stmt = $db->prepare(
            "INSERT INTO orders (user_id, total) VALUES (?, ?)"
        );
        $stmt->execute([$userId, $total]);
        return $db->lastInsertId();
    }

    public static function addItem($orderId, $productId, $qty, $price) {
        $stmt = Database::connect()->prepare(
            "INSERT INTO order_items 
             (order_id, product_id, quantity, price)
             VALUES (?, ?, ?, ?)"
        );
        $stmt->execute([$orderId, $productId, $qty, $price]);
    }

    public static function allWithUsers()
    {
        $db = Database::connect();

        $sql = "
            SELECT o.*, u.name AS user_name, u.user_email
            FROM orders o
            JOIN users u ON u.id = o.user_id
            ORDER BY o.created_at DESC
        ";

        return $db->query($sql)->fetchAll();
    }

    public static function updateStatus($orderId, $status)
    {
        $stmt = Database::connect()->prepare(
            "UPDATE orders SET status = ? WHERE id = ?"
        );

        $stmt->execute([$status, $orderId]);
    }

    public static function dashboardStats()
    {
        $db = Database::connect();

        return [
            'orders'  => $db->query("SELECT COUNT(*) FROM products")->fetchColumn(),
            'revenue' => $db->query("SELECT SUM(total) FROM orders")->fetchColumn(),
            'users'   => $db->query("SELECT COUNT(*) FROM users")->fetchColumn(),
        ];
    }
}

