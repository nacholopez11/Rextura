<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Carta</title>
    <link href="./assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="./assets/css/full_estil_products.css" rel="stylesheet" type="text/css" media="screen">
    <link href="./assets/css/full_estil_general.css" rel="stylesheet" type="text/css" media="screen">
    <style>
        /* Agrega estilos según sea necesario */
        .hidden {
            display: none;
        }
    </style>
</head>
<body>
<?php
    // Incluye el header
    include_once 'header.php';
    ?>
    <section class="container">
        <div class="container">
            <?php if (isset($_SESSION['user'])) { ?>
                <?php $user = $_SESSION['user']; ?>
                <!-- COMPRUEBA EL ROL QUE TIENES AL INICIAR SESIÓN -->
                <?php if ($user->getRol() === 'admin') { ?>
                    <h1 class="titulos-secciones">Panel Administrador Productos</h1>
                <?php } else { ?>
                    <h1 class="titulos-secciones">Carta</h1>
                    <div class="banner-products">
                        <img src="./assets/images/img-banner-products.png" class="img-banner-products" alt="imagen banner pagina de productos">
                    </div>
                <?php } ?>
            <?php } else { ?>
                <h1 class="titulos-secciones">Carta</h1>
                <div class="banner-products">
                    <img src="./assets/images/img-banner-products.png" class="img-banner-products" alt="imagen banner pagina de productos">
                </div>
            <?php } ?>
        </div>
    </section>
    <section class="container">
        <div class="container text-center">
            <div class="botonadd">            
                <!-- COMPRUEBA QUE SE HA INICIADO SESIÓN -->
                <?php if (isset($_SESSION['user'])) { ?>
                    <?php $user = $_SESSION['user']; ?>
                    <!-- COMPRUEBA SI TIENES ROL ADMINISTRADOR AL INICIAR SESIÓN -->
                    <?php if ($user->getRol() === 'admin') { ?>
                        <form class="boton-carrito" action=<?=url.'?controller=product&action=panelAñadirProducto'?> method="post">
                            <!-- BOTON AÑADIR NUEVO PRODUCTO -->
                            <button type="submit" class="boton-nuevo-producto">Añadir producto nuevo</button>
                        </form>
                    <?php } ?>
                <?php } ?>
            </div>
            <div class="row cuerpo">
                <div class="filtros col-2">
                    <div class="filtro-categorias">
                        <h3 class="titulo-categoria">CATEGORIAS</h3>
                        <label><input type="checkbox" id="platoPrincipalCheckbox"><p class="titi"> Plato Principal</p></label>
                        <label><input type="checkbox" id="postreCheckbox"><p class="titi"> Postre</p></label>
                        <label><input type="checkbox" id="bebidaCheckbox"><p class="titi"> Bebida</p></label>
                    </div>
                </div>
                <div class="row col-12 col-lg-10">
                    <?php foreach ($products as $product): ?>
                        <article class="col-12 col-lg-3 col-md-6 col-sm-6 col-xs-12 producto-ind" data-categoria="<?=$product->getCategoria(); ?>">
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
                                        </div>
                                        <div class="botones">
                                            <!-- COMPRUEBA QUE SE HA INICIADO SESIÓN -->
                                            <?php if (isset($_SESSION['user'])) { ?>
                                                <?php $user = $_SESSION['user']; ?>
                                                <!-- COMPRUEBA EL ROL QUE TIENES AL INICIAR SESIÓN -->
                                                <?php if ($user->getRol() === 'admin') { ?>
                                                    <form class="boton-carrito" action=<?=url.'?controller=product&action=edit'?> method="post">
                                                        <!-- BOTON EDITAR -->    
                                                        <input type="hidden" name="action" value="edit">
                                                        <input type="hidden" name="id" value="<?=$product->getId(); ?>">
                                                        <button type="submit" class="boton-confirmar">Editar</button>
                                                    </form>
                                                    <form class="boton-carrito" action=<?=url.'?controller=product&action=eliminarProduct'?> method="post">
                                                        <!-- BOTON ELIMINAR -->
                                                        <input type="hidden" name="action" value="eliminar">
                                                        <input type="hidden" name="id" value="<?=$product->getId(); ?>">
                                                        <button type="submit" class="boton-confirmar">Eliminar</button>
                                                    </form>
                                                <?php } else { ?>
                                                    <form class="boton-carrito" action=<?=url.'?controller=product&action=añadirCarrito'?> method="post">
                                                        <!-- BOTON AÑADIR -->
                                                        <input type="hidden" name="action" value="añadirCarrito">
                                                        <input type="hidden" name="id" value="<?=$product->getId(); ?>">
                                                        <button type="submit" class="boton-confirmar">Añadir</button>
                                                    </form>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <form class="boton-carrito" action=<?=url.'?controller=product&action=añadirCarrito'?> method="post">
                                                    <!-- BOTON AÑADIR -->
                                                    <input type="hidden" name="action" value="añadirCarrito">
                                                    <input type="hidden" name="id" value="<?=$product->getId(); ?>">
                                                    <button type="submit" class="boton-confirmar">Añadir</button>
                                                </form>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>
<?php
// Incluye el footer
include_once 'footer.php';
?>
</body>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/filtroProductos.js"></script>
</html>