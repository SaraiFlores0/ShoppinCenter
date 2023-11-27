<?php

namespace Controllers;

use Model\Favoritos;
use MVC\Router;
use mysqli_result;

class FavoritosController
{
    //** Función que agrega el producto a favs. */
    public static function agregarProductoAFav(Router $router)
    {
        //* Obtener datos del POST:
        $idProducto = isset($_POST['Id_Producto']) ? $_POST['Id_Producto'] : null;
        $precioProducto = isset($_POST['Precio_Producto']) ? $_POST['Precio_Producto'] : null;
        $descripcionProducto = isset($_POST['Descripcion_Producto']) ? $_POST['Descripcion_Producto'] : null;
        $imagenProducto = isset($_POST['Imagen_Producto']) ? $_POST['Imagen_Producto'] : null;

        //** Variables: */
        $productosEnFav = '';

        //** Obtener el usuario autenticado.
        $Usuario = $_SESSION['usuario'] ?? null;

        $fav = new Favoritos();

        //* Llamar a la función para agregar el producto en favs
        $resultado = $fav->agregarProductoAFavorito($idProducto, $Usuario, $precioProducto, $descripcionProducto, $imagenProducto);

        //** Verificar si hay un error en la consulta
        if ($resultado instanceof mysqli_result) {
            //** Inicializar un array para almacenar los productos
            $productosEnFav = [];

            //** Recorrer las filas del resultado
            while ($fila = $resultado->fetch_assoc()) {
                //* Agregar cada fila al array de productos
                $productosEnFav[] = $fila;
            }
        }

        //** Mostrar a la vista */
        $router->render('favoritos/favoritos', [
            'fav' => $productosEnFav,
        ]);
    }

    //** --------------------------------------------------------- */

    //** Función que obtiene la cantidad de productos en el favs. */
    public static function obtenerCantidadEnFav()
    {
        session_start();
        $Usuario = $_SESSION['usuario'] ?? '';

        $fav = new Favoritos();
        $cantidadProductosEnFav = $fav->obtenerCantidadProductosEnFavs($Usuario);

        //* Devolver la cantidad como respuesta JSON
        header('Content-Type: application/json');
        echo json_encode(['cantidad' => $cantidadProductosEnFav]);
        exit;
    }
    
     //** Función que elimina el producto en el carrito. */
     public static function eliminarProducto()
     {
         if ($_SERVER['REQUEST_METHOD'] === 'GET') {
             $idFav = $_GET['id_fav'] ?? null;
 
             //* Valida que el ID del carrito no sea nulo
             if ($idFav) {
                 $favs = new Favoritos();
                 $resultado = $favs->eliminarProducto($idFav);
 
                 //* Redirige a la página del carrito después de la eliminación
                 header('Location: /fav/agregar');
                 exit;
             }
         }
     }

 }
