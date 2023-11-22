<?php

namespace App\Services;

use Firebase\JWT\JWT;

class AuthService {
    public function authenticate($providedUsername, $providedPassword) {

        $username = 'usuario';
        $password = 'contrasena';

        if ($providedUsername === $username && $providedPassword === $password) {
            return $this->generateToken($providedUsername);
        }

        return false;
    }

    private function generateToken($username) {
        $tokenId    = base64_encode(random_bytes(32));
        $issuedAt   = time();
        $notBefore  = $issuedAt + 1;  
        $expire     = $issuedAt + 3600; 
        $serverName = 'example.com';

        $data = [
            'iat'  => $issuedAt,         
            'jti'  => $tokenId,          
            'iss'  => $serverName,       
            'nbf'  => $notBefore,       
            'exp'  => $expire,          
            'data' => [
                'username' => $username 
            ]
        ];

        return JWT::encode($data, 'secret-key', 'HS256');
    }
}
