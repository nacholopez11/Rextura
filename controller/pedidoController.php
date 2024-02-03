<?php
include_once './model/Pedido.php';
include_once './model/Product.php';
include_once './dao/pedidoDAO.php';

class PedidoController {
    // FUNCION PRINCIPAL
    public function index() {
                
        // $products = ProductDAO::getFourProducts();
        // include_once 'view\panelHome.php'; 
    }

    public function panelPedidos() {
        session_start();
        if (isset($_SESSION['user']) && $_SESSION['user'] instanceof Usuario) {
            $usuario_id = $_SESSION['user']->getId();
            $pedidosDAO = new PedidoDAO();
            $pedidos = $pedidosDAO->obtenerPedidosPorUsuario($usuario_id);
            require_once('views/panelPedidos.php');
        } else {
            header("Location: index.php?controller=product&action=index");
            exit();
        }
    }
// FUNCION PARA IR A PAGINA DE PEDIDOS
// public function panelPedidos() {
//     session_start();
//     $products = ProductDAO::getAllProducts();
//     include_once 'view/header.php';
//     include_once 'view/products.php';
//     include_once 'view/footer.php';
// }

}
?>