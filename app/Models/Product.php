<?php
namespace App\Models;

use App\Core\Database;
use App\Services\CloudinaryService;

class Product {

    public static function all() {
        $stmt = Database::connect()->query("SELECT * FROM products");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function find($id) {
        $stmt = Database::connect()->prepare("SELECT * FROM products WHERE id=?");
        $stmt->execute([$id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    // CREATE product with Cloudinary upload
    public static function createWithImage($data, $file) {
        // Upload image
        $imageUrl = CloudinaryService::upload($file['tmp_name'], "products");

        // Insert into database
        $stmt = Database::connect()->prepare(
            "INSERT INTO products (name, price, image) VALUES (?, ?, ?)"
        );
        $stmt->execute([
            $data['name'],
            $data['price'],
            $imageUrl
        ]);

        return $imageUrl; // optionally return the uploaded URL
    }
}
