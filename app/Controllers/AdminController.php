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

        Auth::check();   // Must be logged in
        Auth::admin();   // Must be vendor/admin

        // Share user with all views safely
        $this->view->assign('user', Auth::user());
    }
    
    public function topbar()
    {   
        // Get stats
        $stats = Order::dashboardStats();
    
        // Get logged-in user from session (already stored at login)
        $user = $_SESSION['user'] ?? null;
    
        // Render sidebar template
        $this->render('admin/components/topbar.tpl', [
            'stats' => $stats,
            'user'  => $user
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
        // eager-loaded orders + users
        $orders = Order::allWithUsers();

        $this->render('admin/order-history.tpl', [
            'orders' => $orders
        ]);
    }

    public function updateStatus()
    {
        Auth::csrfCheck($_POST['csrf'] ?? null);

        Order::updateStatus(
            $_POST['order_id'] ?? null,
            $_POST['status'] ?? null
        );

        header('Location: /admin/order/update');
        exit;
    }

    public function myproducts()
    {
        // TODO: replace with Product::byAdmin() or similar
        $products = []; 

        $this->render('admin/contents.tpl', [
            'products' => $products
        ]);
    }

    public function postContents()
    {
        $this->render('admin/post-contents.tpl');
    }

    public function editProduct()
    {
        // TODO: load product by ID
        $product = null;

        $this->render('admin/post-contents.tpl', [
            'product' => $product
        ]);
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
