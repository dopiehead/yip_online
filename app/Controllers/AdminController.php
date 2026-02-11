<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Auth;
use App\Models\Order;
use App\Models\Product;

class AdminController extends Controller
{
    protected array $user;
    protected int $userId;

    public function __construct()
    {
        parent::__construct();

        // Must be logged in
        Auth::check();

        // Get logged-in user safely
        $this->user = $_SESSION['user'] ?? null;
        if (!$this->user) {
            header('Location: /login');
            exit;
        }

        $this->userId = $this->user['id'] ?? 0;
        if (!$this->userId) {
            $this->render('errors/500.tpl', [
                'message' => 'User ID not found in session'
            ]);
            exit;
        }

        // Share user with all views
        $this->view->assign('user', $this->user);
    }

    // =======================
    // VIEWS
    // =======================

    public function topbar()
    {
        // Only vendors/admins have stats
        $stats = $this->isVendor() ? Product::noOfProductsSoldByMe($this->userId) : [];
        $this->render('admin/components/topbar.tpl', [
            'stats' => $stats,
            'user' => $this->user
        ]);
    }

    public function sidebar()
    {
        $this->render('admin/components/sidebar.tpl', [
            'user' => $this->user
        ]);
    }

    public function dashboard()
    {
        $this->requireVendor();

        $products = Product::byVendor($this->userId);
        $this->render('admin/index.tpl', [
            'products' => $products,
            'vendor' => $this->userId
        ]);
    }

    public function orders()
    {
        // All logged-in users can see order history
        $products = Product::productsBoughtByMe($this->userId) ?: [];
        $totalPrice = 0;

        foreach ($products as $product) {
       $totalPrice += $product['total'] * $product['price'];
       }
        $this->render('admin/order-history.tpl', [
            'products' => $products,
            'totalPrice' => $totalPrice
        ]);
    }

    public function myproducts()
    {
        $this->requireVendor();
        $products = Product::productsByMe($this->userId) ?: [];
        $this->render('admin/contents.tpl', [
            'products' => $products,
            'user' => $this->user,
            'title' => 'Contents'
        ]);
    }

    public function mysoldproducts()
    {
        $this->requireVendor();
        $products = Product::productsSoldByMe($this->userId) ?: [];
        $this->render('admin/sold-history.tpl', [
            'products' => $products,
            'user' => $this->user,
            'title' => 'Sold History'
        ]);
    }

    public function postContents()
    {
        $this->requireVendor();

        if (!isset($_SESSION['csrf'])) {
            $_SESSION['csrf'] = bin2hex(random_bytes(32));
        }

        $this->render('admin/post-contents.tpl', [
            'csrf_token' => $_SESSION['csrf'] ?? ''
        ]);
    }

    public function editProduct()
    {
        $this->requireVendor();

        $productId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        
        $product = Product::findById($productId);

        $this->render('admin/edit-product.tpl', [
            'product' => $product ?? null
        ]);
    }

    public function dashboardRemoveProduct()
    {
        $this->requireVendor();
        header('Content-Type: application/json');

        $id = $_POST['id'] ?? null;
        if (!$id) {
            echo json_encode([
                "status" => "error",
                "message" => "Invalid product ID"
            ]);
            return;
        }

        $deleted = Product::deleteProduct($id);
        echo json_encode([
            "status" => $deleted ? "success" : "error",
            "message" => $deleted ? "Item deleted successfully" : "Unable to delete product"
        ]);
    }

    // =======================
    // CREATE / UPDATE PRODUCTS
    // =======================

    public function createContent()
    {
        $this->requireVendor();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
            exit;
        }

        $name = trim($_POST['product_name'] ?? '');
        $price = trim($_POST['product_price'] ?? '');
        $category = intval($_POST['product_category'] ?? 1);
        $quantity = intval($_POST['product_quantity'] ?? 1);
        $files = $_FILES['product_images'] ?? null;

        $errors = [];
        if (empty($name)) $errors[] = 'Product name is required.';
        if (!is_numeric($price) || $price < 0) $errors[] = 'Price must be a valid number.';
        if ($quantity < 1) $errors[] = 'Quantity must be at least 1.';
        if (!$files || empty($files['name'][0])) $errors[] = 'At least one image is required.';
        if ($errors) {
            echo json_encode(['success' => false, 'message' => implode('<br>', $errors)]);
            exit;
        }

        $uploadedImages = [];
        foreach ($files['tmp_name'] as $index => $tmpName) {
            $fileName = $files['name'][$index];
            $fileType = $files['type'][$index];

            if (!in_array($fileType, ['image/jpeg','image/png','image/jpg'])) {
                echo json_encode(['success' => false, 'message' => "File {$fileName} must be JPG or PNG."]);
                exit;
            }

            try {
                $uploadedUrl = Product::createWithImage([
                    'name' => $name,
                    'price' => $price,
                    'user_id' => $this->userId,
                    'category' =>$category,
                    'quantity' => $quantity
                ], ['tmp_name' => $tmpName]);

                $uploadedImages[] = $uploadedUrl;

            } catch (\Exception $e) {
                echo json_encode(['success' => false, 'message' => "Failed to upload {$fileName}: " . $e->getMessage()]);
                exit;
            }
        }

        echo json_encode([
            'success' => true,
            'message' => 'Product added with ' . count($uploadedImages) . ' image(s).',
            'images' => $uploadedImages
        ]);
    }

    public function updateProduct()
    {
        $this->requireVendor();

        $productId = intval($_POST['id'] ?? 0);
        $productName = trim($_POST['name'] ?? '');
        $productPrice = trim($_POST['price'] ?? '');
        $productQuantity = intval($_POST['quantity'] ?? 1);

        $errors = [];
        if (!$productId) $errors[] = 'Invalid product ID.';
        if (empty($productName)) $errors[] = 'Product name is required.';
        if (!is_numeric($productPrice) || $productPrice < 0) $errors[] = 'Invalid price.';
        if ($productQuantity < 1) $errors[] = 'Quantity must be at least 1.';

        $product = Product::findById($productId);
        if (!$product || $product['user_id'] != $this->userId) {
            echo json_encode(['success' => false, 'message' => 'Product not found or no permission.']);
            exit;
        }

        $success = Product::update($productId, [
            'name' => $productName,
            'price' => $productPrice,
            'quantity' => $productQuantity
        ]);

        echo json_encode([
            'success' => $success,
            'message' => $success ? 'Product updated successfully.' : 'Failed to update product.'
        ]);
    }

    // =======================
    // LOGOUT
    // =======================
    public function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start(); // Make sure session is started
        }
    
        // Unset all session variables
        $_SESSION = [];
    
        // Destroy the session cookie (important)
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(), 
                '', 
                time() - 42000,
                $params["path"], 
                $params["domain"],
                $params["secure"], 
                $params["httponly"]
            );
        }
    
        // Destroy the session
        session_destroy();
    
        // Redirect to home page
        header("Location: ../index"); // Use absolute path if possible
        exit;
    }
    
    // =======================
    // HELPER FUNCTIONS
    // =======================

    private function isVendor(): bool
    {
        return isset($this->user['user_type']) && $this->user['user_type'] === 'vendor';
    }

    private function requireVendor()
    {
        if (!$this->isVendor()) {
            header('Location: order-history'); // send non-vendors to orders page
            exit;
        }
    }
}
