<?php
include_once('controller/productController.php');
include_once('controller/usuarioController.php'); 
include_once('controller/reviewController.php');  
include_once('config/parameters.php');

if (!isset($_GET['controller'])) {
    // Si no se pasa nada, se mostrará la página principal de productos
    header("Location:" . url . '?controller=product');
} else {
    $nombre_controller = $_GET['controller'] . 'Controller';
    if (class_exists($nombre_controller)) {
        // Miramos si nos pasa una acción
        // si no mostramos por defecto

        if ($nombre_controller === 'usuarioController') {
            // Si el controlador es usuarioController, asegúrate de tener una acción válida
            $action = isset($_GET['action']) ? $_GET['action'] : 'login';
            
            // Instancia el controlador usuarioController
            $controller = new $nombre_controller();
        } elseif ($nombre_controller === 'reviewController') {
            // Si el controlador es reviewController, asegúrate de tener una acción válida
            $action = isset($_GET['action']) ? $_GET['action'] : 'api';
            
            // Instancia el controlador reviewController
            $controller = new $nombre_controller();
            $controller->$action(); // Llama directamente a la acción sin necesidad de la lógica adicional
            exit(); // Sale del script después de manejar la acción de reviewController
        } else {
            // Para otros controladores, sigue la lógica anterior
            $controller = new $nombre_controller();
            $action = isset($_GET['action']) && method_exists($controller, $_GET['action']) ? $_GET['action'] : action_default;
        }

        $controller->$action();
    } else {
        header("Location:" . url . '?controller=product');
    }
}
?>