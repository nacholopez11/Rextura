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
        <h1 class="titulos-secciones">Novedades</h1>
    </div>
    <div class="container text-center">
        <div class="row">
            <?php foreach ($products as $product): ?>
                <article class="col-12 col-lg-3 col-md-6 col-sm-6 col-xs-12 producto-ind">
                        <div class="card">
                            <img src="./assets/images/productos/<?=$product->getImage(); ?>" class="card-img-top" alt="<?=$product->getNombre(); ?>">
                            <div class="card-body">
                                <h2 class="nombre-producto"><?=$product->getNombre(); ?></h2>
                                <div class="row">
                                    <div class="precio col-6">
                                        <p class="precio-normal"><?=$product->getPrecio(); ?>€</p>
                                        <div class="div-premium">
                                            <p class="precio-premium"><?=$product->getPrecioPremium(); ?>€</p>
                                            <p class="palabra-premium">PREMIUM</p>
                                        </div>
                                        <?php if ($product instanceof Bebida && $product->getConAlcohol()): ?>
                                        <div class="div-edad">
                                            <p class="mayor-de-18">+18</p>
                                            <p class="palabra-mayor-de-18">AÑOS</p>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="botones col-6">
                                        <!--COMPRUEBA QUE SE HA INICIADO SESION-->
                                        <?php if (isset($_SESSION['user'])) { ?>
                                            <!--COMPRUEBA EL ROL QUE TIENES AL INICIAR SESION-->
                                            <?php if ($_SESSION['user']['rol'] === 'admin') { ?>

                                                <form class="boton-carrito" action=<?=url.'?controller=product&action=edit'?> method="post">
                                                    <!--BOTON EDITAR-->    
                                                    <input type="hidden" name="action" value="edit">
                                                    <input type="hidden" name="id" value="<?=$product->getId(); ?>">
                                                    <button type="submit"class="boton-principal">Editar</button>
                                                </form>
                                                <form class="boton-carrito" action=<?=url.'?controller=product&action=eliminarProduct'?> method="post">
                                                    <!--BOTON ELIMINAR-->
                                                    <input type="hidden" name="action" value="eliminar">
                                                    <input type="hidden" name="id" value="<?=$product->getId(); ?>">
                                                    <button type="submit"class="boton-principal">Eliminar</button>
                                                </form>
                                            <?php } else { ?>
                                                <form class="boton-carrito" action=<?=url.'?controller=product&action=añadirCarrito'?> method="post">
                                                    <!--BOTON AÑADIR-->
                                                    <input type="hidden" name="action" value="añadirCarrito">
                                                    <input type="hidden" name="id" value="<?=$product->getId(); ?>">
                                                    <button type="submit"class="boton-principal">Añadir</button>
                                                </form>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
     <!-- EMPIEZA DIV CATEGORIAS -->
    <section class="container contenedor-categorias">
        <div class="container text-center">
            <div class="row">
              <div class="col-12 col-lg-4 col-md-4 col-sm-12 col-xs-12 categorias">
                <a href="#" class="contenedor">
                    <div class="text-superpuesto">
                        <div class=""><p class="c-t-1">Platos principales</p></div>
                        <div class=""><p class="c-t-2">Nuestra especialidad</p></div>
                    </div>
                    <img src="./assets/images/categoria-1.png" class="imagen" alt="imagen banner categoria platos principales">
                </a>
              </div>
              <div class="col-12 col-lg-4 categorias">
                <a href="#" class="contenedor">
                    <div class="text-superpuesto">
                        <div class=""><p class="c-t-1">Nuestros postres</p></div>
                        <div class=""><p class="c-t-2">Todos caseros</p></div>
                    </div>
                    <img src="assets/images/categoria-2.jpg" class="imagen" alt="imagen banner categoria postres">
                </a>
              </div>
              <div class="col-12 col-lg-4 categorias">
                <a href="#" class="contenedor">
                    <div class="text-superpuesto">
                        <div class=""><p class="c-t-1">Y para beber...</p></div>
                        <div class=""><p class="c-t-2">Nuevas incorporaciones</p></div>
                    </div>
                    <img src="assets/images/categoria-3.jpg" class="imagen" alt="imagen banner categoria bebidas">
                </a>
              </div>
            </div>
        </div>
    </section>
    <!-- EMPIEZA SECCION INFO -->
    <section class="seccion-4">
        <div class="container text-center">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-4 col-lg-4 div-info">
                    <div class="caja-contenido-info">
                        <img src="./assets/icons/envio-gris.png" class="icon-info" alt="icono envio gratis">
                        <h3 class="texto-1-info">envíos gratis a partir de 50€</h3>
                        <p class="texto-2-info">Para todos aquellos que les gusta estar en casa.</p>
                        <p class="texto-2-info">Tus pedidos llegarán en menos de 30 minutos.</p>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-4 col-lg-4 div-info">
                    <div class="caja-contenido-info">
                        <img src="./assets/icons/ubi-gris.png" class="icon-info" alt="icono nuestros restaurantes">
                        <h3 class="texto-1-info">nuestros restaurantes</h3>
                        <p class="texto-2-info">¿Quieres ver qué restaurante  está más cerca de tu casa?</p>
                        <p class="texto-2-info">Aquí estará el tuyo.</p>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-4 col-lg-4 div-info">
                    <div class="caja-contenido-info">
                        <img src="./assets/icons/regalo-gris.png" class="icon-info" alt="icono refrescos gratuitos">
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