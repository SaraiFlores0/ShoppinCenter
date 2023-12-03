<?php

namespace Controllers;

use MVC\Router;
use Model\Admin;
use Model\Cliente;
use Model\Usuario;

class LoginController
{

    //** Login del Admin */
    public static function loginAdmin(Router $router)
    {
        $errores = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Admin($_POST);
            $errores = $auth->validar();

            if (empty($errores)) {

                $resultado = $auth->existeUsuario();

                if (!$resultado) {
                    $errores = Usuario::getErrores();
                } else {
                    $auth->autenticar();
                }
            }
        }

        $router->render('auth/loginAdmin', [
            'errores' => $errores
        ]);
    }

    //** --------------------------------------------------------- */

    //** Login del usuario */
    public static function loginUsuario(Router $router)
    {
        $errores = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Usuario($_POST);
            $errores = $auth->validar();

            if (empty($errores)) {

                $resultado = $auth->existeUsuario();

                if (!$resultado) {
                    $errores = Usuario::getErrores();
                } else {
                    $auth->autenticar();
                }
            }
        }

        $router->render('auth/loginUsuario', [
            'errores' => $errores
        ]);
    }

    //** --------------------------------------------------------- */

    //** Logout */
    public static function logout()
    {
        session_start();
        $_SESSION = [];
        header('Location: /');
    }public static function RegistrarUsuario(Router $router)
    {
        $errores = [];
        $cliente = new Cliente();
        $departamentos = $cliente->obtenerDepartamentos();
        $municipios =$cliente-> obtenerMunicipiosPorDepartamento(1);
        $mensajeExito = null;
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(isset($_POST['nombres'], $_POST['apellidos'])) {
                $cliente->nombres = $_POST['nombres'] ?? null;
                $cliente->apellidos = $_POST['apellidos'] ?? null;
                $cliente->dui = $_POST['dui'] ?? null;
                $cliente->direccion = $_POST['direccion'] ?? null;
                $cliente->departamento = $_POST['departamento'] ?? null;
                $cliente->municipio = $_POST['municipio'] ?? null;
                $cliente->telefono = $_POST['telefono'] ?? null;
                $cliente->fechaNacimiento = $_POST['fecha_nacimiento'] ?? null;
                $cliente->sexo = $_POST['sexo'] ?? null;
                $cliente->correo = $_POST['correo'] ?? null;
                $cliente->contraseña = $_POST['password'] ?? null;
    
                $resultadoRegistro = $cliente->registrarUsuario([
                    'nombres' => $cliente->nombres,
                    'apellidos' => $cliente->apellidos,
                    'dui' => $cliente->dui,
                    'direccion' => $cliente->direccion,
                    'departamento' => $cliente->departamento,
                    'municipio' => $cliente->municipio,
                    'telefono' => $cliente->telefono,
                    'fechaNacimiento' => $cliente->fechaNacimiento,
                    'sexo' => $cliente->sexo,
                    'correo' => $cliente->correo,
                    'contraseña' => $cliente->contraseña,
                ]);
    var_dump( $resultadoRegistro );
                if (is_array($resultadoRegistro)) {
                    $errores = '¡Error de Registro!';
                } else {
                    $mensajeExito = '¡Usuario registrado con éxito!';
                }
            }
        }
    
        $router->render('auth/registroUsuario', [
            'errores' => $errores,
            'departamentos' => $departamentos,
            'municipios' => $municipios,
            'mensajeExito' => $mensajeExito,
        ]);
    }
    
    
    
    
    
}
