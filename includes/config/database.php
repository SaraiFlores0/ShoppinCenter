<?php 

function conectarDB() : mysqli {
    $db = new mysqli('localhost', 'root', '', 'ShoppingCenter', 3308);

    if(!$db) {
        echo "Error no se pudo conectar";
        exit;
    } 

    return $db;
    
}