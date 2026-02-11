<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Order;

class NavBarController extends Controller
{
    public function navbar()
    {
        // Safely get user ID (null if not logged in)
        $userId = $_SESSION['user']['id'] ?? null;  
        $mycart = Order::noOfOrderInCart($userId) ?? ''; 
         exit;
        $this->render('partials/navbar.tpl', [
            'userId' => $userId ?? 0,
            'isLoggedIn' => !empty($userId),
            'mycart'    => $mycart
        ]);
    }
}
