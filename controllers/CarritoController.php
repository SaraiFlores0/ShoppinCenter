<?php

namespace Controllers;

use Model\Carrito;
use MVC\Router;
use mysqli_result;

class CarritoController
{


    //** --------------------------------------------------------- */

    //** Función que agrega el producto al carrito. */
    public static function agregarProductoAlCarrito(Router $router)
    {
        //* Obtener datos del POST:
        $idProducto = isset($_POST['Id_Producto']) ? $_POST['Id_Producto'] : null;
        $precioProducto = isset($_POST['Precio_Producto']) ? $_POST['Precio_Producto'] : null;
        $descripcionProducto = isset($_POST['Descripcion_Producto']) ? $_POST['Descripcion_Producto'] : null;
        $imagenProducto = isset($_POST['Imagen_Producto']) ? $_POST['Imagen_Producto'] : null;

        //** Variables: */
        $productosEnCarrito = '';

        //** Obtener el usuario autenticado.
        $Usuario = $_SESSION['usuario'] ?? null;

        $carrito = new Carrito();

        //* Llamar a la función para agregar el producto al carrito
        $resultado = $carrito->agregarProductoAlCarrito($idProducto, $Usuario, $precioProducto, $descripcionProducto, $imagenProducto);

        //** Verificar si hay un error en la consulta
        if ($resultado instanceof mysqli_result) {
            //** Inicializar un array para almacenar los productos
            $productosEnCarrito = [];

            //** Recorrer las filas del resultado
            while ($fila = $resultado->fetch_assoc()) {
                //* Agregar cada fila al array de productos
                $productosEnCarrito[] = $fila;
            }
        }

        //** Mostrar a la vista */
        $router->render('carrito/carrito', [
            'carrito' => $productosEnCarrito,
        ]);
    }

    //** --------------------------------------------------------- */

    //** Función que obtiene la cantidad de productos en el carrito. */
    public static function obtenerCantidadEnCarrito()
    {
        session_start();
        $Usuario = $_SESSION['usuario'] ?? '';

        $carrito = new Carrito();
        $cantidadProductosEnCarrito = $carrito->obtenerCantidadProductosEnCarrito($Usuario);

        //* Devolver la cantidad como respuesta JSON
        header('Content-Type: application/json');
        echo json_encode(['cantidad' => $cantidadProductosEnCarrito]);
        exit;
    }

    //** --------------------------------------------------------- */

    //** Función que obtiene la suma total de productos en el carrito. */
    public static function sumarTotal(Router $router)
    {

        $carrito = new Carrito();
        $errores = $carrito->validar();

        session_start();
        $Usuario = $_SESSION['usuario'] ?? '';

        if (empty($errores)) {
            $totalCarrito = $carrito->obtenerTotalCarrito($Usuario);
        }

        //** Mostrar a la vista. */    
        $router->render('carrito/carrito', [
            'carrito' => $totalCarrito,
            'errores' => $errores
        ]);
    }

    //** --------------------------------------------------------- */

    //** Función que elimina el producto en el carrito. */
    public static function eliminarProducto()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $idCarrito = $_GET['id_carrito'] ?? null;

            //* Valida que el ID del carrito no sea nulo
            if ($idCarrito) {
                $carrito = new Carrito();
                $resultado = $carrito->eliminarProducto($idCarrito);

                //* Redirige a la página del carrito después de la eliminación
                header('Location: /carrito/agregar');
                exit;
            }
        }
    }


     //** CHECKOUT */
     public static function comprar(Router $router)
    {
        //** ORDENAR PEDIDO CONFIRMAR */
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $router->render('carrito/success', [
               
                
            ]);
        }


        //** Obtener el usuario autenticado.
        $Usuario = $_SESSION['usuario'] ?? null;

        $carrito = new Carrito();
        $errores = $carrito->validar();

        // Obtener los datos del producto
        $producto = Carrito::find($_SESSION['nombreUsuario']);

        if (empty($errores)) {
            $totalCarrito = $carrito->obtenerTotalCarrito($Usuario);
            $carritoProductos = $carrito->obtenerProductodeCarrito($Usuario);
        }

        //** Mostrar a la vista. */    
        $router->render('carrito/checkout', [
            'totalCarrito' => $totalCarrito,
            'carrito' => $carritoProductos,
            'errores' => $errores,

            'producto' => $producto
        ]);
    }



     public static function producto(Router $router)
     {
         $id = validarORedireccionar('/producto');
 
         // Obtener los datos del producto
         $producto = Carrito::find($id);
 
         $router->render('paginas/producto', [
             'producto' => $producto
         ]);
     }

      //** --------------------------------------------------------- */

    
    public static function confirmarPedido(Router $router)
    {
       

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $router->render('paginas/index', [
               

            ]);
        }

       
    }

 
     //** --------------------------------------------------------- */
}
