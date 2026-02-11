<?php
namespace App\Models;

use App\Core\Database;
use PDO;

class Order {

    protected static string $table = 'orders';

    public static function create($userId, $total) {
        $db = Database::connect();
        $stmt = $db->prepare(
            "INSERT INTO orders (user_id, total) VALUES (?, ?)"
        );
        $stmt->execute([$userId, $total]);
        return $db->lastInsertId();
    }


    public static function cart($userId) {
        $db = Database::connect();
        $stmt = $db->prepare(
            "SELECT 
    o.*, 
    u.user_name AS user_name, 
    u.user_email AS email,
    p.id AS product_id,
    p.name AS name,
    p.price AS price
FROM orders o
JOIN users u ON u.id = o.user_id
JOIN products p ON p.id = o.itemId
WHERE o.user_id = ? AND o.status = 0
ORDER BY o.created_at DESC
"
        );
        $stmt->execute([$userId]);
        $order = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    
        return $order ?: null; // returns order array or null if none exists
    }


    public static function noOfOrderInCart($userId) {
        $db = Database::connect();
        $stmt = $db->prepare(
            "SELECT COUNT(*) as num_cart
             FROM orders o
             WHERE o.user_id = ? AND o.status = 0"
        );
        $stmt->execute([$userId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return $result ? (int)$result['num_cart'] : null;
    }


    public static function addItem($user_id, $quantity, $itemId, $status, $created_at)
    {
        $db = Database::connect();
    
        try {
            $db->beginTransaction();
    
            $stmt = $db->prepare(
                "INSERT INTO orders
                 (user_id, total, itemId, status, created_at)
                 VALUES (?, ?, ?, ?, ?)
                 ON DUPLICATE KEY UPDATE total = total + ?"
            );
    
            $result = $stmt->execute([
                $user_id,
                $quantity,   // goes into total
                $itemId,
                $status,
                $created_at,
                $quantity    // used for update
            ]);
    
            $db->commit();
            return $result;
    
        } catch (\PDOException $e) {
            $db->rollBack();
            error_log("Order insert error: " . $e->getMessage());
            return false;
        }
    }
    

    public static function removeItem(int $user_id, int $order_id): bool
{
    try {
        $db = Database::connect();

        $stmt = $db->prepare(
            "DELETE FROM orders WHERE user_id = :user_id AND id = :order_id"
        );

        // Execute with named parameters for clarity
        $success = $stmt->execute([
            ':user_id' => $user_id,
            ':order_id' => $order_id
        ]);

        return $success; // true on success, false on failure
    
    } catch (\PDOException $e) {
        // Log the error for debugging
        error_log("Order delete error: " . $e->getMessage());
        return false;
    }
}




    public static function allWithUsers()
    {
        $db = Database::connect();

        $sql = "
            SELECT o.*, u.user_name AS name, u.user_email
            AS email FROM orders o
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

    public static function markPaid(int $cartId): bool
    {
        $db = Database::connect();
        $stmt = $db->prepare("UPDATE " . self::$table . " SET status = 1 WHERE id = ?");
        return $stmt->execute([$cartId]);
    }

    /**
     * Save buyer receipt
     */
    public static function saveReceipt(
        string $reference,
        int $clientId,
        string $clientName,
        float $amount,
        string $dateAdded
    ): bool {
    
        // 1️⃣ Check if receipt already exists
        $check = Database::connect()->prepare(
            "SELECT id FROM buyer_receipt WHERE reference_no = ? LIMIT 1"
        );
        $check->execute([$reference]);
    
        if ($check->fetch()) {
            // Receipt already saved → do nothing
            return true;
        }
    
        // 2️⃣ Insert receipt
        $sql = "
            INSERT INTO buyer_receipt 
            (reference_no, client_name, client_id, amount, date_added)
            VALUES (?, ?, ?, ?, ?)
        ";
    
        $stmt = Database::connect()->prepare($sql);
    
        return $stmt->execute([
            $reference,
            $clientName,
            $clientId,
            $amount,
            $dateAdded
        ]);
    }

    
    
}

