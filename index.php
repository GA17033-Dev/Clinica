<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);


$controller = isset($_GET['controller']) ? $_GET['controller'] : 'inicio';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

// Formatear el nombre del controlador
$controllerName = ucfirst($controller) . 'Controller';
$controllerFile = "controllers/$controllerName.php";

if (file_exists($controllerFile)) {
    require_once $controllerFile;
    $controller = new $controllerName();
    

    if (method_exists($controller, $action)) {
        $controller->$action();
    } else {
        header("HTTP/1.0 404 Not Found");
        echo "Acción no encontrada";
    }
} else {
    require_once 'controllers/InicioController.php';
    $controller = new InicioController();
    $controller->index();
}