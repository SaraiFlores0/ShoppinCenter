<?php

namespace App\Models;

use Intervention\Image\ImageManagerStatic as Image;

class Producto extends ActiveRecord
{

    public $id;
    public $nombre;
    public $precio;
    public $imagen;
    public $descripcion;
    public $talla;
    public $marca;
    public $estado;
    public $categorias;
    public $entradas;
    public $salidas;
    public $proveedor;
    public $devolucion;
    public $fecha;

    public $imagen_actual;

    public function __construct($args = [])
    {
        // $this->id = $args['Id'] ?? null;
        // $this->imagen = $args['Imagen'] ?? '';
        // $this->nombre = $args['NombreProducto'] ?? '';
        // $this->precio = $args['PrecioProducto'] ?? '';
        // $this->descripcion = $args['Descripcion'] ?? '';
        // $this->marca = $args['MarcaProducto'] ?? '';
        // $this->talla = $args['TallaProducto'] ?? '';
        // $this->estado = $args['EstadoProducto'] ?? '';
        // $this->categorias = $args['Categoria'] ?? '';
        // $this->proveedor = $args['Proveedor'] ?? '';
        // $this->entradas = $args['Entradas'] ?? '';
        // $this->salidas = $args['Salidas'] ?? '';
        // $this->fecha = $args['Fecha de Ingreso'] ?? date('Y-m-d');
        // $this->devolucion = $args['Devolucion'] ?? 0;
    }

    public function validar()
    {
        if (!$this->nombre) {
            self::$errores[] = "Debes añadir un nombre.";
        }

        if (!$this->precio) {
            self::$errores[] = 'El precio es obligatorio.';
        }

        if (strlen($this->descripcion) < 50) {
            self::$errores[] = 'La descripción es obligatoria y debe tener al menos 50 caracteres.';
        }

        if (!$this->talla) {
            self::$errores[] = 'La talla es obligatoria.';
        }

        if (!$this->marca) {
            self::$errores[] = 'La marca es obligatoria.';
        }

        if (!$this->categorias) {
            self::$errores[] = 'Debe seleccionar la categoría.';
        }

        if (!$this->proveedor) {
            self::$errores[] = 'Debe seleccionar el proveedor.';
        }

        if (!$this->estado) {
            self::$errores[] = 'Debe seleccionar el estado.';
        }

        if (!$this->entradas) {
            self::$errores[] = 'La cantidad de entradas es obligatorio.';
        }

        if (!$this->salidas) {
            self::$errores[] = 'La cantidad de salidas es obligatorio.';
        }


        if (!$this->imagen) {
            $this->validarImagen();
        }
        return self::$errores;
    }

    public function validarImagen()
    {
        // Validar imagen_actual solo si no hay una nueva imagen
        if (empty($this->imagen) && empty($this->imagen_actual)) {
            self::$errores[] = 'La Imagen es Obligatoria';
        }

        return self::$errores;
    }
}
