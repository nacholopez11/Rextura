<?php
Class CalculadoraPrecios{
    // FUNCION PARA CALCULAR PRECIO TOTAL DE UN PEDIDO
    public static function calculadorPrecioPedido($pedidos){
        $precioTotal = 0;

        foreach($pedidos as $pedido){
            $precioTotal += $pedido->devuelvePrecioTotal();
        }
        return $precioTotal;
    }
}
?>