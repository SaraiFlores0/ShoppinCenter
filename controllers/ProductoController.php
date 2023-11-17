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
        $errores= Producto::getErrores();
        $producto = new Producto();
     
        $image=null;
    
        // Ejecutar el código después de que el usuario envía el formulario.
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtener los datos del formulario
            $productoDato = $_POST['producto'];

             // Generar un nombre único.
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
    
            
            $producto->nombre=$productoDato['nombre'];
            $producto->precio=$productoDato['precio'];
            $producto->marca=$productoDato['marca'];
            $producto->talla=$productoDato['talla'];
            $producto->estado=$productoDato['estado'];
            $producto->categorias=$productoDato['categorias'];
            $producto->descripcion=$productoDato['descripcion'];
            $producto->proveedor=$productoDato['proveedor'];
            $producto->entradas=$productoDato['entradas'];
            $producto->salidas=$productoDato['salidas'];
            $producto->devolucion=$productoDato['devolucion'];
            $producto->fecha=$productoDato['fecha'];

                // Realizar resize a la imagen con Intervention
                if ($_FILES['producto']['tmp_name']['imagen']) {
                    // Inicializar $image
                    $image = Image::make($_FILES['producto']['tmp_name']['imagen'])->fit(800, 600);
    
                    // Setear la imagen
                    $producto->setImagen($nombreImagen);
                }
    
                 // Validar los campos antes de procesar la imagen y guardar en la base de datos
            $errores = $producto->validar();
                    if(empty($errores)) {

                        // Crear la carpeta para subir imagenes
                        if(!is_dir(CARPETA_IMAGENES)) {
                            mkdir(CARPETA_IMAGENES);
                        }
        
                        // Guarda la imagen en el servidor
                        $image->save(CARPETA_IMAGENES . $nombreImagen);
        
                        // Guarda en la base de datos
                        $resultado = $producto->crear();
        
                        // if($resultado) {
                        //     header('location: /propiedades');
                        // }
                    
                    }
        }
    
        $router->render('productos/crear', [
            'errores' => $errores,
            'producto' => $producto
        ]);
    }

    
    }
