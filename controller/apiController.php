<?php
require_once './model/Review.php';
require_once './dao/ReviewDAO.php';
require_once './dao/usuarioDAO.php';

class APIController {    
    public function api() {
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
            // $nombre = $_POST['nombre'];
            $comentario = $_POST['comentario'];
            $valoracion = $_POST['valoracion'];
            if (isset($_SESSION['user'])) {
                $usuarioId = $_SESSION['user']->getId();
                $nombre = $_SESSION['user']->getUsername();
            } else {
                $usuarioId = null;
                $nombre = 'h';
            }
            $review = new Review($usuarioId, $comentario, $valoracion, $nombre);
            ReviewDAO::insertarReview($review);
        }
    }
}
?>