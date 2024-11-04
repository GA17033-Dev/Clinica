<?php
// Configuración de errores
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Definir controlador por defecto
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'inicio';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

// Formatear el nombre del controlador
$controllerName = ucfirst($controller) . 'Controller';
$controllerFile = "controllers/$controllerName.php";

// Verificar si existe el controlador
if (file_exists($controllerFile)) {
    require_once $controllerFile;
    $controller = new $controllerName();
    
    // Verificar si existe la acción
    if (method_exists($controller, $action)) {
        $controller->$action();
    } else {
        header("HTTP/1.0 404 Not Found");
        echo "Acción no encontrada";
    }
} else {
    // Si no existe el controlador, cargar la página de inicio
    require_once 'controllers/InicioController.php';
    $controller = new InicioController();
    $controller->index();
}