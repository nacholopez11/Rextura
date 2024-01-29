<?php
include_once 'config/DB.php';
include_once 'model/Review.php';

class ReviewDAO {
    // Ejemplo de cómo podrías obtener reseñas desde la base de datos
function obtenerResenasDesdeLaBaseDeDatos() {
    // Conectarte a la base de datos usando tu lógica específica de conexión
    $conexion = DB::getConnection();

    // Consulta para obtener reseñas (esto dependerá de tu esquema de base de datos)
    $query = "SELECT id, usuario_id, comentario, valoracion FROM reseñas";
    $result = $conexion->query($query);

    // Verifica si la consulta fue exitosa
    if ($result) {
        // Inicializa un array para almacenar las reseñas
        $reviews = array();

        // Recorre los resultados y crea objetos Review
        while ($row = $result->fetch_assoc()) {
            $review = new Review();
            $review->setId($row['id']);
            $review->setUsuarioId($row['usuario_id']);
            $review->setComentario($row['comentario']);
            $review->setValoracion($row['valoracion']);

            // Agrega la reseña al array
            $reviews[] = $review;
        }

        // Devuelve el array de reseñas
        return $reviews;
    } else {
        // Manejo de error si la consulta no fue exitosa
        die('Error al obtener reseñas desde la base de datos: ' . $conexion->error);
    }
}

    public static function addReview($review) {
        // Aquí deberías implementar la lógica para agregar la reseña a la base de datos

        // Escapar los valores para evitar inyección de SQL
        $usuario_id = DB::getConnection()->real_escape_string($review['usuario_id']);
        $comentario = DB::getConnection()->real_escape_string($review['comentario']);
        $valoracion = DB::getConnection()->real_escape_string($review['valoracion']);

        // Query para insertar la reseña en la base de datos
        $query = "INSERT INTO reseñas (usuario_id, comentario, valoracion) VALUES ('$usuario_id', '$comentario', '$valoracion')";

        // Ejecutar la consulta
        if (DB::getConnection()->query($query) === TRUE) {
            // Si la inserción fue exitosa, devolver éxito
            return array('success' => true);
        } else {
            // Si hay un error, devolver un mensaje de error
            $error_message = DB::getConnection()->error;
            return array('error' => 'Error al agregar la reseña: ' . $error_message);
        }
    }
}
?>