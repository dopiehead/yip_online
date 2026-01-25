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
    public static function productsBoughtByMe(int $userId): array
    {
        $stmt = Database::connect()->prepare("SELECT * FROM " . self::$table . " WHERE user_id != ? AND sold = 0");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    // Fetch products sold by a user
    public static function productsSoldByMe(int $userId): array
    {
        $stmt = Database::connect()->prepare("SELECT * FROM " . self::$table . " WHERE user_id = ? AND sold = 1");
        $stmt->execute([$userId]);
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

    public static function removeFromQuantity(int $id, int $total): bool
    {
        $sql = "UPDATE " . self::$table . "
                SET quantity = quantity - ?
                WHERE id = ? AND quantity >= ?";
    
        $stmt = Database::connect()->prepare($sql);
    
        return $stmt->execute([$total, $id, $total]);
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
            "INSERT INTO " . self::$table . " (name, price, image, user_id, quantity, sold, created_at) VALUES (?, ?, ?, ?, ?, ?, ?)"
        );
        $stmt->execute([
            $data['name'],
            $data['price'],
            $imageUrl,
            $data['user_id'],
            $data['quantity'] ?? 1,
            $data['sold'] ?? 0,
            $data['created_at'] ?? date("Y-m-d H:i:s")

        ]);

        return $imageUrl;
    }



    public static function deleteProduct($id): array
    {
        $stmt = Database::connect()->query("DELETE FROM " . self::$table. "WHERE id = ?");
        $stmt->execute([$Id]);
    }
}
