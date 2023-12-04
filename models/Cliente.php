<?php

namespace Model;

class Cliente extends ActiveRecord
{

    //** Propiedades. */
    public $id;
    public $nombres;
    public $correo;
    public $telefono;
    public $apellidos;
    public $fechaNacimiento;
    public $sexo;
    public $dui;
    public $direccion;
    public $departamento;
    public $municipio;
    public $contraseña;
    //** Propiedades */
    public function __construct($args = [])
    {
        $this->id = $args['Id'] ?? null;
        $this->nombres = $args['Nombres'] ?? null;
        $this->apellidos = $args['Apellidos'] ?? null;
        $this->dui = $args['DUI'] ?? null;
        $this->direccion = $args['Direccion'] ?? null;
        $this->departamento = $args['Departamento'] ?? null;
        $this->municipio = $args['Municipio'] ?? null;
        $this->telefono = $args['Telefono'] ?? null;
        $this->fechaNacimiento = $args['Fecha_Nacimiento'] ?? null;
        $this->sexo = $args['Sexo'] ?? null;
        $this->correo = $args['Correo'] ?? null;
        $this->contraseña = $args['Contraseña'] ?? null;
    }
    
    public function datosCompra($usuario, $idProducto,  $precioProducto)
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

    public function stockProducto($usuario)
    {

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
            $query2 = "CALL pa_compraCliente($idUsuario);";

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
    public function registrarUsuario($datosUsuario)
    {
        $query = "CALL RegistrarUsuario(
            '$this->nombres',
            '$this->apellidos',
            '$this->dui',
            '$this->direccion',
            '$this->departamento',
            '$this->municipio',
            '$this->telefono',
            '$this->fechaNacimiento',
            '$this->sexo',
            '$this->correo',
            '$this->contraseña');";
            $resultado = self::$db->query($query);
    
            $resultado = self::$db->query("SELECT @respuesta AS respuesta");
            $resultado = $resultado->fetch_assoc()['respuesta'];
    
            if ($resultado === 0) {
                self::$errores[] = 'Error al registrarse ';
                return self::$errores;
            } else {
                return $resultado;
            }
    }

    public function obtenerDepartamentos()
    {
        $query = "SELECT ID_Departamento, Nombre_Departamento FROM departamentos";
        $resultado = self::$db->query($query);

        if ($resultado === false) {
            self::$errores[] = 'Error al obtener los departamentos.';
            return [];
        }

        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

    public function obtenerMunicipiosPorDepartamento($departamentoId)
    {
        $query = "SELECT ID_Municipio, Nombre_Municipio FROM municipios WHERE ID_Departamento = ?";
        $stmt = self::$db->prepare($query);

        if ($stmt === false) {
            self::$errores[] = 'Error al preparar la consulta de municipios.';
            return [];
        }

        $stmt->bind_param("i", $departamentoId);
        $stmt->execute();

        $resultado = $stmt->get_result();

        if ($resultado === false) {
            self::$errores[] = 'Error al obtener los municipios.';
            return [];
        }

        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

  
}
