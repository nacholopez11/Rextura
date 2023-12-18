<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda de Productos</title>
    <link href="./assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="./assets/css/full_estil_products.css" rel="stylesheet" type="text/css" media="screen">
</head>
<body>
<?php
    // Incluye el header
    include_once 'header.php';
    ?>
<section class="container">
    <div class="container text-center">
        <h1 class="titulos-secciones">Carta</h1>
        <div class="banner-products">
            <img src="./assets/images/img-banner-products.png" class="img-banner-products" alt="imagen banner pagina de productos">
        </div>
    </div>
</section>
<section class="container">
    <div class="container text-center">
        <div class="row">
            <?php foreach ($products as $product): ?>
                <article class="col-6 col-lg-3 producto-ind">
                        <div class="card">
                            <img src="./assets/images/productos/<?=$product->getImage(); ?>" class="card-img-top" alt="<?=$product->getNombre(); ?>">
                            <div class="card-body">
                                <h5 class="nombre-producto"><?=$product->getNombre(); ?></h5>
                                <div class="precio">
                                    <p class="precio-normal"><?=$product->getPrecio(); ?>€</p>
                                    <div class="div-premium">
                                        <p class="precio-premium"><?=$product->getPrecioPremium(); ?>€</p>
                                        <p class="palabra-premium">PREMIUM</p>
                                    </div>
                                    <!--COMPRUEBA QUE SE HA INICIADO SESION-->
                                    <?php if (isset($_SESSION['user'])) { ?>
                                        <!--COMPRUEBA EL ROL QUE TIENES AL INICIAR SESION-->
                                        <?php if ($_SESSION['user']['rol'] === 'admin') { ?>

                                            <form class="boton-carrito" action=<?=url.'?controller=product&action=editarProduct'?> method="post">
                                                <!--BOTON EDITAR-->    
                                                <input type="hidden" name="action" value="añadirCarrito">
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
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
    <?php
    // Incluye el footer
    include_once 'footer.php';
    ?>
</body>
<script src="assets/js/bootstrap.bundle.min.js"></script>
</html>