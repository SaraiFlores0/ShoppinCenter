<?php 

function conectarDB() : mysqli {
    $db = new mysqli('localhost', 'root', 'Majo1997', 'ShoppingCenter', 3306);

    if(!$db) {
        echo "Error no se pudo conectar";
        exit;
    } 

    return $db;
    
}