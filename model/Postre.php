<?php
include_once 'Producto.php';


class Postre extends Producto{
    private $genero;

    public function __construct($id, $name,$tipo,$genero){
        parent::__construct($id, $name,$tipo);
        $this->genero =$genero;

    }

    public function calculaPrecioTotal($numDias){
        $precioTotal = $numDias*self::PRECIOPOSTRE;
        return $precioTotal;
    }
    public function devuelvePrecioDia(){
        return self::PRECIOPOSTRE;
    }
}