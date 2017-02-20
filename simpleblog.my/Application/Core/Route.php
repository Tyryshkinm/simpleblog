<?php
class Route
{
    static public function start()
    {
        $routes = explode('/', $_SERVER['REQUEST_URI']);
        if (isset($_GET['page']) and empty($routes[3])) {
            $controllerName = 'PostController';
        } else {
            if (!empty($routes[1])) {
                $controllerName = $routes[1] . 'Controller';
            } else {
                $controllerName = 'PostController';
            }
        }

        if (!empty($routes[2])) {
            $actionName = $routes[2];
        } else {
            $actionName = 'index';
        }

        if (!empty($routes[3])) {
            $actionName = $routes[3];
            if (isset($_GET['page'])) {
                $actionName = stristr($routes[3], '?', true);
            }
        }

        if (count($routes) > 4) {
            echo "Почему слетают стили?";
            $controllerName = 'PostController';
            $actionName = 'pageNotFound';
        }

        $controllerFile = ucfirst($controllerName) . '.php';
        $controllerPath = 'Application/Controllers/' . $controllerFile;
        if(file_exists($controllerPath)) {
            include 'Application/Controllers/' . $controllerFile;
        } else {
            require_once(realpath($_SERVER["DOCUMENT_ROOT"]) . '/Application/Controllers/PostController.php');
            $controllerName = 'PostController';
            $actionName = 'pageNotFound';
        }

        $controller = new $controllerName;
        $action = $actionName;

        if (method_exists($controller, $action)) {
            $controller->$action();
        } else {
            $action = 'index';
            $controller->$action();
        }
    }

    static public function redirekt($controller, $action, $parametr)
    {
        if ($parametr != NULL) {
            header('Location:/' . $controller . '/' . $parametr . '/' . $action . '');
        } elseif (isset($parametr)){
            header('Location:/' . $controller . '/' . $action . '');
        } else {
            header('Location:/');
        }
    }
}