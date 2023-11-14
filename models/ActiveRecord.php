<?php

namespace Model;

class ActiveRecord
{

    //**  */ Base DE DATOS
    protected static $db;
    protected static $tabla = '';
    protected static $columnasDB = [];

    // Propiedades
    public $id;
    public $imagen;

    // Errores
    protected static $errores = [];


    // Definir la conexión a la BD
    public static function setDB($database)
    {
        self::$db = $database;
    }

    // Validación
    public static function getErrores()
    {
        return static::$errores;
    }

    public function validar()
    {
        static::$errores = [];
        return static::$errores;
    }

    public static function Allproductos()
    {
        $query = "CALL pa_vistaProductos();";

        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    // Busca un registro por su id
    public static function find($id)
    {
        $query = "CALL pa_Producto($id);";

        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    public static function get($limite)
    {
    }

    // crea un nuevo registro
    public function crear()
    {
        $producto = new Producto();
        // Usar sentencia preparada para el procedimiento almacenado
        $query = "CALL pa_insertProductos(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, @resultado)";

        // Preparar la consulta
        $stmt = self::$db->prepare($query);
        
        // Verificar si la preparación fue exitosa
        if ($stmt) {
            // Vincular parámetros
            $stmt->bind_param(
                "sssssssssssss",
                $producto->nombre,
                $producto->precio,
                $producto->marca,
                $producto->talla,
                $producto->estado,
                $producto->categorias,
                $producto->imagen,
                $producto->descripcion,
                $producto->proveedor,
                $producto->entradas,
                $producto->salidas,
                $producto->devolucion,
                $producto->fecha
            );
        
            // Ejecutar la consulta preparada
            $stmt->execute();
            var_dump($stmt);
    
        } else {
            // Manejar el error de preparación
            self::$errores[] = 'Error en la BD: ' . self::$db->error;
            return false;
        }
    }

    public static function consultarSQL($query)
    {
        // Consultar la base de datos
        $resultado = self::$db->query($query);
        // Iterar los resultados
        $array = [];
        while ($registro = $resultado->fetch_assoc()) {
            $array[] = static::crearObjeto($registro);
        }

        // liberar la memoria
        $resultado->free();

        // retornar los resultados
        return $array;
    }

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

    // Subida de archivos
    public function setImagen($imagen)
    {

        if( !is_null($this->id) ) {
            $this->borrarImagen();
        }
        // Asignar al atributo de imagen el nombre de la imagen
        if($imagen) {
            $this->imagen = $imagen;
        }
    }

    // Elimina el archivo
    public function borrarImagen()
    {
        // Comprobar si existe el archivo
        $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
        if ($existeArchivo) {
            unlink(CARPETA_IMAGENES . $this->imagen);
        }
    }
}
