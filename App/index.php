<?php

require_once 'vendor/autoload.php';

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PaginasController;
use App\Router;

$router = new Router();

$router->addPublicRoute('/', 'HomeController@showHome');
$router->addPublicRoute('/paginas/index', 'PaginasController@index');
$router->addPublicRoute('/paginas/productos', 'PaginasController@productos');
$router->addPublicRoute('/paginas/producto', 'PaginasController@producto');

$router->addPrivateRoute('/dashboard', 'DashboardController@showDashboard', ['cliente']);
$router->addPrivateRoute('/admin', 'AdminController@showAdminPanel', ['admin']);
$router->addPrivateRoute('/logout', 'LogoutController@logout');

$router->dispatch($_SERVER['REQUEST_URI']);
