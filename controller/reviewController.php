<?php
require_once 'reviewDAO.php';

class ReviewController {
    public function api() {
        header('Content-Type: application/json');

        $action = isset($_GET['action']) ? $_GET['action'] : null;

        switch ($action) {
            case 'getReviews':
                echo json_encode(ReviewDAO::getReviews());
                break;
            case 'addReview':
                // Aquí debes implementar la lógica para agregar una nueva reseña
                // Puedes obtener los datos del comentario y la valoración desde $_POST o $_GET
                // Luego, utiliza ReviewDAO::addReview() para guardar la nueva reseña
                break;
            default:
                http_response_code(400);
                echo json_encode(array('error' => 'Invalid action.'));
                break;
        }
    }
}
?>