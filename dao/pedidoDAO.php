<?php
include_once 'config/DB.php';
include_once 'model/Pedido.php';
include_once 'dao/productDAO.php';

class PedidoDAO {

    public function obtenerPedidosPorUsuario($usuario_id) {
        $con = DB::getConnection();
        $stmt = $con->prepare("SELECT * FROM pedidos WHERE usuario_id = ?");
        $stmt->bind_param("i", $usuario_id);
        $stmt->execute();
        $result = $stmt->get_result();
    
        $pedidos = array();
        while ($row = $result->fetch_object()) {
            // Aquí asumimos que tienes una clase Producto y una función obtenerProductoPorId
            $producto = ProductDAO::getProductById($row->id);
            $pedido = new Pedido($producto);
            $pedido->setCantidad($row->cantidad);
            // Añade más campos si es necesario
            $pedidos[] = $pedido;
        }
    
        $con->close();
        return $pedidos;
    }
}
?>