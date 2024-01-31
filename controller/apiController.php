<?php
require_once 'Review.php';
require_once 'ReviewDAO.php';
require_once 'usuarioDAO.php';

class APIController {    
    public function api() {
        if ($_GET["accion"] == 'buscar_review') {
            $comentarios = ReviewDAO::getComentarios();
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
        } elseif ($_POST["accion"] == 'insertar') {
            
        }
    }
}
?>