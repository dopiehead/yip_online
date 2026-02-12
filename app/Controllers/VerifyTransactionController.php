<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Services\TransactionService;
use App\Models\User;
use App\Models\Order;
use Exception;

class VerifyTransactionController extends Controller
{
    public function index()
    {
        // Required GET parameters in test mode
        if (!isset($_GET['status'], $_GET['reference'], $_GET['id'], $_GET['amount'])) {
            $this->view->assign('error', 'Missing payment parameters.');
            $this->view->display('cart/verify-transaction.tpl');
            return;
        }

        $status    = htmlspecialchars($_GET['status'] ?? '');
        $reference = htmlspecialchars($_GET['reference'] ?? '');
        $amount    = (float)$_GET['amount'] ?? 0;
        $userId    = (int)$_GET['id'] ?? 0;

        // Load user
        if (!isset($_SESSION['user']) || $_SESSION['user']['id'] !== $userId) {
            $this->view->assign('error', 'User not logged in or invalid.');
            $this->view->display('cart/verify-transaction.tpl');
            return;
        }

        $user = User::find($userId);

        if (!$user) {
            $this->view->assign('error', 'User not found.');
            $this->view->display('cart/verify-transaction.tpl');
            return;
        }

        if ($status !== 'success') {
            $this->view->assign('error', 'Payment failed.');
            $this->view->display('cart/verify-transaction.tpl');
            return;
        }

        $cartItems = Order::cart($userId) ?? [];

        if(empty($cartItems)){
            header("Location:../index");
            exit;
        }

        // Payment confirmed in test mode ✅
         try {
            $transactionService = new TransactionService();
            $success = $transactionService->process( $userId,  $reference,  $amount,  $user); 
            if (!$success) {
                throw new \Exception("Transaction not succesful");
            }
    
         } 

         catch(\Throwable $e){
            throw $e;

         }

        // Compute totals for display
        $subtotal = 0;
        foreach ($cartItems as $item) {
            $subtotal += $item['price'] * $item['total'];
        }
        $VAT = $subtotal * 0.05;
        $deliveryFee = 2500;
        $grandTotal = $subtotal + $VAT + $deliveryFee;

        // Assign all to Smarty
        $this->view->assign([
            'success'       => true,
            'reference'     => $reference,
            'amount'        => $amount,
            'cart_items'    => $cartItems,
            'subtotal'      => $subtotal,
            'VAT'           => $VAT,
            'delivery_fee'  => $deliveryFee,
            'grand_total'   => $grandTotal,
            'buyer'         => $userId,
            'userName'      => $user['user_name'],
            'userEmail'     => $user['user_email'],
            // 'userAddress'   => $user['address'],
            'txn_ref'       => $reference,
            'paystackKey'   => $_ENV['paystack_key'] ?? ''
        ]);

        $this->view->display('cart/verify-transaction.tpl');
    }
}

