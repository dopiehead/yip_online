<?php
namespace App\Models;
use PDO;
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


    public static function totalRecord(): int
    {
        $stmt = Database::connect()->query(
            "SELECT COUNT(*) AS count FROM " . self::$table . " WHERE sold = 0"
        );
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $row ? (int)$row['count'] : 0;
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
        $sql = "SELECT 
            p.id,
            p.name AS name,
            p.price AS price,
            p.image AS image, 
            p.quantity_sold AS total,
            p.user_id AS vendor_id,
            b.reference_no AS reference_no,
            b.client_id AS client_id
        FROM orders o
        JOIN products p 
            ON p.id = o.itemId
        JOIN buyer_receipt b
            ON b.client_id = o.user_id
        WHERE o.user_id = :buyer_id
          AND o.status = 1
        ORDER BY o.id DESC";
    
        $stmt = Database::connect()->prepare($sql);
        $stmt->bindValue(':buyer_id', $buyerId, \PDO::PARAM_INT);
        $stmt->execute();
    
        return $stmt->fetchAll(\PDO::FETCH_ASSOC) ?: [];
    }
    

    // Fetch products sold by a user
    public static function productsSoldByMe(int $vendorId): array
    {
        $sql = "SELECT 
            p.id,
            p.name,
            p.price,
            p.image,
            p.quantity_sold AS total,
            p.user_id AS vendor_id,
            br.reference_no,
            br.client_id,
            br.client_name,
            br.amount,
            br.date_added
        FROM orders o
        JOIN products p ON p.id = o.itemId
        JOIN buyer_receipt br ON br.id = (
            SELECT id
            FROM buyer_receipt
            ORDER BY date_added DESC
            LIMIT 1
        )
        WHERE o.status = 1
          AND p.user_id = :vendor_id
        ORDER BY br.date_added DESC";
    
        $stmt = Database::connect()->prepare($sql);
        $stmt->bindValue(':vendor_id', $vendorId, PDO::PARAM_INT);
        $stmt->execute();
    
        return $stmt->fetchAll(\PDO::FETCH_ASSOC); // ✅ ALWAYS array
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


    public static function minPrice(): ?float
    {
        $sql = "SELECT MIN(price) as min_price FROM " . self::$table;
        $stmt = Database::connect()->prepare($sql);
        $stmt->execute();
    
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return $row ? (float)$row['min_price'] : null;
    }



    public static function maxPrice(): ?float
    {
        $sql = "SELECT MAX(price) as max_price FROM " . self::$table;
        $stmt = Database::connect()->prepare($sql);
        $stmt->execute();
    
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return $row ? (float)$row['max_price'] : null;
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
            "INSERT INTO " . self::$table . " (name, price, image, category, user_id, quantity, quantity_sold, sold, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)"
        );
        $stmt->execute([
            $data['name'],
            $data['price'],
            $imageUrl,
            $data['category'],
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



    public static function search(array $filters = [], ?string $sort = null, int $page = 1, int $perPage = 6): array
{
    $db = Database::connect();

    // 🛡 Always sanitize pagination
    $page = max(1, (int)$page);
    $perPage = max(1, (int)$perPage);
    $offset = ($page - 1) * $perPage;

    $sql = "SELECT * FROM " . self::$table . " WHERE sold = 0";
    $params = [];

    // 🔍 Search
    if (!empty($filters['q'])) {
        $stop_words = ['in','the','a','an','and','or','for','to','at','on','with','by','us','from','but','when','who','can','find','they','where','am','we','while'];
        $words = explode(" ", strtolower($filters['q']));
        $filtered = array_filter($words, fn($w) => !empty($w) && !in_array($w, $stop_words));

        if ($filtered) {
            $group = [];
            foreach ($filtered as $i => $word) {
                $key = ":search$i";
                $group[] = "(name LIKE $key OR category LIKE $key OR price LIKE $key)";
                $params[$key] = "%$word%";
            }
            // OR inside group, AND outside
            $sql .= " AND (" . implode(" OR ", $group) . ")";
        }
    }

    // Category
    if (!empty($filters['category'])) {
        $sql .= " AND category = :category";
        $params[':category'] = $filters['category'];
    }

    // Prices
    if ($filters['minprice'] !== '' && isset($filters['minprice'])) {
        $sql .= " AND price >= :minprice";
        $params[':minprice'] = (float)$filters['minprice'];
    }

    if ($filters['maxprice'] !== '' && isset($filters['maxprice'])) {
        $sql .= " AND price <= :maxprice";
        $params[':maxprice'] = (float)$filters['maxprice'];
    }

    // 🔄 Sorting (BEFORE LIMIT ✔)
    $allowedSorts = [
        'newest'     => 'id DESC',
        'oldest'     => 'id ASC',
        'price_high' => 'price DESC',
        'price_low'  => 'price ASC'
    ];

    $sql .= " ORDER BY " . ($allowedSorts[$sort] ?? 'id DESC');

    // 📄 Pagination
    $sql .= " LIMIT :offset, :perpage";
    $params[':offset'] = $offset;
    $params[':perpage'] = $perPage;

    $stmt = $db->prepare($sql);

    foreach ($params as $key => $val) {
        $type = in_array($key, [':offset', ':perpage']) ? PDO::PARAM_INT : PDO::PARAM_STR;
        $stmt->bindValue($key, $val, $type);
    }

    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


public static function getPaginationLinks(int $currentPage, int $totalRecords, int $perPage = 6): string
    {
        $totalPages = ($totalRecords > 0) ? ceil($totalRecords / $perPage) : 1;
        $radius = 2;
        $html = "<div class='text-center mt-4'>";

        // Previous
        if ($currentPage > 1) {
            $prev = $currentPage - 1;
            $html .= "<a class='btn btn-success btn-pagination mx-1 prev' data-page='{$prev}'>&lt;</a>";
        }

        $dotBefore = false;
        $dotAfter = false;

        for ($i = 1; $i <= $totalPages; $i++) {
            if ($i <= $radius || ($i >= $currentPage - $radius && $i <= $currentPage + $radius) || $i > $totalPages - $radius) {
                $btnClass = ($i === $currentPage) ? 'btn btn-pagination btn-success active' : 'btn btn-outline-success btn-pagination';
                $html .= "<a class='{$btnClass} mx-1' data-page='{$i}'>{$i}</a>";
            } elseif ($i < $currentPage - $radius && !$dotBefore) {
                $html .= "<span class='mx-1'>...</span>";
                $dotBefore = true;
            } elseif ($i > $currentPage + $radius && !$dotAfter && $i < $totalPages - $radius + 1) {
                $html .= "<span class='mx-1'>...</span>";
                $dotAfter = true;
            }
        }

        // Next
        if ($currentPage < $totalPages) {
            $next = $currentPage + 1;
            $html .= "<a class='btn btn-success mx-1 next btn-pagination' data-page='{$next}'>&gt;</a>";
        }

        $html .= "</div>";
        return $html;
    }


}
