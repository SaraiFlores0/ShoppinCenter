<?php

namespace Model;

class Producto extends ActiveRecord {

    // Base DE DATOS
    protected static $tabla = 'productos';
    protected static $columnasDB = ['Id', 'NombreProducto', 'PrecioProducto', 'Descripcion', 'MarcaProducto', 'TallaProducto', 'EstadoProducto'];


    public $id;
    public $nombre;
    public $precio;
    public $imagen;
    public $descripcion;
    public $talla;
    public $marca;
    public $estado;

    // public function __construct($args = [])
    // {
    //     $this->id = $args['Id'] ?? null;
    //     $this->imagen = $args['Imagen'] ?? '';
    //     $this->nombre = $args['NombreProducto'] ?? '';
    //     $this->precio = $args['PrecioProducto'] ?? '';
    //     $this->descripcion = $args['Descripcion'] ?? '';
    //     $this->marca = $args['MarcaProducto'] ?? '';
    //     $this->talla = $args['TallaProducto'] ?? '';
    //     $this->estado = $args['EstadoProducto'] ?? '';
    // }

    public function validar() {

        if(!$this->nombre) {
            self::$errores[] = "Debes añadir un titulo";
        }

        if(!$this->precio) {
            self::$errores[] = 'El Precio es Obligatorio';
        }

        if( strlen( $this->descripcion ) < 10 ) {
            self::$errores[] = 'La descripción es obligatoria y debe tener al menos 50 caracteres';
        }

        if(!$this->talla) {
            self::$errores[] = 'El Número de habitaciones es obligatorio';
        }
        
        if(!$this->marca) {
            self::$errores[] = 'El Número de Baños es obligatorio';
        }

        if(!$this->id )  {
            $this->validarImagen();
        }
        return self::$errores;
    }

    public function validarImagen() {
        if(!$this->imagen ) {
            self::$errores[] = 'La Imagen es Obligatoria';
        }
    }

}