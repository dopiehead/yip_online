<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Product;
use App\Models\Order;

class CartController extends Controller {
   
    public function index() {
        // Start session if not started
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    
        // Generate CSRF token if not set
        if (!isset($_SESSION['csrf'])) {
            $_SESSION['csrf'] = bin2hex(random_bytes(32));
        }
    
        // Check if user is logged in
        if (isset($_SESSION['user']) && isset($_SESSION['user']['id'])) {
            $userId = $_SESSION['user']['id'];
            $mycart = Order::noOfOrderInCart($userId) ?? ''; 
            $product = Order::cart($userId);

        } else {
            $userId = null;
            $product = [];
        }
    
        // Assign variables to the view safely
        $this->view->assign('product', $product ?? []);
        $this->view->assign('user', $_SESSION['user'] ?? []);
        $this->view->assign('mycart', $mycart ?? '');
        $this->view->assign('csrf_token', $_SESSION['csrf'] ?? '');
    
        $this->view->display('cart/index.tpl');
    }


    public function add()
    {
        header('Content-Type: application/json; charset=utf-8');
    
        try {
            // Only allow POST
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                http_response_code(405);
                echo json_encode(['error' => 'Method not allowed']);
                exit;
            }
    
            // Read JSON or POST
            $input = json_decode(file_get_contents('php://input'), true);
            $data  = $input ?? $_POST;
    
            // CSRF check
            if (!isset($data['csrf']) || $data['csrf'] !== $_SESSION['csrf']) {
                http_response_code(403);
                echo json_encode(['error' => 'Invalid CSRF token']);
                exit;
            }
    
            // Validate required fields
            if (!isset($data['product_id'])) {
                http_response_code(400);
                echo json_encode(['error' => 'Product ID is required']);
                exit;
            }
    
            $itemId = (int) $data['product_id'] ?? 0;
            $quantity = isset($data['noofitem']) ? (int)$data['noofitem'] : 1; // default 1
            $user_id = (int) ($data['buyer_id'] ?? 0);
            $status = 0;
            $created_at = date("Y-m-d H:i:s"); 
    
            if (!$user_id) {
                http_response_code(400);
                echo json_encode(['error' => 'Buyer ID is required']);
                exit;
            }
    
            // Add item to order/cart
            $success = Order::addItem($user_id, $quantity, $itemId, $status, $created_at);
    
            if (!$success) {
                http_response_code(500);
                echo json_encode(['error' => 'Error in adding item(s)']);
                exit;
            }
    
            // Return success response
            echo json_encode([
                'success' => true,
                'product_id' => $itemId,
                'quantity_added' => $quantity
            ]);
            exit;
    
        } catch (\Throwable $e) {
            http_response_code(500);
            echo json_encode([
                'error' => 'Server error',
                'message' => $e->getMessage()
            ]);
            exit;
        }
    }
    

    public function remove() {
        header('Content-Type: application/json');
    
    
        if (!isset($_SESSION['user'])) {
            echo json_encode(['success' => false, 'message' => 'User not logged in']);
            return;
        }
    
        // Read JSON input
        $data = json_decode(file_get_contents('php://input'), true);
    
        if (!isset($data['product_id'])) {
            echo json_encode(['success' => false, 'message' => 'Product ID missing']);
            return;
        }
    
        $user_id = $_SESSION['user']['id'];
        $id = (int) $data['product_id'];
    
        $success = Order::removeItem($user_id, $id);
    
        if ($success) {
            echo json_encode(['success' => true, 'message' => 'Item removed successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to remove item']);
        }
    }
    


}

