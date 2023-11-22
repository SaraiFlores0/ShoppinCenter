<?php
// App\Router.php

namespace App;

use App\Http\Middleware\AuthenticationMiddleware;

class Router {
    private $routes = [];
    private $authenticationMiddleware;

    public function __construct() {
        $this->authenticationMiddleware = new AuthenticationMiddleware();
    }

    public function addPublicRoute($url, $controllerMethod) {
        $this->addRoute($url, $controllerMethod, [], true);
    }

    public function addPrivateRoute($url, $controllerMethod, $allowedRoles = []) {
        $this->addRoute($url, $controllerMethod, $allowedRoles, false);
    }

    private function addRoute($url, $controllerMethod, $allowedRoles, $isPublic) {
        $this->routes[$url] = [
            'controllerMethod' => $controllerMethod,
            'allowedRoles' => $allowedRoles,
            'isPublic' => $isPublic
        ];
    }

    public function dispatch($url, $data = []) {
        if (array_key_exists($url, $this->routes)) {
            $route = $this->routes[$url];
            if ($route['isPublic'] || $this->authenticationMiddleware->checkAuthentication($route['allowedRoles'])) {
                $this->callControllerMethod($route['controllerMethod'], $data);
            } else {
                echo "Access Denied";
            }
        } else {
            echo "404 Not Found";
        }
    }

    private function callControllerMethod($controllerMethod, $data) {
        list($controller, $method) = explode('@', $controllerMethod);
        $controllerClass = "App\Http\Controllers\\$controller";
        $controllerInstance = new $controllerClass();

        if (method_exists($controllerInstance, $method)) {
            $controllerInstance->$method($data);
        } else {
            echo "404 Not Found";
        }
    }
}
