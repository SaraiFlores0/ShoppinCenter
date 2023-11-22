<?php

namespace App\Http\Middleware;

class AuthenticationMiddleware {
    public function checkAuthentication($allowedRoles = []) {
        session_start();

        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit();
        }

        $userRole = $_SESSION['role'];

        if (!in_array($userRole, $allowedRoles)) {
            header('Location: /'); 
            exit();
        }
    }
}
