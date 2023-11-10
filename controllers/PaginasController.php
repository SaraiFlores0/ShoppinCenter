<?php

namespace Controllers;
use MVC\Router;
use Model\Producto;


class PaginasController {
    public static function index( Router $router ) {

        $productos = Producto::allProductos();
       

        $router->render('paginas/index', [
            'inicio' => true,
            'productos' => $productos
        ]);
    }

    public static function nosotros( Router $router ) {
        $router->render('paginas/nosotros', [

        ]);
    }

    public static function productos( Router $router ) {

        $productos = Producto::Allproductos();

        $router->render('paginas/productos', [
            'productos' => $productos
        ]);
    }

    public static function producto(Router $router) {
        $id = validarORedireccionar('/producto');

        // Obtener los datos de la propiedad
        $producto = Producto::find($id);

        $router->render('paginas/propiedad', [
            'propiedad' => $producto
        ]);
    }

    public static function blog( Router $router ) {

        $router->render('paginas/blog');
    }

    public static function entrada( Router $router ) {
        $router->render('paginas/entrada');
    }
}