<?php

namespace Model;

class Admin extends ActiveRecord
{

    //** Propiedades */
    public $usuario;
    public $password;

    //** Constructor */ 
    public function __construct($args = [])
    {
        $this->usuario = $args['usuario'] ?? null;
        $this->password = $args['password'] ?? null;
    }

    //** --------------------------------------------------------- */

    //** Validando los campos del formulario. */ 
    public function validar()
    {
        if (!$this->usuario) {
            self::$errores[] = "El Usuario es obligatorio";
        }
        if (!$this->password) {
            self::$errores[] = "El Password del usuario es obligatorio";
        }
        return self::$errores;
    }

    //** --------------------------------------------------------- */

    //** Verificando si el usuario exite. */
    public function existeUsuario()
    {
        //** Revisar si el usuario existe.
        $query = "SELECT fun_usuarioAdmin('$this->usuario', '$this->password') as usuarioExiste";
        $resultado = self::$db->query($query);

        if ($resultado === false) {
            self::$errores[] = 'Error al ejecutar la consulta.';
            return;
        }

        $usuarioExiste = $resultado->fetch_assoc()['usuarioExiste'];

        if ($usuarioExiste == 0) {
            self::$errores[] = 'Usuario o contraseña incorrectos.';
            return;
        }
        return $resultado;
    }

    //** --------------------------------------------------------- */

    //** Autenticar al usuario. */
    public function autenticar()
    {
        session_start();

        //** Llenar el arreglo de la sesión */
        $_SESSION['usuario'] = $this->usuario;
        $_SESSION['loginAdmin'] = true;

        //* Obtener el nombre del usuario y almacenarlo en la sesión */
        $query = "SELECT fun_nombreAdmin('$this->usuario') as nombreUsuario;";
        $resultado = self::$db->query($query);

        if ($resultado !== false) {
            $nombreUsuario = $resultado->fetch_assoc()['nombreUsuario'];
            $_SESSION['nombreUsuario'] = $nombreUsuario;
        }

        //** Redirigir a la página admin.
        header('Location: /admin');
    }
}
