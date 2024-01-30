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
}
?>
