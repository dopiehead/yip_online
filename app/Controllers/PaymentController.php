<?php
namespace App\Controllers;

class PaymentController extends Controller {

    public function pay() {
        // simulate successful payment
        header('Location: /checkout/process?paid=true');
    }
}
