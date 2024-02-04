<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review</title>
    <link href="./assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="./assets/css/full_estil_review.css" rel="stylesheet" type="text/css" media="screen">
    <link href="./assets/css/full_estil_general.css" rel="stylesheet" type="text/css" media="screen">
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/notie/dist/notie.min.css">
</head>
<body>

<?php
    // Incluye el header y ReviewDAO
    require_once './dao/ReviewDAO.php'; 
    include_once 'header.php';
    ?>
    <h1>Panel de Reseñas</h1>

    <form id="reviewForm">
        <label for="pedido_id">Pedido ID:</label>
        <select id="pedido_id" name="pedido_id" required>
            <?php
            $pedidos = ReviewDAO::obtenerPedidosSinResena();
            foreach ($pedidos as $pedidoId) {
                echo "<option value=\"$pedidoId\">$pedidoId</option>";
            }
            ?>
        </select>
        <label for="comentario">Comentario:</label>
        <textarea id="comentario" name="comentario" required></textarea>

        <label for="valoracion">Valoración:</label>
        <input type="number" id="valoracion" name="valoracion" min="1" max="5" required>
        <button type="submit">Agregar Reseña</button>
    </form>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="assets/js/insertarReview.js"></script>
    <script src="https://unpkg.com/notie"></script>
</body>
</html>