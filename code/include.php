<?php
require_once 'classes/model.php';
require_once 'classes/view.php';
require_once 'classes/controller.php';
require_once 'config.php';
require_once 'route.php';

$routes = explode('/', $_SERVER['REQUEST_URI']);
try {
    Route::marsh($routes); // запускаем route
} catch (Exception $e) {
    echo $e->getMessage();
}