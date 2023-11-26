<?php

namespace Controllers;

use MVC\Router;
use Model\Producto;


class PaginasController
{
    public static function index(Router $router)
    {

        $productos = Producto::allProductos();


        $router->render('paginas/index', [
            'inicio' => true,
            'productos' => $productos
        ]);
    }

    public static function productos(Router $router)
    {

        $productos = Producto::Allproductos();

        $router->render('paginas/productos', [
            'productos' => $productos
        ]);
    }

    public static function producto(Router $router)
    {
        $id = validarORedireccionar('/producto');

        // Obtener los datos del producto
        $producto = Producto::find($id);

        $router->render('paginas/producto', [
            'producto' => $producto
        ]);
    }
   
    public static function productosPremiumD(Router $router) {
        $categoria = 1;
      
        $productos = Producto::productoCategoria($categoria);
        
        $router->render('paginas/productos', [
          'productos' => $productos
        ]);
      }
      public static function productosPremiumC(Router $router) {
        $categoria = 3;
      
        $productos = Producto::productoCategoria($categoria);
        
        $router->render('paginas/productos', [
          'productos' => $productos
        ]);
      }
      public static function productosSuPremiumD(Router $router) {
        $categoria = 2;
      
        $productos = Producto::productoCategoria($categoria);
        
        $router->render('paginas/productos', [
          'productos' => $productos
        ]);
      }
      public static function productosSuPremiumC(Router $router) {
        $categoria = 4;
      
        $productos = Producto::productoCategoria($categoria);
        
        $router->render('paginas/productos', [
          'productos' => $productos
        ]);
      }
      
    
}

    
