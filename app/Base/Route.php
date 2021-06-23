<?php

namespace App\Base;

class Route
{
    public static function run()
    {
        $contrName = 'main';
        $actName = 'index';

        $routes = explode('/', $_SERVER['REQUEST_URI']);

        if (!empty($routes[1])) {
            $contrName = $routes[1];
        }

        if (!empty($routes[2])) {
            $actName = explode('?', $routes[2])[0];
        }

        $contrPath = 'App\\Controllers\\' . ucfirst($contrName) . 'Controller';
        $actPath = $actName . 'Action';

        $controller = new $contrPath();
        if (method_exists($controller, $actPath)) {
            $controller->$actPath();
        } else {
            Route::errorPage404();
        }
    }
    public function errorPage404()
    {
        $host = 'http://' . $_SERVER['HTTP_HOST'] . '/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:' . $host . '404');
        echo 32;
    }
}
