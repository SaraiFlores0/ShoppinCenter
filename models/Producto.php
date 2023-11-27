<?php

namespace Model;

class Producto extends ActiveRecord
{

    //** Propiedades. */
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

    //** Constructor. */
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

    //** --------------------------------------------------------- */

    //** Validación. */
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

        if ($this->salidas > $this->entradas) {
            self::$errores[] = 'La cantidad de salidas no puede ser mayor a la cantidad de entradas.';
        }


        if ($this->devolucion > $this->entradas || $this->devolucion > $this->salidas && $this->devolucion !== $this->salidas) {
            self::$errores[] = 'La cantidad de devoluciones no puede ser mayor a la cantidad de entradas ni de salidas.';
        }

        if (!$this->imagen) {
            $this->validarImagen();
        }
        return self::$errores;
    }

    //** --------------------------------------------------------- */


    public function validarImagen()
    {
        //* Validar imagen.
        if (empty($this->imagen)) {
            self::$errores[] = 'La Imagen es Obligatoria';
        }
    }

    //** --------------------------------------------------------- */

    //** Crear un producto con PA. */
    public function crear()
    {
        $query = "CALL pa_insertProducto(
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
        $resultado = self::$db->query($query);

        $resultado = self::$db->query("SELECT @respuesta AS respuesta");
        $resultado = $resultado->fetch_assoc()['respuesta'];

        if ($resultado === 0) {
            self::$errores[] = 'Error al crear el producto. ';
            return self::$errores;
        } else {
            return $resultado;
        }
    }

    //** --------------------------------------------------------- */

    //** Actualiza un producto con PA. */
    public function actualizar()
    {
        $query = "CALL pa_updateProducto(
        '$this->id',
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
        //* Liberar los resultados para evitar el error "Commands out of sync"
        while (self::$db->more_results()) {
            self::$db->next_result();
            if ($result = self::$db->store_result()) {
                $result->free();
            }
        }

        $resultado = self::$db->query($query);

        $resultado = self::$db->query("SELECT @respuesta AS respuesta");
        $resultado = $resultado->fetch_assoc()['respuesta'];

        if ($resultado === 0) {
            self::$errores[] = 'Error al actualizar el producto. ';
            return self::$errores;
        } else {
            return 2;
        }
    }

    //** --------------------------------------------------------- */

    //** Elimina un producto con una función. */
    public function eliminar()
    {
        $query = "SELECT fun_borrarProducto('$this->id');";

        //** Liberar los resultados para evitar el error "Commands out of sync".
        while (self::$db->more_results()) {
            self::$db->next_result();
            if ($result = self::$db->store_result()) {
                $result->free();
            }
        }

        $resultado = self::$db->query($query);

        if ($resultado === 0) {
            self::$errores[] = 'Error al eliminar el producto. ';
            return self::$errores;
        } else {
            return $resultado;
        }
    }
    
    }