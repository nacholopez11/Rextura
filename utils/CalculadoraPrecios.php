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

    // FUNCION PARA CALCULAR PRECIO TOTAL DE UN PEDIDO DESPUES DE APLICAR PUNTOS DE FIDELIDAD
    // public static function calculadorPrecioPedidoConPuntos($pedidos, $puntos){
    //     $precioTotal = self::calculadorPrecioPedido($pedidos);

    //     // Resta los puntos del total del pedido
    //     $precioTotalConPuntos = max(0, $precioTotal - $puntos);

    //     return $precioTotalConPuntos;
    // }

    // public static function calculadorPrecioPedidoConPropinaPred($pedidos){
    //     $precioTotal = 0;

    //     foreach($pedidos as $pedido){
    //         $precioTotal += $pedido->devuelvePrecioTotal();
    //     }

    //     $precioFinal = ($precioTotal+($precioTotal/100)*3);

    //     return $precioFinal;
    // }
}
?>