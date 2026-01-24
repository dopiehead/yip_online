<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Cache;
use App\Models\User;
use App\Models\Product;

class ProductController extends Controller {

    // List all products (with cache)
    public function index() {
        $products = Cache::remember('products', 60, function () {
            return Product::all();
        });

        $this->render('products/index.tpl', [
            'products' => $products
        ]);
    }

    // Show single product
    public function show() {

        $userId = isset($_SESSION['id']) && !empty($_SESSION['id']) ? filter_var($_SESSION['id'], FILTER_SANITIZE_SPECIAL_CHARS) : null;

        if (!isset($_GET['id'])) {
            $_SESSION['error'] = 'Product not found';
            header('Location: /');
            exit;
        }

        $product = Product::find($_GET['id']);

        if (!$product) {
            $_SESSION['error'] = 'Product not found';
            header('Location: /');
            exit;
        }

        $this->render('products/show.tpl', [
            'product' => $product,
            'userId' =>$userId
        ]);
    }

    // Add a new product with Cloudinary upload
    public function store() {
        try {
            // CSRF check
            if (
                !isset($_POST['csrf']) ||
                $_POST['csrf'] !== ($_SESSION['csrf'] ?? null)
            ) {
                throw new \Exception("Invalid CSRF token");
            }

            // Validation
            if (empty($_POST['name']) || empty($_POST['price']) || empty($_FILES['image']['tmp_name'])) {
                throw new \Exception("All fields are required");
            }

            // Call Model method for upload + save
            Product::createWithImage($_POST, $_FILES['image']);

            $_SESSION['success'] = "Product added successfully.";
            header('Location: /admin/dashboard');
            exit;

        } catch (\Throwable $e) {
            $this->render('products/create.tpl', [
                'error' => $e->getMessage()
            ]);
        }
    }
}
