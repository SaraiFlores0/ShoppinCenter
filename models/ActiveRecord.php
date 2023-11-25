<?php

namespace Model;

class ActiveRecord
{

    //** Base De Datos.  */
    protected static $db;

    public $imagen = '';

    //** Errores. */ 
    protected static $errores = [];

    //** Definir la conexión a la BD */ 
    public static function setDB($database)
    {
        self::$db = $database;
    }

    //** Validación. */
    public static function getErrores()
    {
        return static::$errores;
    }

    public function validar()
    {
        static::$errores = [];
        return static::$errores;
    }

    //** --------------------------------------------------------- */

    //** Muestra todos los productos. */
    public static function Allproductos()
    {
        $query = "CALL pa_vistaProductos();";

        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    //** --------------------------------------------------------- */

    //** Busca un producto por su id. */
    public static function find($id)
    {
        $query = "CALL pa_Producto($id);";

        $resultado = self::consultarSQL($query);

        if ($resultado && count($resultado) > 0) {
            return $resultado[0]; //* Devuelve el primer elemento del array
        } else {
            return null;
        }
    }

    //** --------------------------------------------------------- */

    public static function consultarSQL($query)
    {
        //* Consultar la base de datos
        $resultado = self::$db->query($query);
        //* Iterar los resultados
        $array = [];
        while ($registro = $resultado->fetch_assoc()) {
            $array[] = static::crearObjeto($registro);
        }

        //* liberar la memoria
        $resultado->free();

        //* retornar los resultados
        return $array;
    }

    //** --------------------------------------------------------- */

    protected static function crearObjeto($registro)
    {
        $producto = new Producto;

        $producto->id = $registro['Id'];
        $producto->imagen = $registro['Imagen'];
        $producto->nombre = $registro['NombreProducto'];
        $producto->precio = $registro['PrecioProducto'];
        $producto->descripcion = $registro['Descripcion'];
        $producto->marca = $registro['MarcaProducto'];
        $producto->talla = $registro['TallaProducto'];
        $producto->estado = $registro['EstadoProducto'];
        $producto->categorias = $registro['Categoria'];
        $producto->proveedor = $registro['Proveedor'];
        $producto->entradas = $registro['Entradas'];
        $producto->salidas = $registro['Salidas'];
        $producto->fecha = $registro['Fecha de Ingreso'];
        $producto->devolucion = $registro['Devolucion'];

        return $producto;
    }

    //** --------------------------------------------------------- */

    public function setImagen($imagen)
    {
        //* Si la imagen actual no es nula, borrar la imagen
        if (!is_null($this->imagen)) {
            $this->borrarImagen();
        }

        //* Asignar al atributo de imagen el nombre de la nueva imagen
        $this->imagen = $imagen;
    }

    //** Elimina la imagen. */ 
    public function borrarImagen()
    {
        $producto = new Producto;
        //* Comprobar si existe el archivo
        $rutaImagen = CARPETA_IMAGENES . $producto->imagen;
        if (is_file($rutaImagen)) {
            if (unlink($rutaImagen)) {
                echo 'Archivo de imagen eliminado correctamente';
            } else {
                echo 'Error al eliminar el archivo de imagen';
            }
        }
    }

    //** --------------------------------------------------------- */

    public function sincronizar($args = [])
    {
        foreach ($args as $key => $value) {
            if (property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }
}
