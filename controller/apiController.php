<?php
require_once './model/Review.php';
require_once './model/Usuario.php';
require_once './dao/ReviewDAO.php';
require_once './dao/usuarioDAO.php';

class APIController {    
    public function api() {
        session_start();
        if ($_GET["accion"] == 'buscar_review') {
            $comentarios = ReviewDAO::mostrarReviews();
            $comenArray = [];
            foreach ($comentarios as $comentario) {
                $comenArray[] = [
                    'id' => $comentario->getId(),
                    'nombre' => $comentario->getNombre(),
                    'comentario' => $comentario->getComentario(),
                    'valoracion' => $comentario->getValoracion(),
                ];
            }
            header("Content-Type: application/json");
            echo json_encode($comenArray, JSON_UNESCAPED_UNICODE);
            return;
        } elseif ($_REQUEST["accion"] == 'insertarReview') {
            $data = json_decode(file_get_contents('php://input'), true);
            $comentario = $data['comentario'];
            $valoracion = $data['valoracion'];
            if (isset($_SESSION['user'])) {
                $usuarioId = $_SESSION['user']->getId();
                $nombre = $_SESSION['user']->getUsername();
            } else {
                $usuarioId = null;
                $nombre = null;
            }
            ReviewDAO::insertarReview($usuarioId, $comentario, $valoracion, $nombre);
        }
    }
}
?>