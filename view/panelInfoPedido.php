<!DOCTYPE html>
<html>
<head>
    <title>Información del Pedido</title>
    <!-- Aquí puedes incluir cualquier CSS o JavaScript que necesites -->
</head>
<body>
<?php
    // Incluye el header
    include_once 'header.php';
    ?>
    <h1>Información del Pedido #<?= htmlspecialchars($pedido[0]['pedido_id']) ?></h1>

    <p>Fecha del Pedido: <?= htmlspecialchars($pedido[0]['fecha_pedido']) ?></p>
    <p>Total: <?= htmlspecialchars($pedido[0]['total']) ?></p>
    <p>Propina: <?= htmlspecialchars($pedido[0]['propina']) ?></p>
    <p>Puntos Usados: <?= htmlspecialchars($pedido[0]['puntos_usados']) ?></p>
    <p>Puntos Ganados: <?= htmlspecialchars($pedido[0]['puntos_ganados']) ?></p>

    <!-- Muestra la información de los productos del pedido -->
    <table>
        <thead>
            <tr>
                <th>ID del Producto</th>
                <th>Precio Unidad</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pedido as $producto): ?>
                <tr>
                    <td><?= htmlspecialchars($producto['producto_id']) ?></td>
                    <td><?= htmlspecialchars($producto['precio']) ?></td>
                    <td><?= htmlspecialchars($producto['cantidad']) ?></td>
                    <td><?= htmlspecialchars($producto['subtotal']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a class="seguir-comprando" href="https://localhost/rextura/index.php?controller=product&action=panelHome">Volver a Inicio</a>

    <?php
    // Incluye el footer
    include_once 'footer.php';
    ?>
</body>
</html>