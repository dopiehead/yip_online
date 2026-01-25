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

        // Must be vendor/admin
        Auth::admin();   

        // Get logged-in user from session safely
        $this->user = $_SESSION['user'] ?? null;

        if (!$this->user) {
            header('Location: /login');
            exit;
        }

        // Ensure user ID exists
        $this->userId = $this->user['id'] ?? null;
        if (!$this->userId) {
            $this->render('errors/500.tpl', [
                'message' => 'User ID not found in session'
            ]);
            exit;
        }

        // Share user with all views
        $this->view->assign('user', $this->user);
    }

    public function topbar()
    {   
        $stats = Product::noOfProductsSoldByMe($this->userId) ?: [];

        $this->render('admin/components/topbar.tpl', [
            'stats' => $stats,
            'user'  => $this->user
        ]);
    }

    public function dashboard()
    {
        $stats = Order::dashboardStats();

        $this->render('admin/index.tpl', [
            'stats' => $stats
        ]);
    }

    public function orders()
    {
        $products = Product::productsBoughtByMe($this->userId) ?: [];

        $this->render('admin/order-history.tpl', [
            'products' => $products,
        ]);
    }

    public function updateStatus()
    {
      

        Order::updateStatus(
            $_POST['order_id'] ?? null,
            $_POST['status'] ?? null
        );

        header('Location: /admin/order/update');
        exit;
    }

    public function remove()
    {
        header('Content-Type: application/json');
    
        $id = $_POST['id'] ?? null;
    
        if (!$id) {
            echo json_encode([
                "status"  => "error",
                "message" => "Invalid product ID"
            ]);
            return;
        }
    
        $deleted = Product::deleteProduct($id);
    
        if ($deleted) {
            echo json_encode([
                "status"  => "success",
                "message" => "Item has been deleted successfully"
            ]);
        } else {
            echo json_encode([
                "status"  => "error",
                "message" => "Unable to delete product"
            ]);
        }
    }
    


    public function myproducts()
    {
        $products = Product::productsByMe($this->userId) ?: [];

        $this->render('admin/contents.tpl', [
            'products' => $products,
            'user'     => $this->user,
            'title'    => 'Contents'
        ]);
    }



    public function mysoldproducts()
    {
        $products = Product::productsSoldByMe($this->userId) ?: [];

        $this->render('admin/sold-history.tpl', [
            'products' => $products,
            'user'     => $this->user,
            'title'    => 'sold history'
        ]);
    }


    public function postContents()
    {
         
        $this->render('admin/post-contents.tpl',[
            'csrf_token' => $_SESSION['csrf'],
            
        ]);
    }


    public function createContent() {

    // Only allow POST
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        echo json_encode([
            'success' => false,
            'message' => 'Invalid request method.'
        ]);
        exit;
    }

    // Logged-in user
    $user = $this->user;
    $userId = $this->userId;

    // Collect form data
    $name = trim($_POST['product_name'] ?? '');
    $price = trim($_POST['product_price'] ?? '');
    $quantity = intval($_POST['product_quantity'] ?? 1);
    $files = $_FILES['product_images'] ?? null;

    $errors = [];

    if (empty($name)) $errors[] = 'Product name is required.';
    if (!is_numeric($price) || $price < 0) $errors[] = 'Price must be a valid number.';
    if ($quantity < 1) $errors[] = 'Quantity must be at least 1.';
    if (!$files || empty($files['name'][0])) $errors[] = 'At least one image is required.';

    if ($errors) {
        echo json_encode([
            'success' => false,
            'message' => implode('<br>', $errors)
        ]);
        exit;
    }

    $uploadedImages = [];

    // Handle multiple files
    foreach ($files['tmp_name'] as $index => $tmpName) {
        $fileName = $files['name'][$index];
        $fileType = $files['type'][$index];

        // Basic validation
        if (!in_array($fileType, ['image/jpeg','image/png','image/jpg'])) {
            echo json_encode([
                'success' => false,
                'message' => "File {$fileName} must be a JPG or PNG image."
            ]);
            exit;
        }

        // Upload each image via Cloudinary
        try {
            $uploadedUrl = Product::createWithImage([
                'name' => $name,
                'price' => $price,
                'user_id' => $userId,
                'quantity' => $quantity
            ], [
                'tmp_name' => $tmpName
            ]);

            $uploadedImages[] = $uploadedUrl;

        } catch (\Exception $e) {
            echo json_encode([
                'success' => false,
                'message' => "Failed to upload {$fileName}: " . $e->getMessage()
            ]);
            exit;
        }
    }

    // Return success JSON
    echo json_encode([
        'success' => true,
        'message' => 'Product successfully added with ' . count($uploadedImages) . ' image(s).',
        'images' => $uploadedImages
    ]);
    exit;
}




    public function editProduct()
    {
         $productId = isset($_GET['id']) && !empty($_GET['id']) ? (int)$_GET['id'] : null;

         $product = Product :: findById($productId);
     
         $this->render('admin/edit-product.tpl', [
            'product' => $product ?? null
        ]);
    }

    public function updateProduct()
    {
    
        $productId   = intval($_POST['id'] ?? 0);
        $productName = trim($_POST['name'] ?? '');
        $productPrice = trim($_POST['price'] ?? '');
        $productQuantity = intval($_POST['quantity'] ?? 1);
    
        $errors = [];
    
        if (!$productId) $errors[] = 'Invalid product ID.';
        if (empty($productName)) $errors[] = 'Product name is required.';
        if (!is_numeric($productPrice) || $productPrice < 0) $errors[] = 'Invalid product price.';
        if ($productQuantity < 1) $errors[] = 'Quantity must be at least 1.';
    
        $product = Product::findById($productId);
    
        if (!$product) {
            $_SESSION['errors'] = ['Product not found.'];
            header('Location: admin/contents');
            exit;
        }
    
        if ($product['user_id'] != $this->userId) {
            $_SESSION['errors'] = ['You do not have permission to edit this product.'];
            header('Location: admin/contents');
            exit;
        }
    
        $success = Product::update($productId, [
            'name' => $productName,
            'price' => $productPrice,
            'quantity' => $productQuantity
        ]);
    
        if ($success) {
            echo $_SESSION['success'] = 'Product updated successfully.';
        } else {
            echo $_SESSION['errors'] = ['Failed to update product.'];
        }

        

    }



    public function logout()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ../login');
            exit;
        }

        Auth::csrfCheck($_POST['csrf'] ?? null);

        $_SESSION = [];
        session_destroy();

        header("Location: ../login");
        exit;
    }
}
