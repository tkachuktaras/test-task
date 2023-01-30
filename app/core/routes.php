<?php

class Route
{
    static function start()
    {
        $routes = explode('/', $_SERVER['REQUEST_URI']);

        $controller_name = !empty($routes[1]) ? $routes[1] : 'Main';
        $action_name = !empty($routes[2]) ? $routes[2] : 'index';
        $parameter = !empty($routes[3]) ? $routes[3] : NULL;

        $model_name = $controller_name . '_model';
        $controller_name = $controller_name == '404' ? 'controller_404' : $controller_name . '_controller';


        $model_file = strtolower($model_name) . '.php';
        $model_path = "app/models/" . $model_file;
        if(file_exists($model_path)) {
            include "app/models/" . $model_file;
        }

        $controller_file = strtolower($controller_name) . '.php';
        $controller_path = "app/controllers/" . $controller_file;
        if(file_exists($controller_path)) {
            include "app/controllers/" . $controller_file;
        } else {
            Route::ErrorPage404();
        }

        $controller = new $controller_name;
        $action = $action_name;

        if(method_exists($controller, $action)) {
            $controller->$action($parameter);
        } else {
            Route::ErrorPage404();
        }

    }

    function ErrorPage404()
    {
        $host = 'http://' . $_SERVER['HTTP_HOST'] . '/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:' . $host . '404');
    }
}