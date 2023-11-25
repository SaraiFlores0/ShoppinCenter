<?php

namespace Model;


class Carrito extends ActiveRecord
{

    //** --------------------------------------------------------- */

    //** Agrega el producto al carrito */
    public function agregarProductoAlCarrito($id, $usuario, $precio, $descripcion, $imagen)
    {
        $query = "CALL `pa_productoCarrito`('$id', '$usuario', '$precio', '$descripcion', '$imagen');";

        while (self::$db->more_results()) {
            self::$db->next_result();
            if ($result = self::$db->store_result()) {
                $result->free();
            }
        }
        $resultado = self::$db->query($query);

        return $resultado;
    }

    //** --------------------------------------------------------- */

    //** Obtiene la cantidad de productos en el carrito */
    public function obtenerCantidadProductosEnCarrito($usuario)
    {
        $query = "SELECT `fun_cantidad_ProductosEnCarrito`('$usuario') as cantidad;";

        while (self::$db->more_results()) {
            self::$db->next_result();
            if ($result = self::$db->store_result()) {
                $result->free();
            }
        }

        $resultado = self::$db->query($query);

        //* Verificar si hay un error en la consulta
        if ($resultado === false) {
            
            die("Error en la consulta: " . self::$db->error);
        }

        $fila = $resultado->fetch_assoc();
        $cantidadProductos = $fila['cantidad'];

        //* Liberar el resultado
        $resultado->free();

        return $cantidadProductos;
    }

    //** --------------------------------------------------------- */

    //** Suma el total de los precios de los productos en el carrito */
    public function obtenerTotalCarrito($usuario)
    {
        $query = "SELECT `fun_totalCarrito`('$usuario') as total;";

        while (self::$db->more_results()) {
            self::$db->next_result();
            if ($result = self::$db->store_result()) {
                $result->free();
            }
        }

        $resultado = self::$db->query($query);

        //* Verificar si hay un error en la consulta
        if ($resultado === false) {
            die("Error en la consulta: " . self::$db->error);
        }

        //* Obtener la cantidad de productos directamente del resultado
        $fila = $resultado->fetch_assoc();
        $totalProductos = $fila['total'];

        //* Liberar el resultado
        $resultado->free();

        return $totalProductos;
    }


    //** --------------------------------------------------------- */

    //** Elimina el producto en el carrito */
    public function eliminarProducto($idCarrito)
    {
        $query = "CALL pa_eliminarCarrito($idCarrito)";

        while (self::$db->more_results()) {
            self::$db->next_result();
            if ($result = self::$db->store_result()) {
                $result->free();
            }
        }

        $resultado = self::$db->query($query);

        return $resultado;
    }
}