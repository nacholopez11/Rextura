<?php
include_once('controller/productController.php');
include_once('controller/usuarioController.php'); 
include_once('controller/reviewController.php');  
include_once('controller/apiController.php');  
include_once('config/parameters.php');

if (!isset($_GET['controller'])) {
    header("Location:" . url . '?controller=product');
} else {
    $nombre_controller = $_GET['controller'] . 'Controller';
    if (class_exists($nombre_controller)) {

        if ($nombre_controller === 'usuarioController') {
            $action = isset($_GET['action']) ? $_GET['action'] : 'login';
            $controller = new $nombre_controller();
        } else {
            $controller = new $nombre_controller();
            $action = isset($_GET['action']) && method_exists($controller, $_GET['action']) ? $_GET['action'] : action_default;
        }

        $controller->$action();
    } else {
        header("Location:" . url . '?controller=product');
    }
}
?>