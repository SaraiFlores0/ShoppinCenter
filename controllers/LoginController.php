<?php

namespace Controllers;

use MVC\Router;
use Model\Admin;
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
    }

}
