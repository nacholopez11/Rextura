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
        } elseif ($_GET["accion"] == 'insertarReview') {
            $data = json_decode(file_get_contents('php://input'), true);
            $comentario = $data['comentario'];
            $valoracion = $data['valoracion'];
            if (isset($_SESSION['user'])) {
                $user = $_SESSION['user'];
                $usuarioId = $user->getId();
                $nombre = $user->getUsername();
            } else {
                $usuarioId = null;
                $nombre = null;
            }
            $review = new Review($usuarioId, $comentario, $valoracion, $nombre);
            ReviewDAO::insertarReview($review);
        }
    }
}
?>