<?php 

function conectarDB() : mysqli {
    $db = new mysqli('localhost', 'root', '', 'ShoppingCenter', 33065);

    if(!$db) {
        echo "Error no se pudo conectar";
        exit;
    } 

    return $db;
    
}