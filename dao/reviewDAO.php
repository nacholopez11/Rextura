<?php
require_once 'review.php';

class ReviewDAO {
    public static function getReviews() {
        // Aquí obtendrías las reseñas de tu base de datos
        // Supongamos que obtienes un array de objetos Review
        $reviews = obtenerResenasDesdeLaBaseDeDatos();

        // Convertir los objetos a arrays asociativos
        $reviewsArray = array_map(function ($review) {
            return get_object_vars($review);
        }, $reviews);

        return $reviewsArray;
    }

    public static function addReview($review) {
        // Aquí deberías implementar la lógica para agregar la reseña a la base de datos
        // $review es un objeto, conviértelo a un array asociativo antes de guardarlo
        $reviewArray = get_object_vars($review);
        guardarResenaEnLaBaseDeDatos($reviewArray);

        return array('success' => true);
    }
}
?>