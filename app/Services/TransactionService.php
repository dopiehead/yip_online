<?php 

namespace App\Services;

use App\Models\Product;
use App\Models\Order;
use App\Core\Database;
use Exception;

class TransactionService
{
    public function process(int $userId, string $reference, float $amount, array $user): array
    {
        $db = Database::connect();
        $db->beginTransaction();
    
        try {// Payment confirmed in test mode ✅
        
            $cartItems = Order::cart($userId) ?? []; // Get user's cart items

            if (empty($cartItems)) {
                throw new \Exception("Cart is empty.");
            }
    
            foreach ($cartItems as $item) {
                // mark item paid
                Order::markPaid($item['id']); 
    
           // Increase sold quantity
                Product::addToSoldQuantity( $item['product_id'], $item['total']);
    
    // Reduce available stock
                Product::removeFromQuantity($item['product_id'], $item['total']);
    
    // Fetch updated product quantity
               $product = Product::findById($item['product_id']);
    
    // If stock is exhausted, mark as sold out
             if ($product && (int)$product['quantity'] <= 0) {
              Product::changeToSold($item['product_id']);
             }

            }
            
            // Save receipt
            $dateAdded = date('Y-m-d H:i:s');

            Order::saveReceipt($reference, $userId, $user['user_name'], $amount, $dateAdded);
    
            $db->commit();
    
            return $cartItems; // 🔥 Return for the controller
    
        } catch (\Throwable $e) {
            $db->rollBack();
            throw $e;
        }
    }
    
}
