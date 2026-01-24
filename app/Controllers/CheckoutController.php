<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Services\MailService;

class CheckoutController extends Controller {

    public function index() {
        // User must be logged in (or handled by route group)
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit;
        }

        $this->view->assign('cart', $_SESSION['cart'] ?? []);
        $this->view->display('cart/checkout.tpl');
    }

    public function process() {
        // CSRF check
        if (!isset($_POST['csrf']) || $_POST['csrf'] !== $_SESSION['csrf']) {
            die("Invalid CSRF token");
        }

        // Cart empty?
        if (empty($_SESSION['cart'])) {
            header('Location: /cart');
            exit;
        }

        $userId = $_SESSION['user']['id'];
        $total = 0;

        // Calculate total
        foreach ($_SESSION['cart'] as $id => $qty) {
            $product = Product::find($id);
            $total += $product['price'] * $qty;
        }

        // Create order
        $orderId = Order::create($userId, $total);

        // Add items and reduce stock
        foreach ($_SESSION['cart'] as $id => $qty) {
            $product = Product::find($id);
            Order::addItem($orderId, $id, $qty, $product['price']);
            Product::reduceStock($id, $qty);
        }

        // Send confirmation email
        MailService::send(
            $_SESSION['user']['email'],
            'Order Confirmation',
            "Your order #{$orderId} was placed successfully."
        );

        // Clear cart
        unset($_SESSION['cart']);

        // Redirect to success page
        header('Location: /order/success');
        exit;
    }

    public function invoice($orderId) {
        header("Content-Type: application/pdf");
        echo "Invoice for order #$orderId";
    }
}
