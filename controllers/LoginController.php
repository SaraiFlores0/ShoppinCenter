<?php

namespace Controllers;

use MVC\Router;
use Model\Admin;
use Model\Usuario;

class LoginController
{
    public static function loginAdmin(Router $router)
    {

        $errores = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Admin($_POST);
            $errores = $auth->validar();

            if (empty($errores)) {

                $resultado = $auth->existeUsuario();

                if ($resultado === 0) {
                    $errores = Admin::getErrores();
                } else {

                    $autenticado = $auth->comprobarPassword($resultado);

                    if ($autenticado === 0) {
                        $auth->autenticar();
                    } else {
                        $errores = Admin::getErrores();
                    }
                }
            }
        }

        $router->render('auth/loginAdmin', [
            'errores' => $errores
        ]);
    }

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


    public static function logout()
    {
        session_start();
        $_SESSION = [];
        header('Location: /');
    }
}
