<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Confirmation</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/navbar.css">
    <link rel="stylesheet" href="../assets/css/verify-transaction.css">
       
</head>
<body>

    {include file="navbar.tpl"}

    <div class="container-fluid checkmark-container d-flex justify-c9ontent-center align-items-center">
        <div class="card shadow bg-white p-4 w-100" style="max-width: 500px;">
            <div class="text-center mb-3">
                <div class="border border-success border-3 rounded-circle text-success checkmark-circle mx-auto">
                    <i class="fa fa-check"></i>
                </div>
                <h5 class="mt-3 text-success">Payment Successful</h5>
            </div>

            <div class="mb-2 d-flex justify-content-between">
                <span>Transaction Reference:</span>
                <span class="fw-bold">{$txn_ref}</span>
            </div>

            <div class="mb-2 d-flex justify-content-between">
                <span>Client Name:</span>
                <span class="fw-bold text-capitalize">{$userName}</span>
            </div>

            <div class="mt-4 text-secondary small">
                Your payment has been processed successfully. Your order is confirmed and being prepared.
            </div>

            <div class="text-center mt-3">
                <a href="../protected/dashboard.php" class="btn btn-outline-secondary btn-sm">
                    <i class="fas fa-arrow-left me-1"></i> Back to Dashboard
                </a>
            </div>
        </div>
    </div>

    <!-- jQuery & Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
