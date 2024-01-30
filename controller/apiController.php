<?php
require_once 'Review.php';
require_once 'ReviewDAO.php';

class APIController {    
    public function api() {
        $reviewDAO = new ReviewDAO();

        if ($_POST["accion"] == 'add_review') {
            ReviewDAO::getReviews();
        } elseif ($_POST["accion"] == 'get_reviews') {
            $reviews = $reviewDAO->getReviews();
            echo json_encode($reviews);
        }
    }
}
?>