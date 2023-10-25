<?php
//Creamos el controlador de pedidos
class productoController{

    public function index(){
    $allProducts = ProductoDAO::getAllByType();
    //cabecera
    include_once 'views/cabecera.php';
    //panel
    include_once 'views/panelpedido.php';
    //footer
    }
        public function compra(){
            echo 'Pagina de compra';
        }
}




?>