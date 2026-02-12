<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;
use Google_Client;
use Google_Service_Oauth2;

class GoogleController extends Controller
{
    protected object $user;
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
        $user = User::find($email);

        if (!$user) {

            $userData = [
                'name'       => $name,
                'email'      => $email,
                'user_type'  => 'customer',
                'password'   => password_hash(bin2hex(random_bytes(8)), PASSWORD_DEFAULT),
                'created_at' => date("Y-m-d H:i:s")
            ];

            // Immediately fetch user by email to get object and id
            $user = User::get($email);
            if (!$user) {

                $created = User::create($userData);
                
            }
        }

        $this->user = $user;
        $this->userId = $user->id;

        // Set session
        $_SESSION['user'] = [
            'id'         => $this->userId,
            'user_email' => $email,
            'user_name'  => $name,
            'user_type'  => 'customer',
            'created_at'  => date("Y-m-d H:i:s"),
            'google_id'  => $googleId,
            'avatar'     => $avatar
        ];

        header("Location: ../public/admin/index");
        exit();
    }
}
