<?php

class Route {

    public static function marsh($routes)
    {
        if (!is_array($routes)) {
            throw new Exception('Неверный маршрут!');
        }

        $controller = $routes[1] ?: 'tasks';
        $action = $routes[2] ?: 'index';

        $model_path = "code/models/m_" . $controller . '.php';
        if(file_exists($model_path))
        {
            include $model_path;
        }

        $controller_name = 'c_' . $controller;
        $controller_path = "code/controllers/" . $controller_name . '.php';
        if (file_exists($controller_path)) {
            include $controller_path;
        } else {
            throw new Exception('Подходящего контроллера не найдено!');
        }

        $controller = new $controller_name;

        if(method_exists($controller, $action)) {
            $controller->$action();
        } else {
            throw new Exception('Подходящего метода в контроллере ' . $controller_name . ' не найдено!');
        }
    }
}