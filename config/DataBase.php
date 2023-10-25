<?php

class DataBase{
    public static function connect($host='localhost', $user='root', $pwd='', $db='rextura'){
        $con = new mysqli($host,$user,$pwd,$db);
        if($con == false){
            die('DATABASE ERROR');
        }else{
            return $con;
        }
    }
}

?>