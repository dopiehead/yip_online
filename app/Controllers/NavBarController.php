<?php

namespace App\Controllers;

use App\Core\Controller;

class NavBarController extends Controller
{
    public function navbar()
    {

        // Safely get user ID (null if not logged in)
        $userId = $_SESSION['user']['id'] ?? null;   
        var_dump($_SESSION['user']); exit;
        $this->render('partials/navbar.tpl', [
            'userId' => $userId,
            'isLoggedIn' => !empty($userId)
        ]);
    }
}
