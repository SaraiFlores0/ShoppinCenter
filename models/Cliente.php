<?php

namespace Model;

class Cliente extends ActiveRecord
{

    //** Propiedades. */
    public $id;
    public $nombres;
    public $correo;
    public $telefono;
    public $dui;
    public $direccion;
    public $departamento;
    public $municipio;

    public function datosCompra($usuario, $idProducto,  $precioProducto )
    {
    
            //* Llamar al procedimiento almacenado para insertar compra
            $sql = "CALL pa_insertarCompra('$usuario', $idProducto, '$this->direccion', '$this->municipio', '$this->departamento', $precioProducto)";

            while (self::$db->more_results()) {
                self::$db->next_result();
                if ($result = self::$db->store_result()) {
                    $result->free();
                }
            
            mysqli_query(self::$db, $sql);
        }
    }
    
    public function stockProducto($usuario){

        $query = "SELECT fun_IdUsuario('$usuario') AS idUsuario";

        while (self::$db->more_results()) {
            self::$db->next_result();
            if ($result = self::$db->store_result()) {
                $result->free();
            }
        }

        $resultado = self::$db->query($query);
        $row = $resultado->fetch_assoc();
        $idUsuario = $row['idUsuario'];

        if ($idUsuario !== null) {
            $query2= "CALL pa_compraCliente($idUsuario);";

            while (self::$db->more_results()) {
                self::$db->next_result();
                if ($result = self::$db->store_result()) {
                    $result->free();
                }
            }

            $resultado = self::$db->query($query2);
        } else {
            echo "No se encontró el usuario o no tiene carrito.";
        }

    }
}
