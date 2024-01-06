<?php
class DB{
    // FUNCION PARA CONECTARSE A LA BD
    public static function getConnection($host='localhost', $user='root', $pwd='', $db='rextura'){
        $con = new mysqli($host,$user,$pwd,$db);
        if($con == false){
            die('DATABASE ERROR');
        }else{
            return $con;
        }
    }
}
?>