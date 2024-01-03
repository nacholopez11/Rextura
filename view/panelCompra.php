<?php 
include_once 'model/Pedido.php';
include_once 'model/Product.php';
include_once 'utils/CalculadoraPrecios.php';
include_once 'controller/productController.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda de Productos</title>
    <link href="./assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="./assets/css/full_estil_carrito.css" rel="stylesheet" type="text/css" media="screen">
</head>
<body>
<?php
    // Incluye el header
    include_once 'header.php';
    ?>
    <section>
        <div class="titulo-pagina">
            <h1 class="texto-titulo-carrito">
                <span class="texto-titulo">Tu bolsa</span>
            </h1>
            <div class="paginacion">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a class="a-breadcrumb" href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Bolsa</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="contenido">
            <div class="col-6">
                <?php if (isset($_SESSION['selecciones']) && !empty($_SESSION['selecciones'])) {?>
                <table class="tabla-contenido-carrito">
                    <thead>
                        <tr class="fila-titulos">
                            <td class="col-nombre">
                                <div class="pos-titulos-1">    
                                    <span class="s-titulo">Articulo</span>
                                </div>
                            </td>
                            <td class="col-precio">
                                <div class="pos-titulos-2">    
                                    <span class="s-titulo">Precio</span>
                                </div>
                            </td>
                            <td class="col-cantidad">
                                <div class="pos-titulos-3">    
                                    <span class="s-titulo">Cantidad</span>
                                </div>
                            </td>
                            <td class="col-precio-total">
                                <div>    
                                    <span class="s-titulo">Subtotal</span>
                                </div>
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Creamos una fila por cada producto -->
                        <?php
                        $pos = 0;
                        foreach($_SESSION['selecciones'] as $pedido){
                            // Verifica si la cantidad es mayor que 0 antes de mostrar el producto
                            if ($pedido->getCantidad() > 0) {
                            ?>
                            <tr class="fila-producto">
                                <td class="col-nombre-info">
                                    <div class="contenido-col-1">
                                        <div class="producto-contenedor">
                                            <div class="producto-imagen col-6">
                                                <img src="./assets/images/productos/<?= $pedido->getProducto()->getImage() ?>" alt="Imagen del producto">
                                            </div>
                                            <div class="producto-detalles col-6">
                                                <p class="palabra-nombre"><?= $pedido->getProducto()->getNombre() ?></p>
                                                <p class="palabra-categoria"><?= $pedido->getProducto()->getCategoria() ?></p>
                                                <form action="<?= url . '?controller=product&action=eliminarProductoCarritoEntero' ?>" method="post">
                                                    <input type="hidden" name="pos" value="<?= $pos ?>">
                                                    <button type="submit" class="eliminar-icono" title="Eliminar">
                                                        <img src="./assets/icons/basura.png" alt="Icono de papelera" class="basura">
                                                        <span class=palabra-eliminar>Eliminar</span>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="col-precio-info">
                                    <div class="contenido-col-2">
                                        <p class="palabra-precio"><?= $pedido->getProducto()->getPrecio() ?> €</p>
                                    </div>
                                </td>
                                <td class="col-cantidad-info">
                                    <div class="sitio-boton">
                                        <div class="contenido-col-2 boton-cantidad">
                                            <div class="cantidad-numero col-9">
                                                <span><?= $pedido->getCantidad() ?></span>
                                            </div>
                                            <div class="modificador col-3">
                                                <form action="<?= url . '?controller=product&action=funcionalidadesCarrito' ?>" method='post'>
                                                    <input type="hidden" name="pos" value="<?= $pos ?>">
                                                    <button class="modificadores" type="submit" name="Add">+</button>
                                                    <button class="modificadores" type="submit" name="Del">-</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="col-precio-total-info">
                                    <div class="contenido-col-3">
                                        <p class="palabara-subtotal"><?= $pedido->devuelvePrecioTotal() ?> €</p>
                                    </div>
                                </td>
                            </tr>
                        <?php
                            }
                            $pos++;
                        } ?>
                    </tbody> 
                </table>             
            </div>
            <div class="col-6 contenido-resumen">
                <h2 class="titulo-uno">RESUMEN</h2>
                <div class="texto-subtotal">
                    <span class="mensaje-subtotal">Desde el equipo de REXTURA te deseamos una feliz comida.</span>
                </div>
                <table>
                    <tbody>
                        <tr>
                            <th class="palabra-dos">Subtotal</th>
                            <td class="precio-uno"><?=CalculadoraPrecios::calculadorPrecioPedido($_SESSION['selecciones'])?> €</td>
                        </tr>
                        <tr class="total-pedido">
                            <th class="palabra-tres">Total del pedido</th>
                            <td class="precio-dos"><?=CalculadoraPrecios::calculadorPrecioPedido($_SESSION['selecciones'])?> €</td>
                        </tr>
                    <tbody>
                </table>
                <form action=<?=url.'?controller=product&action=confirmar'?> method='post'>
                    <td class="boton-confirmar">
                        <button class="boton-confirmar" type="submit"> 
                            <span class="palabra-confirmar">Tramitar pedido</span>
                        </button>
                    </td>                  
                </form>
                <a class="seguir-comprando" href="https://localhost/rextura/index.php?controller=product&action=products">Seguir comprando</a>
            </div>
            <?php } else {
            echo "No hay productos en el carrito.";?>
            <form action=<?=url.'?controller=product&action=products'?> method='post'>
                <td><button class="boton-principal" type="submit"> IR A CARTA </button></td>                  
            </form>
            <form action=<?=url.'?controller=product&action=recuperarUltimoPedido'?> method='post'>
                <td><button class="boton-principal" type="submit"> RECUPERAR ULTIMO PEDIDO </button></td>                  
            </form>
            <?php }
            session_write_close();?>
        </div>
    </section>
    <section class="container">
    <div>
        <h1 class="titulos-secciones">También te puede intersar</h1>
    </div>
    <div class="container text-center">
        <div class="row">
            <?php 
            $products = ProductDAO::getFourProducts(); // Obtener los 4 productos
            foreach ($products as $product) { // Iterar sobre la lista de productos
            ?>
                <article class="col-6 col-lg-3 producto-ind">
                        <div class="card">
                            <img src="./assets/images/productos/<?=$product->getImage(); ?>" class="card-img-top" alt="<?=$product->getNombre(); ?>">
                            <div class="card-body">
                                <h5 class="nombre-producto"><?=$product->getNombre(); ?></h5>
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
                                        <form class="boton-carrito" action=<?=url.'?controller=product&action=añadirCarritoDesdeCarrito'?> method="post">
                                            <!--BOTON AÑADIR-->
                                            <input type="hidden" name="action" value="añadirCarrito">
                                            <input type="hidden" name="id" value="<?=$product->getId(); ?>">
                                            <button type="submit"class="boton-principal">Añadir</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                </article>
            <?php } ?>
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