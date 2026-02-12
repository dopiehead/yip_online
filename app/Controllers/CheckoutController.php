<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;
use App\Models\Order;

class CheckoutController extends Controller
{
    public function index()
    {
       

        if (!isset($_SESSION['csrf'])) {
            $_SESSION['csrf'] = bin2hex(random_bytes(32));
        }

        if (!isset($_SESSION['user'])) {
            header('Location: ../login');
            exit;
        }

        $buyer = $_SESSION['user']['id'];
        $cartItems = Order::cart($buyer);
        $mycart = Order::noOfOrderInCart($buyer) ?? ''; 
        if (empty($cartItems)) {
            header("Location: index");
            exit;
        }

        $subtotal = 0;
        foreach ($cartItems as $item) {
            $subtotal += $item['price'] * $item['total'];
        }

        $txn_ref = uniqid('TXN_');

        $_SESSION['txn_ref'] = $txn_ref;

        $this->view->assign([
            'csrf_token'  => $_SESSION['csrf'] ?? '',
            'buyer'       => $buyer,
            'email'       => $_SESSION['user']['user_email'],
            'cart_items'  => $cartItems,
            'mycart'      =>$mycart,
            'subtotal'    => $subtotal, // ⚠️ DO NOT FORMAT
            'txn_ref'     => $txn_ref,
            'paystackKey' => $_ENV['paystack_key']
        ]);

        $this->view->display('cart/checkout.tpl');
    }
}
