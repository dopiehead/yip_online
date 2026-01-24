<?php

return [

    // Public routes
    'public' => [
        '/' => ['ProductController', 'index'],
        '/product' => ['ProductController', 'show'],
        '/login' => ['AuthController', 'login'],
        '/register' => ['AuthController', 'register'],
    ],

    // Authenticated routes (user must be logged in)
    'auth' => [
        '/cart' => ['CartController', 'index'],
        '/cart/add' => ['CartController', 'add'],
        '/cart/remove' => ['CartController', 'remove'],
        '/cart/get' => ['CartController', 'get'],

        '/checkout' => ['CheckoutController', 'index'],
        '/checkout/process' => ['CheckoutController', 'process'],

        '/pay' => ['PaymentController', 'pay'],
    ],

    // Admin routes (user must be admin)
    'admin' => [
        '/admin' => ['AdminController', 'dashboard'],
        '/admin/orders' => ['AdminController', 'orders'],
        '/admin/order/update' => ['AdminController', 'updateStatus'],
    ],

    // API routes
    'api' => [
        '/api/products' => ['Api\ProductApiController', 'index'],
    ],

];
