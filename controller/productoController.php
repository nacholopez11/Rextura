<?php
//Creamos el controlador de pedidos
include_once('model/Postre.php');
class productoController{

    public function index(){
        //cabecera

        //panel
        /*
        $p1= new Postre(2,'Comida','Postre','Chocolate');
        
        $listaproductos = [$p1];

        var_dump($listaproductos);

        foreach($listaproductos as $producto){
            echo $producto->getName();
            echo '<br>';
        }
*/

        var_dump( ProductoDAO::getAllProducts());
        //footer
        echo 'Pagina principal pedidos';
    }


        public function compra(){
            echo 'Pagina de compra';
        }
}




?>