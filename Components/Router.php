<?php

class Router
{
    private $routes;
    CONST ROUTES_PATH = ROOT . 'config/routes.php';

    public function __construct()
    {
        $this->routes = include(self::ROUTES_PATH);
    }

    private function getURI()
    {
        $uri = $_SERVER['REQUEST_URI'];
        if (! empty($uri)) {
            return trim(filter_var($uri, FILTER_SANITIZE_URL), '/');
        }
    }

    public function run()
    {
        // Get query string
        $uri = $this->getURI();

        foreach ($this->routes as $uriPattern => $path) {
            // Is query string exists in routes.php

            if (preg_match("~^$uriPattern(?![\w/])~", $uri)) {

                // If query string exists in routes.php identify controller and actions
                $segments = explode('/', $path);

                $controllerName = ucfirst(array_shift($segments)) . 'Controller';
                $actionName = array_shift($segments) . 'Action';

                // Include controller class file
                $controllerFile = ROOT . 'Controller/' . $controllerName . '.php';
                if (is_file($controllerFile)) {
                    include_once($controllerFile);
                }

                // Create object, call method (action)
                $controllerObject = new $controllerName;
                $result = $controllerObject->$actionName();

                if ($result != null) {
                    break;
                }
            }
        }
    }
}
