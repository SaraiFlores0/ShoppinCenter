<?php
// App\Models\User.php

namespace App\Models;

class User {
    private $id;
    private $clientId;
    private $employeeId;
    private $username;
    private $email;
    private $password;
    private $userType;
    private $creationDate;
    private $status;

    public function __construct($id, $clientId, $employeeId, $username, $email, $password, $userType, $creationDate, $status) {
        $this->id = $id;
        $this->clientId = $clientId;
        $this->employeeId = $employeeId;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password; 
        $this->userType = $userType;
        $this->creationDate = $creationDate;
        $this->status = $status;
    }

    
}
