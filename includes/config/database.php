<?php 

function conectarDB() : mysqli {
    $db = new mysqli('localhost', 'root', '', 'shopping_center', 3308);

    if(!$db) {
        echo "Error no se pudo conectar";
        exit;
    } 

    return $db;
    
}