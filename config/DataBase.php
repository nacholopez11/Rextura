<?php

class DataBase{
    public static function connect($host='localhost', $user='root', $pwd='', $db='Rextura'){
        $conexion = new mysqli($host,$user,$pwd,$db);
        if($conexion == false){
            die('DATABASE ERROR');
        }else{
            return $conexion;
        }
    }
}