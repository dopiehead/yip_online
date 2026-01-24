<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;
use App\Services\MailService;

class AuthController extends Controller {

    public function register() {
        
        $this->render('auth/register.tpl',[
            'csrf_token' => $_SESSION['csrf']
        ]);
    }

    public function registerPost() {
        header('Content-Type: application/json');
      
    
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode([
                'status' => 'error',
                'message' => 'Invalid request method'
            ]);
            exit;
        }
    
        try {
            // CSRF check
            if (!isset($_POST['csrf']) || $_POST['csrf'] !== $_SESSION['csrf']) {
                throw new \Exception("Invalid CSRF token");
            }
    
            // Grab form data
            $name = trim($_POST['user_name'] ?? '');
            $email = trim($_POST['user_email'] ?? '');
            $password = trim($_POST['user_password'] ?? '');
            $confirm = trim($_POST['confirmPassword'] ?? '');
            $user_type = trim($_POST['user_type'] ?? 'customer'); // default to customer
    
            // Validation
            if (!$name || !$email || !$password || !$confirm || !$user_type) {
                throw new \Exception("All fields are required");
            }
    
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw new \Exception("Invalid email address");
            }
    
            if (strlen($password) < 8) {
                throw new \Exception("Password must be at least 8 characters");
            }
    
            if ($password !== $confirm) {
                throw new \Exception("Passwords do not match");
            }
    
            // Check if email exists
            if (User::findByEmail($email)) {
                throw new \Exception("Email already registered");
            }
    
            // Prepare data for User model
            $data = [
                'name' => $name,
                'email' => $email,
                'password' => $password,
                'user_type' => $user_type,
                'created_at' => date("Y-m-d H:i:s")
            ];
    
            // Create user
            User::create($data);
    
            // Success response
            echo json_encode([
                'status' => 'success',
                'message' => 'Registration successful. Redirecting to login...',
                'redirect' => 'login'
            ]);
            exit;
    
        } catch (\Throwable $e) {
            echo json_encode([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
            exit;
        }
    }
    
    

    public function login() {
        
        // For GET request, render login page
        $this->render('auth/login.tpl', [
           
            'title' => 'Login page',
            'redirectUrl' => $_SERVER['REQUEST_URI'],
            'csrf_token' => $_SESSION['csrf']
        ]);
    }

    public function loginPost(){

        header('Content-Type: application/json');
       
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                // CSRF check
                if (!isset($_POST['csrf']) || $_POST['csrf'] !== $_SESSION['csrf']) {
                    throw new \Exception("Invalid CSRF token");
                }
    
                // Get email & password
                $email = trim($_POST['user_email'] ?? '');
                $password = trim($_POST['user_password'] ?? '');
    
                if (!$email || !$password) {
                    throw new \Exception("All fields are required");
                }
    
                // Find user
                $user = User::findByEmail($email);
                if (!$user || !password_verify($password, $user['user_password'])) {
                    throw new \Exception("Invalid credentials");
                }
    
                // Login successful
                $_SESSION['user'] = $user;
    
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Login successful',
                    'redirect' => 'dashboard' // or wherever you want to redirect
                ]);
                exit;
    
            } catch (\Throwable $e) {
                echo json_encode([
                    'status' => 'error',
                    'message' => $e->getMessage()
                ]);
                exit;
            }
        }
    

    }
    
}
