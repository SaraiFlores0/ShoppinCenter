<?php

namespace Controllers;

use MVC\Router;
use Model\Producto;
use Intervention\Image\ImageManagerStatic as Image;

class ProductoController
{

    //** Función que muestra todos los productos. */
    public static function index(Router $router)
    {
        $productos = Producto::Allproductos();

        //** Muestra mensaje condicional. */ 
        $resultado = $_GET['resultado'] ?? null;

        //** Muanda los productos a la vista. */
        $router->render('productos/index', [
            'productos' => $productos,
            'resultado' => $resultado
        ]);
    }

    //** --------------------------------------------------------- */
    public static function crear(Router $router)
    {
        $errores = Producto::getErrores();
        $producto = new Producto;
    
        // Inicializar $image aquí para evitar la advertencia
        $image = null;
    
        // Ejecutar el código después de que el usuario envía el formulario.
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Crea una nueva instancia
            $producto = new Producto($_POST['producto']);
           
            var_dump($_POST);
    
            // Generar un nombre único.
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
    
            // Setear la imagen
            // Realiza un resize a la imagen con Intervention
            if ($_FILES['producto']['tmp_name']['imagen']) {
                // Inicializar $image
                $image = Image::make($_FILES['producto']['tmp_name']['imagen'])->fit(800, 600);
                $producto->setImagen($nombreImagen);
    
                // Validar
                //$errores = $producto->validar();
                if (empty($errores)) {
                    // Crear la carpeta para subir imágenes
                    if (!is_dir(CARPETA_IMAGENES)) {
                        mkdir(CARPETA_IMAGENES);
                    }
    
                    // Guarda la imagen en el servidor si $image está definida
                    $image->save(CARPETA_IMAGENES . $nombreImagen);
    
                    // Guarda en la base de datos
                    $resultado = $producto->crear();
    
                    if ($resultado) {
                        header('location: /productos');
                    }
                }
            }
        }
    
        $router->render('productos/crear', [
            'errores' => $errores,
            'producto' => $producto,
            'image' => $image // Pasar $image a la vista
        ]);
    }
}
