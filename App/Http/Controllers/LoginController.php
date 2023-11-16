<?php
// App\Http\Controllers\LoginController.php

namespace App\Http\Controllers;

use App\Services\AuthService;

class LoginController {
    private $authService;

    public function __construct() {
        $this->authService = new AuthService();
    }

    public function showLoginForm() {
        include 'views/login.php';
    }

    public function authenticate() {
        $providedUsername = $_POST['username'];
        $providedPassword = $_POST['password'];

        $userType = $this->authService->authenticate($providedUsername, $providedPassword);

        if ($userType) {
            switch ($userType) {
                case 'cliente':
                    header('Location: /dashboard-cliente');
                    break;
                case 'admin':
                    header('Location: /dashboard-admin');
                    break;
                default:
                    header('Location: /dashboard');
            }

            exit();
        } else {
            $error = "Credenciales incorrectas";
            include 'views/login.php';
        }
    }
}
