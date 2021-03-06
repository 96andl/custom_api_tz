<?php
/**
 * Created by PhpStorm.
 * User: andrew
 * Date: 6/14/18
 * Time: 12:29 PM
 */

namespace Core;

class Router
{
    protected $routes = [
        'GET',
        'POST',
        'PUT',
        'DELETE',
        'PATCH'
    ];

    protected $currentRoute;

    public static function load($file)
    {
        $router = new static;
        require $file;
        return $router;
    }

    public function define($routes)
    {
        $this->routes = $routes;
    }

    public function get($uri, $controller)
    {
        $this->routes['GET'][$uri] = $controller;
        $this->currentRoute = $uri;
        return $this;
    }

    public function post($uri, $controller)
    {
        $this->routes['POST'][$uri] = $controller;
        $this->currentRoute = $uri;
        return $this;
    }

    public function delete($uri, $controller)
    {
        $this->routes['DELETE'][$uri] = $controller;
        $this->currentRoute = $uri;
        return $this;
    }

    public function put($uri, $controller)
    {
        $this->routes['PUT'][$uri] = $controller;
        $this->currentRoute = $uri;
        return $this;
    }

    public function patch($uri, $controller)
    {
        $this->routes['PATCH'][$uri] = $controller;
        $this->currentRoute = $uri;

    }

    public function direct($uri, $requestMethod)
    {
        if (array_key_exists($uri, $this->routes[$requestMethod])) {

            return $this->callAction(
                ...explode('@', $this->routes[$requestMethod][$uri])
            );
        }

        throw  new \Exception('No route defined for this URI');
    }

    public function callAction($className, $action)
    {

        if (!method_exists($controller = new $className, $action)) {

        }
        return $controller->$action();
    }

    public function middleware($name)
    {
        if (Request::uri() === $this->currentRoute) {
            $middleware = new Middleware();
            $middleware->$name();
        }
    }
}