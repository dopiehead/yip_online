<?php

return [
    'public' => [
        '/index' => ['ProductController', 'index'],
        '/product' => ['ProductController', 'show'],
        '/api/products' => ['Api\ProductApiController', 'index'],
    ],

    'auth' => [
        '/login' => ['AuthController', 'login'],
        '/login-post' => ['AuthController', 'loginPost'],
        '/register' => ['AuthController', 'register'],
        '/register-post' => ['AuthController', 'registerPost'],
        '/checkout' => ['CheckoutController', 'index'],
        '/checkout/process' => ['CheckoutController', 'process'],
    ],

    'admin' => [
        '/admin' => ['AdminController', 'dashboard'],
        '/admin/orders' => ['AdminController', 'orders'],
        '/admin/order/update' => ['AdminController', 'updateStatus'],
    ],

    'cart' => [
        '/cart' => ['CartController', 'index'],
        '/cart/add' => ['CartController', 'add'],
        '/cart/remove' => ['CartController', 'remove'],
        '/cart/get' => ['CartController', 'get'],
    ],

    'payment' => [
        '/pay' => ['PaymentController', 'pay'],
    ],
];
