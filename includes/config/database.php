<?php 

function conectarDB() : mysqli {
    $db = new mysqli('localhost', 'root', '', 'shoppingx2', 3308);

    if(!$db) {
        echo "Error no se pudo conectar";
        exit;
    } 

    return $db;
    
}