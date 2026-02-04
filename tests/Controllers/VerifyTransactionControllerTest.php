<?php

namespace Tests\Controllers;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use PHPUnit\Framework\TestCase;
use App\Controllers\VerifyTransactionController;
use App\Services\TransactionService;

#[\PHPUnit\Framework\Attributes\AllowMockObjectsWithoutExpectations]
class VerifyTransactionControllerTest extends TestCase
{
    private $transactionServiceMock;
    private $controller;

    protected function setUp(): void
    {
        // -----------------------------
        // OPTION 1: Use a mock service
        // -----------------------------
        $this->transactionServiceMock = $this->createMock(TransactionService::class);
        $this->controller = new VerifyTransactionController($this->transactionServiceMock);

        // Reset session
        $_SESSION = [];
    }

    // -----------------------------
    // OPTION 2: Use real service
    // -----------------------------
    // If you want to test the real TransactionService, do it inside a method:
    public function testRealServiceSetup()
    {
        $transactionService = new TransactionService(); // real code
        $controller = new VerifyTransactionController($transactionService);

        $this->assertInstanceOf(VerifyTransactionController::class, $controller);
    }

    public function testMissingGetParameters()
    {
        // Clear GET parameters
        $_GET = [];

        // Capture output (because your controller echoes via Smarty)
        ob_start();
        $this->controller->index();
        $output = ob_get_clean();

        // Assert that the error message is present
        $this->assertStringContainsString('Missing payment parameters', $output);
    }
}
