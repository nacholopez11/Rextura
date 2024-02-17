<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Información del Pedido</title>
    <link href="./assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="./assets/css/full_estil_info_pedido.css" rel="stylesheet" type="text/css" media="screen">
    <link href="./assets/css/full_estil_general.css" rel="stylesheet" type="text/css" media="screen">
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/notie/dist/notie.min.css">
</head>
<body>
<?php
    // Incluye el header
    session_start();
    include_once 'header.php';
    ?>
    <section class="container">
        <h1 class="texto-titulo">Pedido #<?= htmlspecialchars($pedido[0]['pedido_id']) ?></h1>
        <div class="row info">
            <div class="col-12 col-lg-6 col-md-6 col-sm-12">
                <div class="text-info">
                    <p class="titulos">Fecha: <?= htmlspecialchars($pedido[0]['fecha_pedido']) ?></p>
                    <p class="titulos">Total: <?= htmlspecialchars($pedido[0]['total']) ?> €</p>
                    <p class="titulos">Propina: <?= htmlspecialchars($pedido[0]['propina']) ?> €</p>
                    <p class="titulos">Puntos Usados: <?= htmlspecialchars($pedido[0]['puntos_usados']) ?>p.</p>
                    <p class="titulos">Puntos Ganados: <?= htmlspecialchars($pedido[0]['puntos_ganados']) ?>p.</p>
                </div>
                <div class="link-volver">
                    <a class="seguir-comprando" href=<?=url."index.php?controller=product&action=panelHome"?>>Volver a Inicio</a>
                </div>
            </div>
            <div class="col-12 col-lg-6 col-md-6 col-sm-12">
                <table class="tabla-info">
                    <thead>
                        <tr>
                            <th class="titulo-categoria">ID PRODUCTO</th>
                            <th class="titulo-categoria">PRECIO UNIDAD</th>
                            <th class="titulo-categoria">CANTIDAD</th>
                            <th class="titulo-categoria">SUBTOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pedido as $producto): ?>
                            <tr>
                                <td class="palabra-nombre"><?= htmlspecialchars($producto['producto_id']) ?></td>
                                <td class="palabra-nombre"><?= htmlspecialchars($producto['precio']) ?> €</td>
                                <td class="palabra-nombre"><?= htmlspecialchars($producto['cantidad']) ?></td>
                                <td class="palabra-nombre"><?= htmlspecialchars($producto['subtotal']) ?> €</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <?php
    // Incluye el footer
    include_once 'footer.php';
    ?>
</body>
</html>