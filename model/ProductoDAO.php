<?php
include_once('config/DataBase.php');

class ProductoDAO{
    public static function getAllByType($tipo){
        $con = DataBase::connect();

        $stmt = $con->prepare("SELECT * FROM productos WHERE tipo=?");
        $stmt = bind_param("s",$tipo);


        $stmt->execute();
        $result = $stmt->get_result();

        $con->close();

        $listaProductos = [];
        while($productoDB = $result->fetch_object($tipo)){
            $listaProductos[] = $productoDB;
        }

        return $listaProductos;
    }




   /* public static function getAllProducts(){
        $conexion = DataBase::connect();
        /*$stmt = $conexion->prepare("SELECT * FROM productos");
        $stmt->execute();
        var_dump($stmt->get_result());
        $conexion*
        if($result = $conexion->prepare("SELECT * FROM productos")){
            while($producto = $result->fetch_array()){
                echo $producto['nombre_producto'];
                echo '<br>';
            }
        }
    }
        public static function getAllPostre(){
            $conexion = DataBase::connect();
            /*$stmt = $conexion->prepare("SELECT * FROM productos");
            $stmt->execute();
            var_dump($stmt->get_result());
            $conexion*

            $stmt = $conexion->prepare("SELECT * FROM productos WHERE tipo=?");
            $stmt = bind_param("s",$tipo);

            $stmt->execute($conexion);


            if($result = $conexion->prepare("SELECT * FROM productos")){
                while($producto = $result->fetch_array()){
                    echo $producto['nombre_producto'];
                    echo '<br>';
                }
            }
        }*/
}