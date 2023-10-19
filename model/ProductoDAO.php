<?php
include_once('config/DataBase.php');

class ProductoDAO{
    public static function getAllProducts(){
        $conexion = DataBase::connect();
        /*$stmt = $conexion->prepare("SELECT * FROM productos");
        $stmt->execute();
        var_dump($stmt->get_result());
        $conexion*/
        if($result = $conexion->prepare("SELECT * FROM productos")){
            while($producto = $result->fetch_array()){
                echo $producto['nombre_producto'];
                echo '<br>';
            }
        }
    }
}