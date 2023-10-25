<?php
include_once ('model/Producto.php');
class Postre extends Productos{
    private $genero;

    public function __construct($producto_id, $nombre_producto,$descripcion,$genero){
        parent::__construct($producto_id, $nombre_producto,$descripcion);
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