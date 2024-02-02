<?php
include_once 'config/DB.php';
include_once 'model/Review.php';

class ReviewDAO {
    public static function mostrarReviews() {
        $con = DB::getConnection();

        $query = "SELECT reviews.id, reviews.usuario_id, reviews.comentario, reviews.valoracion, reviews.nombre
        FROM reviews JOIN usuarios ON reviews.usuario_id = usuarios.id;";

        $stmt = $con->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $comentario = [];
        while ($row = $result->fetch_object('Review')) {
            $comentario[] = $row;
        }

        return $comentario;
    }

    public static function insertarReview($usuarioId, $comentario, $valoracion, $nombre) {
        $con = DB::getConnection();
        $query = "INSERT INTO reviews (usuario_id, comentario, valoracion, nombre) VALUES (?, ?, ?, ?)";
        $stmt = $con->prepare($query);
        $stmt->bind_param("isis", $usuarioId, $comentario, $valoracion, $nombre);
        $stmt->execute();
    }

}
?>