<?php
include_once 'config/DB.php';
include_once 'model/Review.php';

class ReviewDAO {
    public static function getComentarios() {
        $con = DB::getConnection();

        $query = "SELECT reviews.id, reviews.usuario_id, reviews.comentario, reviews.valoracion, reviews.nombre
        FROM reviews JOIN usuarios ON reviews.usuario_id = usuarios.id;";

        $stmt = $con->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $comentario = [];
        while ($row = $result->fetch_object('Comentarios')) {
            $comentario[] = $row;
        }

        return $comentario;
    }

}
?>