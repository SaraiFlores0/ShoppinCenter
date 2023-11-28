<?php

namespace Model;


class Favoritos extends ActiveRecord
{

    //** Agrega el producto a fav */
    public function agregarProductoAFavorito($id, $usuario, $precio, $descripcion, $imagen)
    {
        $query = "CALL `pa_productoFav`('$id', '$usuario', '$precio', '$descripcion', '$imagen');";

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

    //** Obtiene la cantidad de productos en fav */
    public function obtenerCantidadProductosEnFavs($usuario)
    {
        $query = "SELECT `fun_cantidadProductosFav`('$usuario') as cantidad;";

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

    //** Elimina el producto de favs */
    public function eliminarProducto($idFav)
    {
        $query = "CALL pa_eliminarFav($idFav)";

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
