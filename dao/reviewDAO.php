<?php
include_once 'config/DB.php';
include_once 'model/Review.php';

class ReviewDAO {
    public function addReview($review) {
        $con = DB::getConnection();
        $stmt = $con->prepare("INSERT INTO reviews (usuario_id, comentario, valoracion) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $review->getUsuarioId(), $review->getComentario(), $review->getValoracion());
        $stmt->execute();
    }

    // public function getReviews() {
    //     $con = DB::getConnection();
    //     $stmt = $con->prepare("SELECT * FROM reviews");
    //     $stmt->execute();
    //     $result = $stmt->get_result();

    //     $reviews = array();

    //     while ($row = $result->fetch_assoc()) {
    //         $review = new Review($row['usuario_id'], $row['comentario'], $row['valoracion']);
    //         array_push($reviews, $review);
    //     }

    //     return $reviews;
    // }

    public function getReviews() {
        $con = DB::getConnection();
        $stmt = $con->prepare("SELECT * FROM reviews");
        $stmt->execute();
        $result = $stmt->get_result();
        $reviews = $result->fetch_all(MYSQLI_ASSOC);
        return $reviews;
    }

}
?>