<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda de Productos</title>
    <link href="./assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="./assets/css/full_estil_home.css" rel="stylesheet" type="text/css" media="screen">
</head>
<body>
<?php
    // Incluye el header
    include_once 'header.php';
    ?>
    <!-- EMPIEZA SECCION SLIDER -->
    <section class="container">
            <div id="carouselPrincipal" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselPrincipal" data-bs-slide-to="0" class="active indicador-carusel" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselPrincipal" data-bs-slide-to="1" class="indicador-carusel" aria-label="Slide 2"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active" data-bs-interval="10000">
                        <div class="row">
                            <div class="col-12 col-md-4" style="background-color: #B8C8A4;">
                                <div class="div-texto-slider">
                                    <h6 class="texto1-slider">Secretos de cocina</h6>
                                    <h6 class="texto2-slider">DESCUBRE LOS NUEVOS PLATOS</h6>
                                    <button type="button" class="boton-slider-verde">QUIERO VERLOS TODOS</button>
                                </div>
                            </div>
                            <div class="col-0 col-md-8" style="background-image: url(./assets/images/img1-banner1.png);"></div>
                        </div>
                    </div>
                    <div class="carousel-item" data-bs-interval="10000">
                        <div class="row">
                            <div class="col-12 col-md-4" style="background-color: #5E5856;">
                                <div class="div-texto-slider">
                                    <h6 class="texto1-slider">Nuestros cocineros</h6>
                                    <h6 class="texto2-slider">DESCUBRE A NUESTRO EQUIPO</h6>
                                    <button type="button" class="boton-slider-gris">SABER MÁS</button>
                                </div>
                            </div>
                            <div class="col-0 col-md-8" style="background-image: url(./assets/images/img2-banner1.jpg);"></div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <!-- EMPIEZA SECCION PRODUCTOS -->
    <section class="container">
        <div>
            <h1 class="titulos-secciones">Novedades</h3>
        </div>
        <div class="container text-center">
        <div class="row">
            <?php for($i=0; $i<4; $i++){ ?>
                <article class="col-6 col-lg-3 producto-ind">
                        <div class="card">
                            <img src="./assets/images/productos/<?=$product->getImage(); ?>" class="card-img-top" alt="<?=$product->getNombre(); ?>">
                            <div class="card-body">
                                <h6 class="nuevo">Nuevo</h6>
                                <h5 class="nombre-producto"><?=$product->getNombre(); ?></h5>
                                <div class="precio">
                                    <p class="precio-normal"><?=$product->getPrecio(); ?>€</p>
                                    <div class="div-premium">
                                        <p class="precio-premium"><?=$product->getPrecioPremium(); ?>€</p>
                                        <p class="palabra-premium">PREMIUM</p>
                                    </div>
                                    <form class="boton-carrito" action=<?=url.'?controller=product&action=añadirCarrito'?> method="post">
                                        <input type="hidden" name="action" value="añadirCarrito">
                                        <input type="hidden" name="id" value="<?=$product->getId(); ?>">
                                        <button type="submit"class="boton-principal">Añadir</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                </article>
            <?php } ?>
        </div>
    </div>
    </section>
     <!-- EMPIEZA DIV CATEGORIAS -->
    <section class="container">
        <div class="container text-center">
            <div class="row">
              <div class="col-12 col-lg-4 categorias">
                <a href="#" class="contenedor">
                    <div class="text-superpuesto">
                        <div class=""><p class="c-t-1">Platos principales</p></div>
                        <div class=""><p class="c-t-2">Nuestra especialidad</p></div>
                    </div>
                    <img src="./assets/images/categoria-1.png" class="imagen" alt="...">
                </a>
              </div>
              <div class="col-12 col-lg-4 categorias">
                <a href="#" class="contenedor">
                    <div class="text-superpuesto">
                        <div class=""><p class="c-t-1">Nuestros postres</p></div>
                        <div class=""><p class="c-t-2">Todos caseros</p></div>
                    </div>
                    <img src="assets/images/categoria-2.jpg" class="imagen" alt="...">
                </a>
              </div>
              <div class="col-12 col-lg-4 categorias">
                <a href="#" class="contenedor">
                    <div class="text-superpuesto">
                        <div class=""><p class="c-t-1">Y para beber...</p></div>
                        <div class=""><p class="c-t-2">Nuevas incorporaciones</p></div>
                    </div>
                    <img src="assets/images/categoria-3.jpg" class="imagen" alt="...">
                </a>
              </div>
            </div>
        </div>
    </section>
    <!-- EMPIEZA SECCION INFO -->
    <section class="container seccion-4">
        <div class="container text-center">
            <div class="row">
                <div class="col-4 div-info">
                    <div class="caja-contenido-info">
                        <img src="./assets/icons/envio-gris.png" class="icon-info">
                        <h3 class="texto-1-info">envíos gratis a partir de 50€</h3>
                        <p class="texto-2-info">Para todos aquellos que les gusta estar en casa.</p>
                        <p class="texto-2-info">Tus pedidos llegarán en menos de 30 minutos.</p>
                    </div>
                </div>
                <div class="col-4 div-info">
                    <div class="caja-contenido-info">
                        <img src="./assets/icons/ubi-gris.png" class="icon-info">
                        <h3 class="texto-1-info">nuestros restaurantes</h3>
                        <p class="texto-2-info">¿Quieres ver qué restaurante  está más cerca de tu casa?</p>
                        <p class="texto-2-info">Aquí estará el tuyo.</p>
                    </div>
                </div>
                <div class="col-4 div-info">
                    <div class="caja-contenido-info">
                        <img src="./assets/icons/regalo-gris.png" class="icon-info">
                        <h3 class="texto-1-info">refrescos gratuitos</h3>
                        <p class="texto-2-info">¿Eres de beber?</p>
                        <p class="texto-2-info">Por cada 30 € de cuenta te daremos un refresco gratuito.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
    // Incluye el header
    include_once 'footer.php';
    ?>
</body>
<script src="assets/js/bootstrap.bundle.min.js"></script>
</html>