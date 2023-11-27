<?php 
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../includes/app.php';


use Controllers\CarritoController;
use Controllers\LoginController;
use Controllers\PaginasController;
use Controllers\ProductoController;
use MVC\Router;


$router = new Router();

$router->get('/admin', [ProductoController::class, 'index']);
$router->get('/productos/crear', [ProductoController::class, 'crear']);
$router->post('/productos/crear', [ProductoController::class, 'crear']);
$router->get('/productos/actualizar', [ProductoController::class, 'actualizar']);
$router->post('/productos/actualizar', [ProductoController::class, 'actualizar']);
$router->post('/productos/eliminar', [ProductoController::class, 'eliminar']);
$router->post('/carrito/agregar', [CarritoController::class, 'agregarProductoAlCarrito']);
$router->get('/carrito/agregar', [CarritoController::class, 'agregarProductoAlCarrito']);
$router->get('/carrito/eliminar', [CarritoController::class, 'eliminarProducto']);
$router->get('/carrito/eliminar', [CarritoController::class, 'eliminarProducto']);

//CHECKOUT VISTA
$router->get('/carrito/comprar', [CarritoController::class, 'comprar']);
//CHECKOUT VISTA POST
$router->post('/carrito/comprar', [CarritoController::class, 'comprar']);
$router->post('/carrito/datosCompra', [CarritoController::class, 'datosCompra']);

// * Vistas Públicas */
$router->get('/', [PaginasController::class, 'index']);
$router->get('/productos', [PaginasController::class, 'productos']);
$router->get('/productos/premium-damas', [PaginasController::class, 'productosPremiumD']);
$router->get('/productos/super-premium-damas', [PaginasController::class, 'productosSuPremiumD']);
$router->get('/productos/premium-caballeros', [PaginasController::class, 'productosPremiumC']);
$router->get('/productos/super-premium-caballeros', [PaginasController::class, 'productosSuPremiumC']);
$router->get('/producto', [PaginasController::class, 'producto']);
$router->get('/productos/producto', [PaginasController::class, 'producto']);

$router->get('/loginAdmin', [LoginController::class, 'loginAdmin']);
$router->post('/loginAdmin', [LoginController::class, 'loginAdmin']);

$router->get('/loginUsuario', [LoginController::class, 'loginUsuario']);
$router->post('/loginUsuario', [LoginController::class, 'loginUsuario']);
$router->get('/logout', [LoginController::class, 'logout']);


// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();