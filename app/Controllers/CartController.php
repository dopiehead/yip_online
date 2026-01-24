<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Product;

class CartController extends Controller {

    public function index() {
        $this->view->assign('cart', $_SESSION['cart'] ?? []);
        $this->view->display('cart/index.tpl');
    }


    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_POST['csrf']) || $_POST['csrf'] !== $_SESSION['csrf']) {
                throw new \Exception("Invalid CSRF token");
            }
        }
        
        $id = $_POST['product_id'];
        $_SESSION['cart'][$id] = ($_SESSION['cart'][$id] ?? 0) + 1;
        $_SESSION['cart'][$id] = ($_SESSION['cart'][$id] ?? 0) + 1;

        echo json_encode([
            'success' => true,
            'count' => array_sum($_SESSION['cart'])
        ]);
    }


    public function remove() {
        $id = (int) $_POST['product_id'];
        unset($_SESSION['cart'][$id]);

        echo json_encode([
            'success' => true,
            'count' => array_sum($_SESSION['cart'] ?? [])
        ]);
    }

    public function get() {
        echo json_encode($_SESSION['cart'] ?? []);
    }





}

