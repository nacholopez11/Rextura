<?php
class DB{
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