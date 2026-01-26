<?php
namespace Acme\IntranetRestaurante\Routes;
class Router
{
    protected $routes = [];

    public function add($method, $url, $action)
    {
        $this->routes[$method][$url] = $action;
    }

    public function handleRequest()
    {
        $requestUrl = $_SERVER['REQUEST_URI'];
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        // URL parse
        $url = explode('/', $requestUrl);
        $url = array_slice($url, 2);
        $requestUrl = '/' . implode('/', $url);

        $requestUrl = strtok($requestUrl, '?');

        if (isset($this->routes[$requestMethod][$requestUrl])) {
            list($controllerName, $methodName) = explode('@', $this->routes[$requestMethod][$requestUrl]);
            $controllerName = "App\\Controllers\\" . $controllerName;
            $controller = new $controllerName();
            return $controller->$methodName();
        }

        echo "Page not found.";
    }
}