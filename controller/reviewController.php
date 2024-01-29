<?php
require_once './dao/reviewDAO.php';

class ReviewController {

    // FUNCION PARA IR A PAGINA DE RESEÑAS
    public function panelReviews() {
        session_start();
        include_once 'view/header.php';
        include_once 'view/panelReviews.php';
        include_once 'view/footer.php';
    }

    public function api() {
        header('Content-Type: application/json');
    
        $action = isset($_REQUEST['action']) ? $_REQUEST['action'] : null;
    
        switch ($action) {
            case 'getReviews':
                $reviews = ReviewDAO::obtenerResenasDesdeLaBaseDeDatos();
                echo json_encode($reviews);
                break;
            case 'addReview':
                // Verifica si la solicitud es POST
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    // Obtiene los datos del comentario y la valoración desde el cuerpo de la solicitud
                    $comentario = isset($_POST['comentario']) ? $_POST['comentario'] : '';
                    $valoracion = isset($_POST['valoracion']) ? $_POST['valoracion'] : '';
    
                    // Validaciones de datos (puedes agregar más según tus necesidades)
                    if (empty($comentario) || empty($valoracion)) {
                        http_response_code(400);
                        echo json_encode(array('error' => 'Todos los campos son obligatorios.'));
                        return;
                    }
    
                    // Crea un nuevo objeto Review con los datos recibidos
                    $review = new Review();
                    $review->setUsuarioId($_SESSION['usuario_id']); // Ajusta esto según tu lógica de usuario
                    $review->setComentario($comentario);
                    $review->setValoracion($valoracion);
    
                    // Llama a la función addReview en el DAO para agregar la reseña
                    $result = ReviewDAO::addReview($review);
    
                    // Devuelve la respuesta al cliente (éxito o error)
                    echo json_encode($result);
                } else {
                    // Si la solicitud no es POST, devuelve un error
                    http_response_code(405);
                    echo json_encode(array('error' => 'Método no permitido.'));
                }
                break;
            default:
                http_response_code(400);
                echo json_encode(array('error' => 'Invalid action.'));
                break;
        }
    }
}
?>