<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Router;

class PaginasController {
    public static function index(Router $router) {
        $productos = Producto::allProductos();
        $router->dispatch('paginas/index', [
            'inicio' => true,
            'productos' => $productos
        ]);
    }

    public static function productos(Router $router) {
        $productos = Producto::allProductos();
        $router->dispatch('paginas/productos', [
            'productos' => $productos
        ]);
    }

    public static function producto(Router $router) {
        $id = validarORedireccionar('/producto');
        $producto = Producto::find($id);
        $router->dispatch('paginas/producto', [
            'producto' => $producto
        ]);
    }
}
