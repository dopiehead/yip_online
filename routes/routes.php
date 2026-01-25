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
        '/admin/index' => ['AdminController', 'dashboard'],
        '/admin/order-history' => ['AdminController', 'orders'],
        '/admin/contents' => ['AdminController', 'myproducts'],
        '/admin/post-contents' => ['AdminController', 'postContents'],
        '/admin/components/topbar' => ['AdminController', 'topbar'],
        '/admin/edit-product' => ['AdminController', 'editProduct'],
        '/admin/update-product' => ['AdminController', 'updateProduct'],
        '/admin/remove-product' => ['AdminController', 'remove'],
        '/admin/create-product' => ['AdminController', 'createContent'],
        '/admin/sold-history' => ['AdminController', 'mysoldproducts'],
        '/admin/logout' => ['AdminController', 'logout'],
    ],

    'cart' => [
        '/cart' => ['CartController', 'index'],
        '/cart/add' => ['CartController', 'add'],
        '/cart/remove' => ['CartController', 'remove'],
        '/cart/get' => ['CartController', 'get'],
        '/verify-transaction' => ['VerifyTransactionController', 'index'],
    ],


    'payment' => [
        '/pay' => ['PaymentController', 'pay'],
    ],
];
