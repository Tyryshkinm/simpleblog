<?php

class route
{
    static public function start()
    {
        $controller_name = 'main_controller';
        $action_name = 'index';
        $routes = explode('/', $_SERVER['REQUEST_URI']);

        if (!empty($routes[1]))
        {
            $controller_name = $routes[1].'_controller';
        }
        if (!empty($routes[2]))
        {
            $action_name = $routes[2];
        }

        $controller_file = $controller_name.'.php';
        $controller_path = 'application/controllers/'.$controller_file;
        if(file_exists($controller_path))
        {
            include 'application/controllers/'.$controller_file;
        }
        else
            echo "такого файла не существует".'</br>';

        $controller = new $controller_name;
        $action = $action_name;

        if (method_exists($controller, $action))
        {
            $controller->$action();
        }
        else
            echo "такого метода не существует";
    }
}