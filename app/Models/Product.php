<?php
namespace App\Models;

use App\Core\Database;
use App\Services\CloudinaryService;

class Product
{
    protected static $table = 'products';

    // Fetch all products
    public static function all(): array
    {
        $stmt = Database::connect()->query("SELECT * FROM " . self::$table. " WHERE sold = 0 ");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    // Fetch a product by ID
    public static function findById(int $id): ?array
    {
        $stmt = Database::connect()->prepare("SELECT * FROM " . self::$table . " WHERE id = ? LIMIT 1");
        $stmt->execute([$id]);
        $product = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $product ?: null;
    }

    // Fetch products by a specific user
    public static function productsByMe(int $userId): array
    {
        $stmt = Database::connect()->prepare("SELECT * FROM " . self::$table . " WHERE user_id = ? AND sold = 0");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    // Fetch products bought by a user (not sold by them and unsold)
    public static function productsBoughtByMe(int $buyerId): array
{
    $sql = "
        SELECT 
            p.id,
            p.name AS name,
            p.price AS price,
            p.image AS image,
            p.quantity_sold,
            p.user_id AS vendor_id,

            br.reference_no,
            br.client_id,
            br.client_name,
            br.amount,
            br.date_added

        FROM orders o
        JOIN products p 
            ON p.id = o.itemId
        JOIN buyer_receipt br 
            ON br.client_id = o.user_id

        WHERE o.user_id = :buyer_id
          AND o.status = 1

        ORDER BY br.date_added DESC
    ";

    $stmt = Database::connect()->prepare($sql);

    // ✅ Correct named binding
    $stmt->bindValue(':buyer_id', $buyerId, \PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
}
   

    // Fetch products sold by a user
    public static function productsSoldByMe(int $vendorId): array
    {
        $sql = "
            SELECT 
                p.id,
                p.name,
                p.price,
                p.image,
                p.quantity_sold,
                p.user_id AS vendor_id,
    
                o.user_id AS buyer_id,
    
                br.reference_no,
                br.client_id,
                br.client_name,
                br.amount,
                br.date_added
    
            FROM orders o
            JOIN products p 
                ON p.id = o.itemId
    
            JOIN buyer_receipt br 
                ON br.client_id = o.user_id
    
            WHERE p.user_id = :vendor_id
              AND o.status = 1
    
            ORDER BY br.date_added DESC
        ";
    
        $stmt = Database::connect()->prepare($sql);
    
        // ✅ Correct named binding
        $stmt->bindValue(':vendor_id', $vendorId, \PDO::PARAM_INT);
        $stmt->execute();
    
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    

    // Count products sold by a user
    public static function noOfProductsSoldByMe(int $userId): array
    {
        $stmt = Database::connect()->prepare("SELECT COUNT(*) AS count FROM " . self::$table . " WHERE user_id = ? AND sold = 0");
        $stmt->execute([$userId]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    // Update a product by ID
    public static function update(int $id, array $data): bool
    {
        $fields = [];
        $values = [];

        foreach ($data as $key => $value) {
            $fields[] = "$key = ?";
            $values[] = $value;
        }

        $values[] = $id;

        $sql = "UPDATE " . self::$table . " SET " . implode(', ', $fields) . " WHERE id = ?";
        $stmt = Database::connect()->prepare($sql);

        return $stmt->execute($values);
    }


    public static function addToSoldQuantity(int $id, int $total): bool
    {
        $sql = "UPDATE " . self::$table . "
                SET quantity_sold = quantity_sold + ?
                WHERE id = ?";
    
        $stmt = Database::connect()->prepare($sql);
    
        return $stmt->execute([$total, $id]);
    }


    public static function removeFromQuantity(int $id, int $total): bool
    {
        $sql = "UPDATE " . self::$table . "
                SET quantity = quantity - ?
                WHERE id = ? AND quantity >= ?";
    
        $stmt = Database::connect()->prepare($sql);
    
        return $stmt->execute([$total, $id, $total]);


    }



    public static function changeToSold(int $id): bool
    {
        $sql = "UPDATE " . self::$table . "
                SET sold = 1
                WHERE id = ?";
    
        $stmt = Database::connect()->prepare($sql);
    
        return $stmt->execute([$id]);


    }
    


    public static function restoreQuantity(int $id, int $total): bool
    {
        $sql = "UPDATE " . self::$table . "
                SET quantity = quantity + ?
                WHERE id = ?";
    
        $stmt = Database::connect()->prepare($sql);
    
        return $stmt->execute([$total, $id]);
    }



    // Create a product with image upload via Cloudinary
    public static function createWithImage(array $data, array $file)
    {
        $imageUrl = CloudinaryService::upload($file['tmp_name'], "products");

        $stmt = Database::connect()->prepare(
            "INSERT INTO " . self::$table . " (name, price, image, user_id, quantity, quantity_sold, sold, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?)"
        );
        $stmt->execute([
            $data['name'],
            $data['price'],
            $imageUrl,
            $data['user_id'],
            $data['quantity'] ?? 1,
            $data['quantity_sold'] ?? 0,
            $data['sold'] ?? 0,
            $data['created_at'] ?? date("Y-m-d H:i:s")

        ]);

        return $imageUrl;
    }

    public static function byVendor(int $vendorId): array
{
    $sql = "SELECT 
                id,
                name,
                price,
                quantity,
                quantity_sold,      
                created_at
            FROM products
            WHERE user_id = ?
            ORDER BY created_at DESC";

    $stmt = Database::connect()->prepare($sql);
    $stmt->execute([$vendorId]);

    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
}


    public static function deleteProduct($id): array
    {
        $stmt = Database::connect()->query("DELETE FROM " . self::$table. "WHERE id = ?");
        $stmt->execute([$Id]);
    }
}
