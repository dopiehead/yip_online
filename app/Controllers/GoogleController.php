<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;
use Google_Client;
use Google_Service_Oauth2;

class GoogleController extends Controller
{
    protected ?object $user = null;
    protected int $userId;

    public function googleLogin()
    {
        $client = new Google_Client();
        $client->setClientId($_ENV['GOOGLE_CLIENT_ID']);
        $client->setClientSecret($_ENV['GOOGLE_CLIENT_SECRET']);
        $client->setRedirectUri($_ENV['GOOGLE_REDIRECT_URI']);
        $client->addScope("profile");
        $client->addScope("email");

        header("Location: " . $client->createAuthUrl());
        exit();
    }

    public function googleCallback()
    {
        $client = new Google_Client();
        $client->setClientId($_ENV['GOOGLE_CLIENT_ID']);
        $client->setClientSecret($_ENV['GOOGLE_CLIENT_SECRET']);
        $client->setRedirectUri($_ENV['GOOGLE_REDIRECT_URI']);
        $client->addScope("profile");
        $client->addScope("email");

        if (!isset($_GET['code'])) {
            die('Google authentication failed.');
        }

        $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
        if (isset($token['error'])) {
            die('Token Error: ' . $token['error']);
        }

        $client->setAccessToken($token);

        $googleService = new Google_Service_Oauth2($client);
        $googleUser = $googleService->userinfo->get();

        $email = $googleUser->email;
        $name = $googleUser->name;
        $googleId = $googleUser->id;
        $avatar = $googleUser->picture;

        // ✅ Try to find the user
        $user = User::get($email);

        $user_type = 'customer' ? 'vendor' : null ;

        if (!$user) {
            $userData = [
                'name'       => $name,
                'email'      => $email,
                'user_type'  => $user_type,
                'password'   => password_hash(bin2hex(random_bytes(8)), PASSWORD_DEFAULT),
                'created_at' => date("Y-m-d H:i:s")
            ];
        
            // Create the user and return the user object
            $user = User::createGoogle($userData); 
        }
        
        // Now $user is guaranteed to exist
        $this->user = $user;
        $this->userId = $user->id;

        // Set session
        $_SESSION['user'] = [
            'id'         => $this->userId,
            'user_email' => $email,
            'user_name'  => $name,
            'user_type'  => $user_type,
            'created_at'  => date("Y-m-d H:i:s"),
            'google_id'  => $googleId,
            'avatar'     => $avatar
        ];

        session_regenerate_id(true);

        header("Location: ../public/admin/index");
        exit();
    }
}
