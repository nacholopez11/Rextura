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
                                <span class="s-articulo">Articulo</span>
                            </td>
                            <td class="col-precio">
                                <span class="s-precio">Precio</span>
                            </td>
                            <td class="col-cantidad">
                                <span class="s-cantidad">Cantidad</span>
                            </td>
                            <td class="col-precio-total">
                                <span class="s-precio-total">Subtotal</span>
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Creamos una fila por cada producto -->
                        <?php
                        $pos = 0;
                        foreach($_SESSION['selecciones'] as $pedido){?>
                        <tr class="fila-producto">
                            <td class="col-nombre-info">
                                <div class="producto-contenedor row">
                                    <div class="producto-imagen col-6">
                                        <img src="./assets/images/productos/<?= $pedido->getProducto()->getImage() ?>" alt="Imagen del producto">
                                    </div>
                                    <div class="producto-detalles col-6">
                                        <p><?= $pedido->getProducto()->getNombre() ?></p>
                                        <p>Categoría: <?= $pedido->getProducto()->getCategoria() ?></p>
                                        <form action="<?= url . '?controller=product&action=eliminarCarritoEntero' ?>" method="post">
                                            <input type="hidden" name="pos" value="<?= $pos ?>">
                                            <button type="submit" class="eliminar-icono" title="Eliminar">
                                                <img src="ruta/icono_papelera.png" alt="Icono de papelera">
                                                <span>Eliminar</span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                            <td class="col-precio-info"><?= $pedido->getProducto()->getPrecio() ?></td>
                            <td class="col-cantidad-info">
                                <form action="<?= url . '?controller=product&action=funcionalidadesCarrito' ?>" method='post'>
                                    <input type="hidden" name="pos" value="<?= $pos ?>">
                                    <button class="bet-button w3-black w3-section" type="submit" name="Add">+</button>
                                    <span><?= $pedido->getCantidad() ?></span>
                                    <button class="bet-button w3-black w3-section" type="submit" name="Del">-</button>
                                </form>
                            </td>
                            <td class="col-precio-total-info"><?= $pedido->devuelvePrecioTotal() ?></td>
                        </tr>
                        <?php
                            $pos++;
                        } ?>
                    </tbody> 
                </table>             
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
            <div class="col-6">
                <table>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>PRECIO FINAL PEDIDO:</td>
                        <td><?=CalculadoraPrecios::calculadorPrecioPedido($_SESSION['selecciones'])?></td>
                        <form action=<?=url.'?controller=product&action=confirmar'?> method='post'>
                            <td><button class="boton-principal" type="submit"> CONFIRMAR </button></td>                  
                        </form>
                        <td></td>
                    </tr>
                </table>
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