<?php
namespace App\Controllers\Api;

use App\Models\Product;

class ProductApiController {
    public function index() {
        header('Content-Type: application/json');
        echo json_encode(Product::all());
    }
}
