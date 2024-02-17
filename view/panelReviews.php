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
    // Incluye el header
    include_once 'header.php';
    ?>
    <section class="container">
        <h1 class="titulos-secciones">Panel de reseñas</h1>
        <div class="row p-0">
            <div class="col-2 p-0">
                <!-- FILTROS -->
                <form id="filterForm">
                    <h3 class="titulo-categoria">VALORACIONES</h3>
                    <div>
                        <input type="checkbox" id="rating1" name="rating1" value="1">
                        <label for="rating1" class="titi">1</label>
                    </div>
                    <div>
                        <input type="checkbox" id="rating2" name="rating2" value="2">
                        <label for="rating2" class="titi">2</label>
                    </div>
                    <div>
                        <input type="checkbox" id="rating3" name="rating3" value="3">
                        <label for="rating3" class="titi">3</label>
                    </div>
                    <div>
                        <input type="checkbox" id="rating4" name="rating4" value="4">
                        <label for="rating4" class="titi">4</label>
                    </div>
                    <div>
                        <input type="checkbox" id="rating5" name="rating5" value="5">
                        <label for="rating5" class="titi">5</label>
                    </div>
                </form>
                <div class="asc-btn">
                    <h3 class="titulo-categoria p-orden">ORDEN</h3>
                    <select id="orderSelect" class="selector">
                        <option value="asc">Ascendente</option>
                        <option value="desc">Descendente</option>
                    </select>
                    <button class="boton-principal" onclick="window.location.href='index.php?controller=review&action=panelInsertarReview'">Añadir reseña</button>
                </div>
            </div>
            <div class="col-10 p-0">
                <!-- RESEÑAS -->
                <section class="reviews p-0">
                    <div class="container p-0">
                        <div class="row p-0" id="container"></div>
                    </div>
                </section>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="assets/js/mostrarReview.js"></script>
    <script src="assets/js/insertarReview.js"></script>
    <script src="assets/js/filtroReview.js"></script>
    <script src="https://unpkg.com/notie"></script>
</body>
</html>

