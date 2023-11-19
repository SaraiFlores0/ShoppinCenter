<?php

namespace Model;

class ActiveRecord
{

    //** Base De Datos.  */
    protected static $db;

    //** Propiedades. */ 
    public $id;
    public $imagen;

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

        return $resultado;
    }

    //** --------------------------------------------------------- */

    public static function get($limite)
    {
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

    //** Subida de imagen. */ 
    public function setImagen($imagen)
    {
        if (!is_null($this->id)) {
            $this->borrarImagen();
        }
        //** Asignar al atributo de imagen el nombre de la imagen */ 
        if ($imagen) {
            $this->imagen = $imagen;
        }
    }

    //** Elimina la imagen. */ 
    public function borrarImagen()
    {
        // Comprobar si existe el archivo
        $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
        if ($existeArchivo) {
            unlink(CARPETA_IMAGENES . $this->imagen);
        }
    }
}
