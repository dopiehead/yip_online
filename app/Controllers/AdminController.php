<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Auth;
use App\Models\Order;

class AdminController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        Auth::check();   // must be logged in
        Auth::admin();   // must be admin
    }

    public function dashboard()
    {
        $stats = Order::dashboardStats();

        $this->view->assign('stats', $stats);
        $this->view->display('admin/dashboard.tpl');
    }

    public function orders()
    {
        // eager-loaded orders + users
        $orders = Order::allWithUsers();

        $this->view->assign('orders', $orders);
        $this->view->display('admin/orders.tpl');
    }

    public function updateStatus()
    {
        Auth::csrfCheck($_POST['csrf']);

        Order::updateStatus(
            $_POST['order_id'],
            $_POST['status']
        );

        header('Location: /admin/orders');
        exit;
    }
}
