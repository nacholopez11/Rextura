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
                        <tr>
                            <td class="col-articulo">
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
                        <tr>
                            <td><?=$pedido->getProducto()->getNombre()?></td>
                            <td><?=$pedido->getProducto()->getPrecio()?></td>
                            <td><?=$pedido->getCantidad()?></td>
                            <td><?=$pedido->devuelvePrecioTotal()?></td>
                            <!-- BOTON MODIFICAR CANTIDAD -->
                            <form action=<?=url.'?controller=product&action=funcionalidadesCarrito'?> method='post'>
                                <input type="hidden" name="pos" value="<?=$pos?>">
                                <td><button class="bet-button w3-black w3-section" type="submit" name="Add">+</button></td>
                                <td><button class="bet-button w3-black w3-section" type="submit" name="Del">-</button></td>
                            </form>
                        </tr>
                        <?php
                            $pos++;
                        }?>
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
                    </tbody> 
                </table>
                <?php } else {
                // La variable de sesión no existe o está vacía
                echo "No hay productos en el carrito.";?>
                <form action=<?=url.'?controller=product&action=products'?> method='post'>
                    <td><button class="boton-principal" type="submit"> IR A CARTA </button></td>                  
                </form>
                <?php }
                // No olvides cerrar la sesión al finalizar
                session_write_close();?>
            </div>
            <div class="col-6">

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