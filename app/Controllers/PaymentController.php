<?php
namespace App\Controllers;

class PaymentController {

    public function pay() {
        // simulate successful payment
        header('Location: /checkout/process?paid=true');
    }
}
