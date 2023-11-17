<?php

namespace Model;

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

    //public $imagen_actual;

    public function __construct($args = [])
    {
        $this->id = $args['Id'] ?? null;
        $this->imagen = $args['imagen'] ?? '';
        $this->nombre = $args['nombre'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->marca = $args['marca'] ?? '';
        $this->talla = $args['talla'] ?? '';
        $this->estado = $args['estado'] ?? '';
        $this->categorias = $args['categoria'] ?? '';
        $this->proveedor = $args['proveedor'] ?? '';
        $this->entradas = $args['entradas'] ?? '';
        $this->salidas = $args['salidas'] ?? 0;
        $this->fecha = $args['fecha'] ?? date('Y-m-d');
        $this->devolucion = $args['devolucion'] ?? 0;
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

        if ($this->salidas === '' || $this->salidas < 0) {
            self::$errores[] = 'La cantidad de salidas es obligatorio.';
        }

        if($this->salidas>$this->entradas){
            self::$errores[] = 'La cantidad de salidas no puede ser mayor a la cantidad de entradas.';
        }

        
        if($this->devolucion>$this->entradas || $this->devolucion>$this->salidas && $this->devolucion!==$this->salidas){
            self::$errores[] = 'La cantidad de devoluciones no puede ser mayor a la cantidad de entradas ni de salidas.';
        }

        if (!$this->imagen) {
            $this->validarImagen();
        }
        return self::$errores;
    }

    public function validarImagen()
    {
        // Validar imagen_actual solo si no hay una nueva imagen
        if (empty($this->imagen)) {
            self::$errores[] = 'La Imagen es Obligatoria';
        }

    }

      // crea un nuevo registro
    public function crear()
    {
        $query = "CALL pa_insertProductos(
        '$this->nombre',
        '$this->precio',
        '$this->marca',
        '$this->talla',
        '$this->estado',
        '$this->categorias',
        '$this->imagen',
        '$this->descripcion',
        '$this->proveedor',
        '$this->entradas',
        '$this->salidas',
        '$this->devolucion',
        '$this->fecha',
        @respuesta);";
        $resultadoProductos = self::$db->query($query);
        // Obtén la salida del procedimiento almacenado
        return $resultadoProductos;

        $resultado = self::$db->query("SELECT @respuesta AS respuesta");
        $respuesta = $resultado->fetch_assoc()['respuesta'];

        if($respuesta===0){
        self::$errores[] = 'Error al crear el producto. ';
        return self::$errores;
        }
        else{
        return $respuesta;
        }
        
    }

}
