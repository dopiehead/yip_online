<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Cache;
use App\Core\Validator;
use App\Models\User;
use App\Models\Product;

class ProductController extends Controller {

    // List all products (with cache)
    public function index() {
        $products = Cache::remember('products', 60, function () {
            return Product::all();
        });


        $minPrice = Product::minPrice() ?? 0;

        $maxPrice = Product::maxPrice() ?? 0;

        $this->render('products/index.tpl', [
            'products' => $products,
            'min_price' => $minPrice,
            'max_price' => $maxPrice

        ]);
    }

    // Show single product
    public function show() {
        if (!isset($_SESSION['csrf'])) {
            $_SESSION['csrf'] = bin2hex(random_bytes(32));
        }
        $userId = $_SESSION['user']['id'] ?? null;

        if (!isset($_GET['id'])) {
            $_SESSION['error'] = 'Product not found';
            header('Location: /');
            exit;
        }

        $product = Product::findById($_GET['id']);

        if (!$product) {
            $_SESSION['error'] = 'Product not found';
            header('Location: /');
            exit;
        }

        $this->render('products/show.tpl', [
            'product' => $product,
            'userId' =>$userId,
            'csrf_token' => $_SESSION['csrf'] ?? ''
        ]);
    }

    // Add a new product with Cloudinary upload
    public function store() {
        try {

            if (!isset($_SESSION['csrf'])) {
                $_SESSION['csrf'] = bin2hex(random_bytes(32));
            }
            // CSRF check
            if (
                !isset($_POST['csrf']) ||
                $_POST['csrf'] !== ($_SESSION['csrf'] ?? '')
            ) {
                throw new \Exception("Invalid CSRF token");
            }

            Validator::required($_POST, ['name', 'price']);

            // Validation
            if ( empty($_FILES['image']['tmp_name'])) {
                throw new \Exception("All fields are required");
            }

            if (strlen($_POST['name']) > 15) {
                throw new \Exception("Name must not exceed 15 characters");
            }

            Validator::type($_POST['price']);
             
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

    public function filter() {

        $minPrice = Product::minPrice() ?? 0;

        $maxPrice = Product::maxPrice() ?? 0;
     
        $this->render('partials/filter-form.tpl', [

            'csrf_token' => $_SESSION['csrf'] ?? '',
            'min_price' => $minPrice,
            'max_price' => $maxPrice


        ]);


    }


    public function filterProduct()
    {
        // CSRF token
        if (!isset($_SESSION['csrf'])) {
            $_SESSION['csrf'] = bin2hex(random_bytes(32));
        }

        // Input filters
        $filters = [
            'q' => $_POST['q'] ?? '',
            'category' => $_POST['category'] ?? null,
            'minprice' => $_POST['minprice'] ?? null,
            'maxprice' => $_POST['maxprice'] ?? null
        ];

        $sort = $_POST['sort'] ?? null;
        $page = isset($_POST['page']) ? (int)$_POST['page'] : 1;

        // Fetch filtered products
        $products = Product::search($filters,  $sort, (int)$page, 6);
        
        $totalRecords = Product::totalRecord();

        // Render the filter form template
        $this->render('partials/products.tpl', [
            'csrf_token' => $_SESSION['csrf'],
            'products' => $products,
            'totalRecord' => $totalRecords,
            'pagination' => Product::getPaginationLinks((int)$page, $totalRecords)

        ]);
    }

}
